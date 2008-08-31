<?php


class ulGeshiToolkit
{
	public static function getAvailableLanguages()
	{
		$languages = array(
	            'actionscript' => 'Actionscript',
 	            'actionscript3' => 'Actionscript 3.0',
 	            'c' => 'C',
 	            'cpp' => 'C++',
 	            'csharp' => 'C#',
 	            'css' => 'CSS',
 	            'java5' => 'Java',
 	            'javascript' => 'JavaScript',
 	            'php' => 'PHP',
 	            'python' => 'Python',
 	            'ruby' => 'Ruby',
 	            'rails' => 'Rails',
 	            'sql' => 'SQL',
				'text' => 'TXT',
 	            'vb' => 'Visual Basic',
 	            'vbnet' => 'Visual Basic.net',
 	            'xml' => 'XML',
 	            'html4strict' => 'HTML',
		);

		return $languages;
	}

	private static function geshiCall($matches, $default = '')
	{
		require_once('geshi.php');

		if (preg_match('/^\[(.+?)\]\s*(.+)$/s', $matches[1], $match))
		{
			$geshi = new GeSHi(html_entity_decode($match[2]), $match[1]);
			$geshi->enable_classes();
			$geshi->enable_line_numbers(GESHI_FANCY_LINE_NUMBERS, 2);
			$geshi->enable_keyword_links(true);
			$geshi->set_header_type(GESHI_HEADER_DIV);
			$geshi->set_header_content('<LANGUAGE>');
			$geshi->set_overall_class('ulSyntaxHighlighter');
			return @$geshi->parse_code();
		}
		else
		{
			if ($default)
			{
				$geshi = new GeSHi(html_entity_decode($matches[1]), $default);
				$geshi->enable_classes();

				return @$geshi->parse_code();
			}
			else
			{
				return "<pre><code>".$matches[1].'</pre></code>';
			}
		}
	}

	public static function transformToHtml($string)
	{
		$string = htmlentities($string, ENT_QUOTES, 'UTF-8');
		// transform [code] blocks to Markdown code blocks
		$lines  = explode("\n", $string);
		$incode = false;
		$string = '';
		foreach ($lines as $line)
		{
			if ($incode)
			{
				$line = '    '.html_entity_decode($line, ENT_QUOTES, 'UTF-8');
			}
			if (preg_match('/^\s*\[code\s*([^\]]*?)\]/', $line, $match))
			{
				$incode = true;
				$line   = $match[1] ? "\n\n    [".$match[1]."]" : "\n\n";
			}
			if (strpos($line, '[/code]') !== false)
			{
				$incode = false;
				$line   = ' ';
			}

			$string .= $line."\n";
		}

		// Markdown formatting
		$html = sfMarkdown::doConvert($string);

		// syntax highlighting
		$html = preg_replace_callback('#<pre><code>(.+?)</code></pre>#s', array('ulGeshiToolkit', 'geshiCall'), $html);

		return $html;
	}
}

