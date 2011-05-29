<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Authentication Class
 *
 * @package		iWant
 * @subpackage	Libraries
 * @category	Authentication
 * @author		Joseph Wynn
 * @since		Version 0.1
 */
class Authentication {

	/**
	 * Current CodeIgniter instance
	 *
	 * @var	CI_Base
	 */
	private $CI;

    /**
     * Authentication session data
     */
    private $user, $user_id, $logged_in;

	/**
	 * Constructor - get the current CI instance
	 *
	 * @access	public
	 * @return	void
	 */
	public function __construct()
	{
		$this->CI =& get_instance();

		$this->user = unserialize($this->CI->session->userdata('user'));
        $this->user_id = $this->CI->session->userdata('user_id');
        $this->logged_in = $this->CI->session->userdata('logged_in');
    }

	/**
	 * Get an Authenticated User
	 *
	 * This method should only be called if the authentication of the User
	 * has been checked by $this->authenticated().
	 *
	 * NOTE: getUser() will double-check the authentication of the User. If the User
	 * is not authenticated, it will return FALSE.
	 *
	 * @access	public
	 * @return	models\User|bool
	 */
	public function getUser()
	{
		if ($this->authenticated())
		{
			return $this->CI->em->getRepository('models\User')->find($this->user_id);
		}

		return FALSE;
	}

	/**
	 * Authenticate a User
	 *
	 * Store the User object in session
	 * Also store a logged_in flag, and the user_id for extra protection against tampering
	 *
	 * @access	public
     * @param   models\User $user
	 * @return	void
	 */
	public function authenticate($user)
	{
        $this->user = $user;
        $this->user_id = $user->getId();
        $this->logged_in = TRUE;

		$this->CI->session->set_userdata('user', serialize($this->user));
		$this->CI->session->set_userdata('logged_in', $this->logged_in);
		$this->CI->session->set_userdata('user_id', $this->user_id);
	}

	/**
	 * Check if a User is authenticated
	 *
	 * This is based on four things:
	 * 	1. A User object is stored in session
	 * 	2. A user_id is stored in session
	 * 	3. The logged_in flag is set as TRUE
	 * 	4. User->ID matches user_id
	 *
	 * @access	public
	 * @return	bool
	 */
	public function authenticated()
	{
		return $this->user &&
			   $this->user_id &&
			   $this->logged_in &&
			   $this->user->getId() === $this->user_id;
	}

	/**
	 * Log a User In
	 *
	 * Check the supplied username/email and password
	 *
	 *  @access	public
	 *  @param	string	$identifier	either username or email
	 *  @param	string	$password	unencrypted password
	 *  @return	bool
	 */
	public function login($identifier, $password)
	{
		$user = models\User::findUser($identifier);

		if ( ! $user)
		{
			return FALSE; //User doesn't exist
        }

        if (models\User::encryptPassword($password) != $user->getPassword())
        {
            return FALSE; //Incorrect password
		}

		//Authenticate the user
		$this->authenticate($user);
		return TRUE;
	}

	/**
	 * Log a User out
	 *
	 * @access	public
	 * @return	void
	 */
	public function logout()
	{
        $this->user = NULL;
        $this->user_id = NULL;
        $this->logged_in = NULL;
        
		$this->CI->session->unset_userdata('user');
		$this->CI->session->unset_userdata('logged_in');
		$this->CI->session->unset_userdata('user_id');
	}

	/**
	 * Set the access permissions for a controller/method (page)
	 *
	 * Permissions can be a
	 *
	 * If a User doesn't have permission to view this page they will be
	 * redirected to the login page.
	 *
	 * @param	string	$permissions	The permissions required to access the page
	 * @return	void
	 */
	public function set_permissions($permissions = 'user+')
	{
		if ( ! $this->authenticated())
		{
			// TODO: Based on the permissions specified, see if the current User
			// can access the current method
			
			// User does not have permission - redirect to login page
			redirect('account/login?return=' . uri_string());
		}
	}
}