<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Default Template Layout
|--------------------------------------------------------------------------
|
| The default view to use as the layout in the Template library.
|
*/
$config['template_default_layout'] = 'templates/default';

/*
|--------------------------------------------------------------------------
| Script Root Directory
|--------------------------------------------------------------------------
|
| Added to the beginning of script URIs, i.e. with a script_root value of
| '/includes/js/', addScript('myscript.js') would add the script '/includes/js/myscript.js'
|
| Setting prepend_base_url to TRUE will prepend base_url() to your script_root setting
|
*/
$config['script_root'] = 'serve?f=';
$config['prepend_base_url'] = TRUE;

/*
|--------------------------------------------------------------------------
| Automatically Trim Title
|--------------------------------------------------------------------------
|
| The Template library can automatically trim page titles. Set this configuration
| to the maximum title length (in characters). Set to 0 for no limit. Default: 50
|
*/
$config['max_title_length'] = 50;