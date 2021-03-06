<?php

	include_once(sfConfig::get('sf_syntax_highlighter_plugin_dir') . '/lib/sfSyntaxHighlighterToolkit.class.php');
	include_once(sfConfig::get('sf_symfony_lib_dir') . '/helper/FormHelper.php');
	
	/**
	 * Returns a <select> tag populated with all the available brushes in the sfSyntaxHighlighterPlugin
	 *
	 * The select_programming_language_tag builds off the traditional select_tag function, and is conveniently populated with
	 * all the syntax highlighting brushes available (sorted alphabetically). Each option in the list has an alias
	 * code for its value and the programming language's name as its display title.  The brushes data is retrieved via the sfSyntaxHighlighterToolkit
	 * class, which stores the full list of available programming languages
	 * Here's an example of an <option> tag generated by the select_programming_language_tag:
	 *
	 * <samp>
	 *  <option value="as3">ActionScript 3.0</option>
	 * </samp>
	 *
	 * <b>Examples:</b>
	 * <code>
	 *  echo select_programming_language_tag('programming language', 'php');
	 * </code>
	 *
	 * @param  string field name
	 * @param  string selected field value (alias for a programming language; see plugin docs)
	 * @param  array  additional HTML compliant <select> tag parameters
	 * @return string <select> tag populated with all the countries in the world.
	 * @see select_tag, options_for_select, sfSyntaxHighlighterToolkit
	 */
	function select_programming_language_tag($name, $selected = null, $options = array())
	{
		$languages = sfSyntaxHighlighterToolkit::getAvailableLanguages();

		if ($language_option = _get_option($options, 'languages'))
		{
			foreach ($languages as $key => $value)
			{
				if (!in_array($key, $language_option))
				{
					unset($languages[$key]);
				}
			}
		}

		asort($languages);

		$option_tags = options_for_select($languages, $selected, $options);
		unset($options['include_blank'], $options['include_custom']);

		return select_tag($name, $option_tags, $options);
	}