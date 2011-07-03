<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * WL_Lang Class
 *
 * Change the language config based on the current user's language,
 * or a language cookie.
 *
 * @author  Joseph Wynn
 */
class WL_Lang extends CI_Lang {

	public function __construct()
	{
		parent::__construct();

		global $CFG, $IN;

		$CFG->load('wishlist');
		$available_languages = $CFG->item('available_languages');

		if (($language = $IN->cookie($CFG->item('language_cookie'))) && array_key_exists($language, $available_languages))
		{
			$CFG->set_item('language', $available_languages[$language]['folder']);
		}
		else
		{
			$CFG->set_item('language', $CFG->item('default_language'));
		}
	}

}
