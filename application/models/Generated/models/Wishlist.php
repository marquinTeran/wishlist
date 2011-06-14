<?php

namespace models;

/**
 * models\Wishlist
 */
class Wishlist
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $url_title
     */
    private $url_title;

    /**
     * @var models\User
     */
    private $user;

    /**
     * @var models\WishlistItem
     */
    private $wishlist_items;

    public function __construct()
    {
        $this->wishlist_items = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param	string 	$name
     * @return	models\Wishlist
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return	string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set url_title
     *
     * @param	string 	$urlTitle
     * @return	models\Wishlist
     */
    public function setUrlTitle($urlTitle)
    {
        $this->url_title = $urlTitle;
        return $this;
    }

    /**
     * Get url_title
     *
     * @return	string $urlTitle
     */
    public function getUrlTitle()
    {
        return $this->url_title;
    }

    /**
     * Set user
     *
     * @param	models\User 	$user
     * @return	models\Wishlist
     */
    public function setUser(\models\User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return	models\User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add wishlist_items
     *
     * @param	models\WishlistItem 	$wishlistItems
     * @return	models\Wishlist
     */
    public function addWishlistItems(\models\WishlistItem $wishlistItems)
    {
        $this->wishlist_items[] = $wishlistItems;
        return $this;
    }

    /**
     * Get wishlist_items
     *
     * @return	Doctrine\Common\Collections\Collection $wishlistItems
     */
    public function getWishlistItems()
    {
        return $this->wishlist_items;
    }
}