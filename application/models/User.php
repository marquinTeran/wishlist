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
	 * @ManyToOne(targetEntity="UserGroup", inversedBy="users")
	 */
	private $user_group;

    /**
     * @OneToMany(targetEntity="Wishlist", mappedBy="user")
     */
    private $wishlists;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->wishlists = new \Doctrine\Common\Collections\ArrayCollection();
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
		$admin = $CI->em->getRepository('models\UserGroup')->findOneByName('Admin');

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
     * @param	models\Wishlist 	$wishlists
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
}