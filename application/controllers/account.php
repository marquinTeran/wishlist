<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends IW_Controller {

	public function __construct()
	{
		parent::__construct();
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
				 ->title('Log In')
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
		$this->form_validation->set_rules('username', 'a username', 'required|alpha_dash|max_length[32]|callback__unique_username');
		$this->form_validation->set_rules('password', 'a password', 'required|min_length[6]|matches[password_confirm]');
		$this->form_validation->set_rules('email', 'your email address', 'required|valid_email|callback__unique_email');
		$this->form_validation->set_rules('country', 'country', 'required|alpha|exact_length[2]');

		$this->form_validation->set_message('matches', "The passwords don't match!");

		if ($this->form_validation->run() === FALSE)
		{
			$this->template
				 ->title('Sign Up')
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

			// Set the User's country
			$country = $this->em->getRepository('models\Country')->find($this->input->post('country'));
			$user->setCountry($country);

			// Set the User's group
			$group = $this->em->getRepository('models\UserGroup')->findOneByName('User');
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

		$this->form_validation->set_message('_check_username', 'That username is already in use.');
		return FALSE;
	}

	/**
	 * Validate an Email
	 *
	 * Check if a User with that email already exists
	 *
	 * @access	public
	 * @param	string	$email
	 * @return	bool
	 */
	public function _unique_email($email)
	{
		$user = $this->em->getRepository('models\User')->findOneByEmail($email);

		if ( ! $user)
		{
			// The email is free
			return TRUE;
		}

		$this->form_validation->set_message('_check_email', 'That email is already in use. ' . anchor('user/forgot-password', 'Reset Password'));
		return FALSE;
	}
}

/* End of file account.php */
/* Location: ./application/controllers/account.php */