<?php

namespace models;

use \Doctrine\Common\Collections\ArrayCollection;

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
    protected $id;

    /**
     * @Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @Column(name="url_title", type="string", length=255, nullable=false)
     */
    protected $url_title;

	/**
	 * @ManyToOne(targetEntity="User", inversedBy="wishlists")
	 */
	protected $user;

    /**
     * @OneToMany(targetEntity="WishlistItem", mappedBy="wishlist")
     */
    protected $wishlist_items;

	/**
	 * Constructor
	 *
	 * Initialize ArrayCollection objects
	 */
    public function __construct()
    {
    	parent::__construct();

		$this->wishlist_items = new ArrayCollection();
    }

    /**
     * When the Wishlist name is set, automatically set the url_title as well
     *
     * @param   string  $name
     * @return  Watchlist
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->url_title = url_title($name, 'dash', TRUE);
    }

    /**
     * Set the User that this Wishlist belongs to
     *
     * @param   User    $user
     * @return  Wishlist
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get all items in this list
     *
     * @return	ArrayCollection
     */
    public function getWishlistItems()
    {
    	return $this->wishlist_items->toArray();
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
}