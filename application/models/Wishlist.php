<?php

namespace models;

/**
 * Wishlist
 *
 * @Entity
 * @Table(name="wishlist")
 * @author Joseph Wynn
 */
class Wishlist extends BaseModel
{
    /**
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @Column(name="url_title", type="string", length=255, nullable=false)
     */
    private $url_title;

	/**
	 * @Column(name="public", type="boolean", nullable=false)
	 */
	private $public;

	/**
	 * @ManyToOne(targetEntity="User", inversedBy="wishlists")
	 */
	private $user;

    /**
     * @OneToMany(targetEntity="WishlistItem", mappedBy="wishlist")
     */
    private $wishlist_items;

    public function __construct()
    {
    	parent::__construct();

        $this->wishlist_items = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Alias for getWishlistItems()
     *
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->getWishlistItems();
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
     * Set name, also set url_title based on name
     *
     * @param	string 	$name
     * @return	models\Wishlist
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->url_title = url_title($name, 'dash', TRUE);
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
     * Set public
     *
     * @param	boolean 	$urlTitle
     * @return	models\Wishlist
     */
    public function setPublic($public)
    {
        $this->public = $public;
        return $this;
    }

    /**
     * Get public
     *
     * @return	string $public
     */
    public function getPublic()
    {
        return $this->public;
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