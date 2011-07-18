<?php

namespace models;

/**
 * User
 *
 * @Entity
 * @Table(name="user")
 * @author Joseph Wynn
 */
class User extends BaseModel
{
	/**
	 * The User currently logged in
	 */
	public static $current;

	/**
	 * @Id
	 * @Column(type="integer", nullable=false)
	 * @GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @Column(type="string", length=32, unique=true, nullable=false)
	 */
	private $username;

	/**
	 * @Column(type="string", length=64, nullable=false)
	 */
	private $password;

	/**
	 * @Column(type="string", length=255, unique=true, nullable=false)
	 */
	private $email;

	/**
	 * @ManyToOne(targetEntity="Country", inversedBy="users")
	 * @JoinColumn(name="country_iso", referencedColumnName="iso")
	 */
	private $country;

	/**
	 * @Column(type="string", length=2, nullable=false)
	 */
	private $language;

	/**
	 * @Column(type="string", length=15, nullable=true)
	 */
	private $post_code;

	/**
	 * @ManyToOne(targetEntity="UserGroup", inversedBy="users")
	 */
	private $user_group;

    /**
     * @OneToMany(targetEntity="Wishlist", mappedBy="user", cascade={"persist", "remove"})
     */
    private $wishlists;

	/**
	 * @OneToMany(targetEntity="UserSetting", mappedBy="user", cascade={"persist", "remove"})
	 */
	private $settings;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->wishlists = new \Doctrine\Common\Collections\ArrayCollection();
        $this->settings = new \Doctrine\Common\Collections\ArrayCollection();
    }

	/**
	 * Encrypt the password before we store it
	 *
	 * @access	public
	 * @param	string	$password
	 * @return	User
	 */
	public function setPassword($password)
	{
		$encrypted_password = self::encryptPassword($password);

		$this->password = $encrypted_password;
        return $this;
	}

	/**
	 * Encrypt a Password
	 *
	 * @access	public
	 * @param	string	$password
	 */
	public static function encryptPassword($password)
	{
        $CI =& get_instance();
        
		$salt = $CI->config->item('encryption_key');
		$encrypted_password = sha1($password . $salt);

		return $encrypted_password;
	}

	/**
	 * Authenticate this User by setting self::current to $this
	 *
	 * @return	void
	 */
	public function authenticate()
	{
		self::$current = $this;
	}

	/**
	 * Check if a User's permission level is Admin or higher
	 *
	 * @access	public
	 * @return	bool
	 */
	public function isAdmin()
	{
        $CI =& get_instance();

		//Find the Admin level
		$admin = $CI->em->getRepository('\models\UserGroup')->findOneByName('Admin');

		if ($this->getUserGroup()->getLevel() >= $admin->getLevel())
		{
			//User is Admin or higher
			return TRUE;
		}

		//User is not Admin
		return FALSE;
	}


	/**
	 * Find a User account by username or email
	 *
	 * @access	public
	 * @param	string	$identifier
	 * @return	User|FALSE
	 */
	public static function findUser($identifier)
	{
        $CI =& get_instance();

		$user = $CI->em->createQuery("SELECT u FROM models\User u WHERE u.username = '{$identifier}' OR u.email = '{$identifier}'")
                ->getResult();

		return $user ? $user[0] : FALSE;
	}

    /**
     * Get id
     *
     * @return	integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param	string 	$username
     * @return	models\User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get username
     *
     * @return	string $username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set post_code
     *
     * @param	string 	$post_code
     * @return	models\User
     */
    public function setPostCode($post_code)
    {
        $this->post_code = $post_code;
        return $this;
    }

    /**
     * Get post_code
     *
     * @return	string $post_code
     */
    public function getPostCode()
    {
        return $this->post_code;
    }

    /**
     * Get password
     *
     * @return	string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param	string 	$email
     * @return	models\User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return	string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set country
     *
     * @param	models\Country 	$country
     * @return	models\User
     */
    public function setCountry(\models\Country $country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get country
     *
     * @return	models\Country $country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set language
     *
     * @param	string 	$language
     * @return	models\User
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * Get language
     *
     * @return	string	$country
     */
    public function getLanguage()
    {
        return $this->language;
    }

	/**
	 * Shorthand for setUserGroup
	 *
	 * @access	public
	 * @param	UserGroup	$group
	 * @return	User
	 */
	public function setGroup(UserGroup $group)
	{
		$this->user_group = $group;
        return $this;
	}

	/**
	 * Shorthand for getUserGroup
	 *
	 * @access	public
	 * @return	UserGroup
	 */
	public function getGroup()
	{
		return $this->user_group;
	}

    /**
     * Set user_group
     *
     * @param	models\UserGroup 	$userGroup
     * @return	models\User
     */
    public function setUserGroup(\models\UserGroup $userGroup)
    {
        $this->user_group = $userGroup;
        return $this;
    }

    /**
     * Get user_group
     *
     * @return	models\UserGroup $userGroup
     */
    public function getUserGroup()
    {
        return $this->user_group;
    }

    /**
     * Add wishlists
     *
     * @param	models\Wishlist 	$wishlist
     * @return	models\User
     */
    public function addWishlist(\models\Wishlist $wishlist)
    {
        $this->wishlists[] = $wishlist;
        return $this;
    }

    /**
     * Get wishlists
     *
     * @return	Doctrine\Common\Collections\Collection $wishlists
     */
    public function getWishlists()
    {
        return $this->wishlists;
    }

    /**
     * Add settings
     *
     * @param	models\UserSetting 	$setting
     * @return	models\User
     */
	public function addSetting(\models\UserSetting $setting)
	{
        $this->settings[] = $setting;
        return $this;
    }

    /**
     * Get all settings
     *
     * @return	Doctrine\Common\Collections\Collection $settings
     */
    public function getSettings()
    {
        return $this->settings;
    }

	/**
	 * Get a single setting
	 *
	 * @param	string	$setting_name
	 * @return	mixed
	 */
	public function getSetting($setting_name)
	{
		$CI =& get_instance();

		return $CI->em->getRepository('models\UserSetting')->findOneBy(array(
			'user' => $this->getId(),
			'name' => $setting_name
		));
	}
}