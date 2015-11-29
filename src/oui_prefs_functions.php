<?php

// This is a PLUGIN TEMPLATE.

// Copy this file to a new name like abc_myplugin.php.  Edit the code, then
// run this file at the command line to produce a plugin for distribution:
// $ php abc_myplugin.php > abc_myplugin-0.1.txt

// Plugin name is optional.  If unset, it will be extracted from the current
// file name. Plugin names should start with a three letter prefix which is
// unique and reserved for each plugin author ('abc' is just an example).
// Uncomment and edit this line to override:
# $plugin['name'] = 'abc_plugin';

// Allow raw HTML help, as opposed to Textile.
// 0 = Plugin help is in Textile format, no raw HTML allowed (default).
// 1 = Plugin help is in raw HTML.  Not recommended.
# $plugin['allow_html_help'] = 0;

$plugin['version'] = '0.1';
$plugin['author'] = 'Nicolas Morand';
$plugin['author_uri'] = '';
$plugin['description'] = 'Allow new functions for html prefs value';

// Plugin load order:
// The default value of 5 would fit most plugins, while for instance comment
// spam evaluators or URL redirectors would probably want to run earlier
// (1...4) to prepare the environment for everything else that follows.
// Values 6...9 should be considered for plugins which would work late.
// This order is user-overrideable.
# $plugin['order'] = 5;

// Plugin 'type' defines where the plugin is loaded
// 0 = public       : only on the public side of the website (default)
// 1 = public+admin : on both the public and non-AJAX admin side
// 2 = library      : only when include_plugin() or require_plugin() is called
// 3 = admin        : only on the non-AJAX admin side
// 4 = admin+ajax   : only on admin side
// 5 = public+admin+ajax   : on both the public and admin side
# $plugin['type'] = 0;
$plugin['type'] = 3;

// Plugin 'flags' signal the presence of optional capabilities to the core plugin loader.
// Use an appropriately OR-ed combination of these flags.
// The four high-order bits 0xf000 are available for this plugin's private use.
if (!defined('PLUGIN_HAS_PREFS')) define('PLUGIN_HAS_PREFS', 0x0001); // This plugin wants to receive "plugin_prefs.{$plugin['name']}" events
if (!defined('PLUGIN_LIFECYCLE_NOTIFY')) define('PLUGIN_LIFECYCLE_NOTIFY', 0x0002); // This plugin wants to receive "plugin_lifecycle.{$plugin['name']}" events

# $plugin['flags'] = PLUGIN_HAS_PREFS | PLUGIN_LIFECYCLE_NOTIFY;

// Plugin 'textpack' is optional. It provides i18n strings to be used in conjunction with gTxt().
// Syntax:
// ## arbitrary comment
// #@event
// #@language ISO-LANGUAGE-CODE
// abc_string_name => Localized String

/** Uncomment me, if you need a textpack
$plugin['textpack'] = <<< EOT
#@admin
#@language en-gb
abc_sample_string => Sample String
abc_one_more => One more
#@language de-de
abc_sample_string => Beispieltext
abc_one_more => Noch einer
EOT;
**/
// End of textpack

if (!defined('txpinterface'))
	@include_once('zem_tpl.php');

if (0) {
?>
# --- BEGIN PLUGIN HELP ---

h1. oui_prefs_functions

p. This plugin allow the use the following functions as html values of custom prefs.

h2. Functions

* oui_prefs_section_list
* oui_prefs_category_list
* oui_prefs_cat_article_list
* oui_prefs_cat_image_list
* oui_prefs_cat_link_list
* oui_prefs_cat_file_list
* oui_prefs_article_list
* oui_prefs_image_list
* oui_prefs_link_list
* oui_prefs_file_list
* oui_prefs_style_list

# --- END PLUGIN HELP ---
<?php
}

# --- BEGIN PLUGIN CODE ---

