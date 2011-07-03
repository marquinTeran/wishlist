<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * WL_Controller Class
 *
 * Base controller for all Wishlist controllers
 *
 * @author  Joseph Wynn
 */
class WL_Controller extends CI_Controller {

	/**
	 * Doctrine entity manager
	 *
	 * @var EntityManager
	 */
	public $em;

	/**
	 * Shortcut for $this->auth->authenticated()
	 *
	 * @var bool
	 */
	protected $authenticated;

	/**
	 * Current user
	 *
	 * @var \models\User
	 */
	protected $user;

	/**
	 * Constructor
	 * 
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();

		// Define the IS_AJAX constant
		if ( ! defined('IS_AJAX'))
		{
			define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
		}

		// Load the Doctrine library and entity manager
		$this->load->library('doctrine');
		$this->em = $this->doctrine->em;

		// Load the authentication library with alias 'auth'
		$this->load->library('authentication', NULL, 'auth');

		// Configure some libraries
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

		if ($this->authenticated = $this->auth->authenticated())
		{
			$this->user = $this->auth->getUser();
			$account_menu = 'navigation/user-menu';

			// Set the site language to the user's language
			$available_languages = $this->config->item('available_languages');
			$language = $this->user->getLanguage();
			$this->config->set_item('language', $available_languages[$language]['folder']);
		}
		else
		{
			$account_menu = 'navigation/guest-menu';
		}

		// Load the site-wide language file
		// This can't be auto-loaded as we need to set the user's language first
		$this->lang->load('site_wide');

		// Default navigation
		$this->load->vars(array(
			'navigation_menu' => $this->load->view('navigation/default', NULL, TRUE),
			'account_menu' => $this->load->view($account_menu, array('user' => $this->user), TRUE),
			'available_languages' => $this->config->item('available_languages')
		));
	}

}

/* End of file WL_Controller.php */
/* Location: ./application/core/WL_Controller.php */