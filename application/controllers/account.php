<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends WL_Controller {

	/**
	 * Account Index
	 */
	public function index()
	{
		$this->auth->require_login();

		$this->template->title(lang('dashboard'))
			->build('account/index', array(
				'user' => $this->user
			));
	}

	/**
	 * Update Account Settings
	 */
	public function settings()
	{
		$this->auth->require_login();

		$this->form_validation->set_rules('password', 'a password', 'min_length[6]|matches[password_confirm]');
		$this->form_validation->set_rules('email', 'your email address', 'required|valid_email|callback__unique_email');
		$this->form_validation->set_rules('country', 'country', 'required|callback__valid_country');
		$this->form_validation->set_rules('language', 'language', 'required|callback__valid_language');
		$this->form_validation->set_rules('post_code', 'post code', 'max_length[15]');
		$this->form_validation->set_message('matches', "The passwords don't match.");

		if ($this->form_validation->run())
		{
			// Update the user's settings
			$this->user->setEmail($this->input->post('email'));
			$this->user->setLanguage($this->input->post('language'));
			$this->user->setPostCode($this->input->post('post_code'));

			$country = $this->em->getRepository('models\Country')->find($this->input->post('country'));
			$this->user->setCountry($country);

			$this->em->persist($this->user);
			$this->em->flush();
		}

		$this->template->title(lang('settings'))
			->build('account/settings', array(
				'user' => $this->user,
				'countries' => $this->em->getRepository('models\Country')->getAllCountries(),
				'languages' => $this->config->item('available_languages')
			));
	}

	/**
	 * Log into the system
	 */
	public function login()
	{
		// Set up form validation and run it
		$this->form_validation->set_rules('identifier', 'username or email address', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$validate = $this->form_validation->run();

		// Attempt to log in
		$identifier = $this->input->post('identifier');
		$password = $this->input->post('password');
		$login = FALSE; //Initial value

		if (($validate === FALSE || ! $login = $this->auth->login($identifier, $password))
			&& ! $this->auth->authenticated())
		{
			$this->template
				 ->title(lang('log_in'))
				 ->unsetVar('account_menu')
				 ->build('account/login', array(
				 	'login' => $login,
				 	'validate' => $validate
				 ));
		}
		else
		{
			// Successful login - redirect to the previous page (if it is set)
			if ($return = $this->input->get('return'))
			{
				redirect($return);
			}

			// No return URI was set; redirect to the default user page
			redirect($this->config->item('default_user_page'));
		}
	}

	/**
	 * Log out of the system
	 */
	public function logout()
	{
		$this->auth->logout();
		redirect($this->config->item('default_guest_page'));
	}

	/**
	 * Register a new user
	 */
	public function signup()
	{
		// If a user is already signed in, redirect them to the account index
		if ($this->authenticated)
		{
			redirect('account');
		}

		$this->form_validation->set_rules('username', 'a username', 'required|alpha_dash|max_length[32]|callback__unique_username');
		$this->form_validation->set_rules('password', 'a password', 'required|min_length[6]|matches[password_confirm]');
		$this->form_validation->set_rules('email', 'your email address', 'required|valid_email|callback__unique_email');
		$this->form_validation->set_rules('country', 'country', 'required|callback__valid_country');
		$this->form_validation->set_rules('post_code', 'post code', 'max_length[15]');
		$this->form_validation->set_message('matches', "The passwords don't match.");

		if ($this->form_validation->run() === FALSE)
		{
			$this->template
				 ->title(lang('sign_up'))
				 ->unsetVar('account_menu')
				 ->build('account/signup', array(
				 	'selected_country' => ! $this->input->post('country') ? $this->config->item('default_country') : $this->input->post('country'),
				 	'countries' => $this->em->getRepository('models\Country')->getAllCountries()
				 ));
		}
		else
		{
			// Create the new user
			$user = new models\User;
			$user->setUsername($this->input->post('username'));
			$user->setPassword($this->input->post('password'));
			$user->setEmail($this->input->post('email'));
			$user->setPostCode($this->input->post('post_code'));

			// Set the user's language
			$language_cookie = $this->input->cookie($this->config->item('language_cookie'));
			$default_language = $this->config->item('default_language');
			$user->setLanguage($language_cookie ? $language_cookie : $default_language);

			// Set the User's country
			$country = $this->em->getRepository('models\Country')->find($this->input->post('country'));
			$user->setCountry($country);

			// Set the User's group
			$group = $this->em->getRepository('models\UserGroup')->findOneByName($this->config->item('default_user_group'));
			$group->getUsers()->add($user);
			$user->setGroup($group);

			$this->em->persist($user);
			$this->em->flush();

			// Authenticate the User
			$this->auth->authenticate($user);

			redirect($this->config->item('default_user_page'));
		}
	}

	/**
	 * Validate a Username
	 *
	 * Check if a User with that username already exists
	 *
	 * @access	public
	 * @param	string	$username
	 * @return	bool
	 */
	public function _unique_username($username)
	{
		$user = $this->em->getRepository('models\User')->findOneByUsername($username);

		if ( ! $user)
		{
			// The username is free
			return TRUE;
		}

		$this->form_validation->set_message('_unique_username', 'That username is already in use.');
		return FALSE;
	}

	/**
	 * Check that the email is not already in use
	 *
	 * If a user is currently logged in, we don't consider their own email to be in use
	 *
	 * @access	public
	 * @param	string	$email
	 * @return	bool
	 */
	public function _unique_email($email)
	{
		$user = $this->em->getRepository('models\User')->findOneByEmail($email);

		if ( ! $user || $this->authenticated && $this->user->getEmail() == $user->getEmail())
		{
			return TRUE;
		}

		// The email is already in use
		$this->form_validation->set_message('_unique_email', 'That email is already in use.');
		return FALSE;
	}

	/**
	 * Check that the language specified exists in the available_languages config item
	 *
	 * @access	public
	 * @param	string	$language
	 * @return	bool
	 */
	public function _valid_language($language)
	{
		if ( ! array_key_exists($language, $this->config->item('available_languages')))
		{
			// Invalid language specified
			$this->form_validation->set_message('_valid_country', 'Please select a language from the drop-down list.');
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * Check that the specified country exists in the DB
	 *
	 * @access	public
	 * @param	string	$country
	 * @return	bool
	 */
	public function _valid_country($country)
	{
		$country = $this->em->getRepository('models\Country')->find($country);

		if ( ! $country)
		{
			// The country doesn't exist
			$this->form_validation->set_message('_valid_country', 'Please select a country from the drop-down list.');
			return FALSE;
		}

		return TRUE;
	}
}

/* End of file account.php */
/* Location: ./application/controllers/account.php */