<?php

include_once(sfConfig::get('sf_syntax_highlighter_plugin_dir') . '/lib/sfSyntaxHighlighterToolkit.class.php');

/**
 * Adds javascript code to the response.
 * The functions that convert BBCode to HTML are heavily inspired by the ones in the SyntaxHighlighter Plugin for wordpress, 
 * by <a href="http://photomatt.net/">Matt</a>, <a href="http://www.viper007bond.com/">Viper007Bond</a>, 
 * and <a href="http://blogwaffe.com/">mdawaffe</a>
 * 
 * @package     sfSyntaxHighlighterPlugin
 * @subpackage  filter
 * @author      Miguel Santirso (http://miguelSantirso.es) <tirso.00@gmail.com>
 * @version     SVN: $Id$
 */
class sfSyntaxHighlighterFilter extends sfFilter
{
  /**
   * Insert highlighting code to the response only if needed
   * 
   * @param   sfFilterChain $filterChain
   */
  public function execute($filterChain)
  {
  	// get the response
  	$response = $this->context->getResponse();
  	
  	// Add the javascripts and the library
  	$response->addJavascript('/sfSyntaxHighlighterPlugin/js/shCore');
    $this->addBrushes($response);
  	$response->addStylesheet('/sfSyntaxHighlighterPlugin/css/SyntaxHighlighter');
  	
  	// execute filter chain
  	$filterChain->execute();
  	
  	// get the content of the response
  	$old = $response->getContent();
  	// convert the BBCode to HTML ([code], [source], [sourcecode] => <pre>)
  	$new = $this->BBCodeToHTML($old);
  	
  	// if nothing has changed and there are no <pre> tags, it means that there is no code to highlight. Finished
  	if($old == $new && !$this->checkForPreTag($old)) return;
  	
  	$old = $new;
  	$htmlToAdd = $this->generateHtml(); // generate the javascript code to add at the bottom of the page
  	// Add the code right before the </body>
  	$new = str_ireplace('</body>', "\n".$htmlToAdd."\n</body>", $old);

  	// If nothing has changed it means that the response has not </body>
  	if ($old == $new)
  	{
  		// We simply add it at the bottom of the response
  		$new .= $htmlToAdd;
  	}
	
  	// We set the new content
  	$response->setContent($new);
  }
  
  /**
   * Generates the javascript code to add at the bottom of the html. This code highlights the source
   *
   * @return unknown
   */
  protected function generateHtml()
  {
    $html = array();
    $html[] = '<script type="text/javascript" language="javascript">';
    $html[] = 'dp.SyntaxHighlighter.ClipboardSwf = "/sfSyntaxHighlighterPlugin/js/clipboard.swf";';
    $html[] = 'dp.SyntaxHighlighter.HighlightAll("code");';
    $html[] = '</script>';
    $html = join("\n", $html);
    
    return $html;
  }
  
  /**
   * Adds all the brushes
   *
   * @param sfResponse $response Response to which the javascripts will be added
   */
  protected function addBrushes($response)
  {
  	$languages = sfSyntaxHighlighterToolkit::getAvailableBrushes();
  	
  	foreach($languages as $language)
  	{
  		$response->addJavascript('/sfSyntaxHighlighterPlugin/js/' . $language["js"]);
  	}
  	/*
	  	$response->addJavascript('/sfSyntaxHighlighterPlugin/js/shBrushAs3');
	  	$response->addJavascript('/sfSyntaxHighlighterPlugin/js/shBrushCpp');
	  	$response->addJavascript('/sfSyntaxHighlighterPlugin/js/shBrushCSharp');
	  	$response->addJavascript('/sfSyntaxHighlighterPlugin/js/shBrushCss');
	  	$response->addJavascript('/sfSyntaxHighlighterPlugin/js/shBrushDelphi');
	  	$response->addJavascript('/sfSyntaxHighlighterPlugin/js/shBrushJava');
	  	$response->addJavascript('/sfSyntaxHighlighterPlugin/js/shBrushJScript');
	  	$response->addJavascript('/sfSyntaxHighlighterPlugin/js/shBrushPhp');
	  	$response->addJavascript('/sfSyntaxHighlighterPlugin/js/shBrushPython');
	  	$response->addJavascript('/sfSyntaxHighlighterPlugin/js/shBrushRuby');
	  	$response->addJavascript('/sfSyntaxHighlighterPlugin/js/shBrushSql');
	  	$response->addJavascript('/sfSyntaxHighlighterPlugin/js/shBrushVb');
	  	$response->addJavascript('/sfSyntaxHighlighterPlugin/js/shBrushXml');
	*/
  }
  
  
  /**
   * Searches for BBCode within a string
   *
   * @param string $content the content in which the function will search BBCode
   * @param boolean $addslashes
   * @return an array of the matches
   */
  protected function getBBCode( $content, $addslashes = FALSE )
  {
  	$regex = '/\[(sourcecod|sourc|cod)(e language=|e lang=|e=)';
	
  	if ( $addslashes ) $regex .= '\\\\';

  	$regex .= '([\'"])' . sfSyntaxHighlighterToolkit::getAliasesRegex();

  	if ( $addslashes ) $regex .= '\\\\';

  	$regex .= '\3\](.*?)\[\/\1e\]/si';

  	preg_match_all( $regex, $content, $matches, PREG_SET_ORDER );

  	return $matches;
  }

  /**
   * Converts the BBCode ([code], [source], [sourcecode]) to the html tag <pre>
   *
   * @param string $content the content to convert
   * @return the converted content
   */
  protected function BBCodeToHTML( $content ) 
  {

  	// If there is no BBCode in the content, we just return it
  	if ( !$this->checkForBBCode( $content ) ) return $content;

  	$matches = $this->getBBCode( $content );
  	
  	if ( empty($matches) ) return $content; // No BBCode found, we can stop here
	
  	// Loop through each match and replace the BBCode with HTML
  	foreach ( (array) $matches as $match ) 
  	{
  		$language = strtolower( $match[4] );
  		$content = str_replace( $match[0], '<pre name="code" class="' . $language . "\">\n" . htmlspecialchars( $match[5] ) . "\n</pre>", $content );
  		//$this->jsfiles2load[$this->languages[$language]] = TRUE;
  	}

  	return $content;
  }
  

  /**
   * Checks cheaply if there is BBCode in the content. This way we don't waste CPU cicles
   *
   * @param string $content the content in which the function will search BBCode
   * @return true if there is BBCode in $content
   */
  protected function checkForBBCode( $content )
  {
  	if ( stristr( $content, '[sourcecode' ) && stristr( $content, '[/sourcecode]' ) ) return TRUE;
  	if ( stristr( $content, '[source' ) && stristr( $content, '[/source]' ) ) return TRUE;
  	if ( stristr( $content, '[code' ) && stristr( $content, '[/code]' ) ) return TRUE;

  	return FALSE;
  }

  /**
   * Checks cheaply if there are <pre> tags. This way we don't waste CPU cicles
   *
   * @param string $content the content in which the function will search <pre> tags
   * @return true if there is BBCode in $content
   */
  protected function checkForPreTag( $content )
  {
  	if ( stristr( $content, '<pre' ) && stristr( $content, '</pre>' ) ) return TRUE;

  	return FALSE;
  }
}