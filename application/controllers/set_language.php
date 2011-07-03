<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Set_language Class
 * 
 * Set the user's language. Guests have a cookie set; logged-in users have their language property changed
 * and saved to the DB
 *
 * @author	Joseph Wynn
 */
class Set_language extends WL_Controller {

	/**
	 * Set the user's language
	 *
	 * @param	string	$new_language
	 * @return	void
	 *
	 */
	public function index($language)
	{
		// Default redirect is the root
		$redirect = '/';
		
		// Make sure the language specified is in the available_languages array
		if (array_key_exists($language, $this->config->item('available_languages')))
		{
			if ($this->authenticated)
			{
				$this->user->setLanguage($language);
				$this->em->persist($this->user);
				$this->em->flush();

				// Change the default redirect to the default user page
				$redirect = $this->config->item('default_user_page');
			}

			$this->load->helper('cookie');
			set_cookie($this->config->item('language_cookie'), $language, $this->config->item('language_cookie_expire'));
		}

		// No return URI was set; redirect to the default page
		redirect($this->input->get('return') ? $this->input->get('return') : $redirect);
	}

}