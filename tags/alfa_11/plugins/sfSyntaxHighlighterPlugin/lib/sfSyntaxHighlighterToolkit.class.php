<?php

class sfSyntaxHighlighterToolkit
{
	
	public static function getAvailableBrushes()
	{	
		$brushes = array(
			'cpp'         => array('js' => 'shBrushCpp',      'name' => 'C++'),
			'c'           => array('js' => 'shBrushCpp',      'name' => 'C++'),
			'c++'         => array('js' => 'shBrushCpp',      'name' => 'C++'),
			'c#'          => array('js' => 'shBrushCSharp',   'name' => 'C#'),
			'c-sharp'     => array('js' => 'shBrushCSharp',   'name' => 'C#'),
			'csharp'      => array('js' => 'shBrushCSharp',   'name' => 'C#'),
			'css'         => array('js' => 'shBrushCss',      'name' => 'CSS'),
			'delphi'      => array('js' => 'shBrushDelphi',   'name' => 'Delphi'),
			'pascal'      => array('js' => 'shBrushDelphi',   'name' => 'Pascal'),
			'java'        => array('js' => 'shBrushJava',     'name' => 'Java'),
			'js'          => array('js' => 'shBrushJScript',  'name' => 'JavaScript'),
			'jscript'     => array('js' => 'shBrushJScript',  'name' => 'JavaScript'),
			'javascript'  => array('js' => 'shBrushJScript',  'name' => 'JavaScript'),
			'php'         => array('js' => 'shBrushPhp',      'name' => 'PHP'),
			'py'          => array('js' => 'shBrushPython',   'name' => 'Python'),
			'python'      => array('js' => 'shBrushPython',   'name' => 'Python'),
			'rb'          => array('js' => 'shBrushRuby',     'name' => 'Ruby'),
			'ruby'        => array('js' => 'shBrushRuby',     'name' => 'Ruby'),
			'rails'       => array('js' => 'shBrushRuby',     'name' => 'Ruby'),
			'ror'         => array('js' => 'shBrushRuby',     'name' => 'Ruby'),
			'sql'         => array('js' => 'shBrushSql',      'name' => 'SQL'),
			'vb'          => array('js' => 'shBrushVb',       'name' => 'Visual Basic'),
			'vb.net'      => array('js' => 'shBrushVb',       'name' => 'Visual Basic.net'),
			'xml'         => array('js' => 'shBrushXml',      'name' => 'XML'),
			'html'        => array('js' => 'shBrushXml',      'name' => 'HTML'),
			'xhtml'       => array('js' => 'shBrushXml',      'name' => 'XHTML'),
			'xslt'        => array('js' => 'shBrushXml',      'name' => 'XSLT'),
			'as3'         => array('js' => 'shBrushAS3',      'name' => 'ActionScript 3.0'),
			'as'          => array('js' => 'shBrushAS3',      'name' => 'ActionScript'),
			'actionscript'=> array('js' => 'shBrushAS3',      'name' => 'ActionScript'),
		);
		
		return $brushes;
	}
	
	public static function getAvailableLanguages()
	{
		$brushes = sfSyntaxHighlighterToolkit::getAvailableBrushes();
		$aliases = array_keys($brushes);
		$languages = array();
		
		foreach($aliases as $alias)
		{
			if(!in_array($brushes[$alias]["name"], $languages))
			{
				$languages[$alias] = $brushes[$alias]["name"];			
			}
		}
		
		return $languages;
	}
	
	public static function getAliasesRegex()
	{
		$aliases = array_keys(sfSyntaxHighlighterToolkit::getAvailableBrushes());
		return "(" . implode('|', $aliases) . ')';
	}
	
}