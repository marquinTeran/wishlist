<?php

namespace models;

use \Doctrine\Common\Collections\ArrayCollection;

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
	protected $id;

	/**
	 * @Column(type="string", length=32, unique=true, nullable=false)
	 */
	protected $username;

	/**
	 * @Column(type="string", length=64, nullable=false)
	 */
	protected $password;

	/**
	 * @Column(type="string", length=255, unique=true, nullable=false)
	 */
	protected $email;

	/**
	 * @ManyToOne(targetEntity="Country", inversedBy="users")
	 * @JoinColumn(name="country_iso", referencedColumnName="iso")
	 */
	protected $country;

	/**
	 * @ManyToOne(targetEntity="UserGroup", inversedBy="users")
	 */
	protected $user_group;

    /**
     * @OneToMany(targetEntity="Wishlist", mappedBy="user")
     */
    protected $wishlists;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->wishlists = new ArrayCollection();
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
	 * Set the User's country
	 *
	 * @param	Country		$country
	 * @return	User
	 */
	public function setCountry(Country $country)
	{
		$this->country = $country;
        return $this;
	}

    /**
     * Get all of this User's Wishlists
     *
     * @return  
     */
    public function getWishlists()
    {
        return $this->wishlists;
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
}