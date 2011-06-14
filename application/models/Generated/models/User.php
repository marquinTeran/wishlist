<?php

namespace models;

/**
 * models\User
 */
class User
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $username
     */
    private $username;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var models\Country
     */
    private $country;

    /**
     * @var models\UserGroup
     */
    private $user_group;

    /**
     * @var models\Wishlist
     */
    private $wishlists;

    public function __construct()
    {
        $this->wishlists = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set password
     *
     * @param	string 	$password
     * @return	models\User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
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
    public function addWishlists(\models\Wishlist $wishlists)
    {
        $this->wishlists[] = $wishlists;
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