<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Default User Page
|--------------------------------------------------------------------------
|
| This is the page that users will be redirected to after logging in.
|
*/
$config['default_user_page'] = 'wishlists';

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
| available_languages - An array of languages that are available for translation
| language_cookie - The name of the cookie in which to store the current language
| language_cookie_expire - Expiry time of the language cookie. Default: 2 weeks (1209600)
|
*/
$config['available_languages'] = array(
	'en' => array(
		'name' => 'English',
		'folder' => 'english'
	),
	'fr' => array(
		'name' => 'Français',
		'folder' => 'french'
	)
);

$config['language_cookie'] = 'wishlist-language';
$config['language_cookie_expire'] = 1209600;


/* End of file wishlist.php */
/* Location: ./application/config/wishlist.php */