if (@txpinterface == 'admin') {

	register_callback('oui_prefs_section_list', 'prefs', 'advanced_prefs');
	register_callback('oui_prefs_category_list', 'prefs', 'advanced_prefs');
	register_callback('oui_prefs_image_list', 'prefs', 'advanced_prefs');
	register_callback('oui_prefs_article_list', 'prefs', 'advanced_prefs');
	
	function oui_prefs_section_list($name, $val)
	{
	    $sections = safe_rows("name, title", 'txp_section', "name != 'default' ORDER BY title, name");
	    $vals = array();
	    foreach ($sections as $row) {
	        $vals[$row['name']] = $row['title'];
	    }
		if ($sections)
		{
	    	return selectInput($name, $vals, $val, 'true');
		}
		return gtxt('no_sections_available');
	}
	
	function oui_prefs_category_list($name, $val)
	{
		$rs = getTree('root', '');
	
		if ($rs)
		{
			return treeSelectInput($name,$rs,$val);
		}
	
		return gtxt('no_categories_exist');
	}
	
	function oui_prefs_cat_article_list($name, $val)
	{
		$rs = getTree('root', 'article');
	
		if ($rs)
		{
			return treeSelectInput($name,$rs,$val);
		}
	
		return gtxt('no_categories_exist');
	}
	
	function oui_prefs_cat_image_list($name, $val)
	{
		$rs = getTree('root', 'image');
	
		if ($rs)
		{
			return treeSelectInput($name,$rs,$val);
		}
	
		return gtxt('no_categories_exist');
	}
	
	function oui_prefs_cat_link_list($name, $val)
	{
		$rs = getTree('root', 'link');
	
		if ($rs)
		{
			return treeSelectInput($name,$rs,$val);
		}
	
		return gtxt('no_categories_exist');
	}
	
	function oui_prefs_cat_file_list($name, $val)
	{
		$rs = getTree('root', 'file');
	
		if ($rs)
		{
			return treeSelectInput($name,$rs,$val);
		}
	
		return gtxt('no_categories_exist');
	}

	function oui_prefs_article_list($name, $val)
	{
	    $articles = safe_rows("title, id", 'textpattern', "title != 'default' ORDER BY id, title");
	    $vals = array();
	    foreach ($articles as $row) {
	        $vals[$row['id']] = $row['title'];
	    }
		if ($articles)
		{
	    	return selectInput($name, $vals, $val, 'true');
		}
		return gtxt('no_articles_recorded');
	}
	
	function oui_prefs_image_list($name, $val)
	{
	    $images = safe_rows("name, id", 'txp_image', "name != 'default' ORDER BY id, name");
	    $vals = array();
	    foreach ($images as $row) {
	        $vals[$row['id']] = $row['name'];
	    }
		if ($images)
		{
	    	return selectInput($name, $vals, $val, 'true');
		}
		return gtxt('no_images_recorded');
	}

	function oui_prefs_link_list($name, $val)
	{
	    $links = safe_rows("title, id", 'textpattern', "title != 'default' ORDER BY id, title");
	    $vals = array();
	    foreach ($links as $row) {
	        $vals[$row['id']] = $row['title'];
	    }
		if ($links)
		{
	    	return selectInput($name, $vals, $val, 'true');
		}
		return gtxt('no_links_recorded');
	}

	function oui_prefs_file_list($name, $val)
	{
	    $files = safe_rows("name, id", 'txp_image', "name != 'default' ORDER BY id, name");
	    $vals = array();
	    foreach ($files as $row) {
	        $vals[$row['id']] = $row['name'];
	    }
		if ($files)
		{
	    	return selectInput($name, $vals, $val, 'true');
		}
		return gtxt('no_images_recorded');
	}
		
	function oui_prefs_style_list($name, $val)
	{
	    $styles = safe_rows("name", 'txp_css', "name != 'default' ORDER BY name");
	    $vals = array();
	    foreach ($styles as $row) {
	        $vals[$row['name']] = $row['name'];
	    }
		if ($styles)
		{
	    	return selectInput($name, $vals, $val, 'true');
		}
		return gtxt('no_styles_recorded');
	}

}
# --- END PLUGIN CODE ---

?>
