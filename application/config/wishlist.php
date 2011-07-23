<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| User Defaults
|--------------------------------------------------------------------------
|
| default_user_page - the page that users will be redirected to after logging in.
| default_user_group - the default group that new users will belong to (must be
|	the name of a user_group record, e.g. 'User')
| default_user_settings - an array of setting names, their default values, and data type
|
*/
$config['default_user_page'] = 'wishlists';
$config['default_user_group'] = 'User';
$config['default_user_settings'] = array(
	'default_public_wishlist' => array(
		'type' => 'boolean',
		'value' => TRUE
	)
);

/*
|--------------------------------------------------------------------------
| Default Country / Language
|--------------------------------------------------------------------------
|
| These item determines the country and language that are selected by default.
|
| 	default_country must be a valid ISO code
|
| 	default_language must be a valid lowercase ISO code specified in the
|	available_languages array below.
|
*/
$config['default_country'] = 'GB';
$config['default_language'] = 'en';

/*
|--------------------------------------------------------------------------
| Languages
|--------------------------------------------------------------------------
|
| language_cookie - The name of the cookie in which to store the current language
| language_cookie_expire - Expiry time of the language cookie. Default: 2 weeks (1209600)
| available_languages - An array of languages that are available for translation
|
*/
$config['language_cookie'] = 'wishlist-language';
$config['language_cookie_expire'] = 1209600;
$config['available_languages'] = array(
	'en' => array(
		'name' => 'English',
		'folder' => 'english'
	)
);

/* End of file wishlist.php */
/* Location: ./application/config/wishlist.php */
