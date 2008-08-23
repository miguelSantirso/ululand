<?php

/**
 * Add javascript code to the response.
 * 
 * @package     sfSyntaxHighlighterPlugin
 * @subpackage  filter
 * @author      Miguel Santirso <tirso.00@gmail.com>
 * @version     SVN: $Id$
 */
class sfSyntaxHighlighterFilter extends sfFilter
{
  /**
   * Insert highlighting code to the response
   * 
   * @param   sfFilterChain $filterChain
   */
  public function execute($filterChain)
  {
  	$response = $this->context->getResponse();
  	
  	$response->addJavascript('/sfSyntaxHighlighterPlugin/js/shCore');
	$this->addBrushes($response);
  	$response->addStylesheet('/sfSyntaxHighlighterPlugin/css/SyntaxHighlighter');
  	
  	$filterChain->execute();
  	 
  	$htmlToAdd = $this->generateHtml();
  	
  	$old = $response->getContent();
  	
  	$new = str_ireplace('</body>', "\n".$htmlToAdd."\n</body>", $old);

  	if ($old == $new)
  	{
  		$new .= $htmlToAdd;
  	}
  	 
  	$response->setContent($new);
  }
  
  protected function generateHtml()
  {
    $html = array();
    $html[] = '<script language="javascript">';
    $html[] = 'dp.SyntaxHighlighter.ClipboardSwf = "/sfSyntaxHighlighterPlugin/js/clipboard.swf";';
    $html[] = 'dp.SyntaxHighlighter.HighlightAll("code");';
    $html[] = '</script>';
    $html = join("\n", $html);
    
    return $html;
  }
  
  protected function addBrushes($response)
  {
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
  }

}