<?php

namespace models;

/**
 * models\WishlistItem
 */
class WishlistItem
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
     * @var smallint $sort_order
     */
    private $sort_order;

    /**
     * @var models\Wishlist
     */
    private $wishlist;


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
     * @return	models\WishlistItem
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
     * Set sort_order
     *
     * @param	smallint 	$sortOrder
     * @return	models\WishlistItem
     */
    public function setSortOrder($sortOrder)
    {
        $this->sort_order = $sortOrder;
        return $this;
    }

    /**
     * Get sort_order
     *
     * @return	smallint $sortOrder
     */
    public function getSortOrder()
    {
        return $this->sort_order;
    }

    /**
     * Set wishlist
     *
     * @param	models\Wishlist 	$wishlist
     * @return	models\WishlistItem
     */
    public function setWishlist(\models\Wishlist $wishlist)
    {
        $this->wishlist = $wishlist;
        return $this;
    }

    /**
     * Get wishlist
     *
     * @return	models\Wishlist $wishlist
     */
    public function getWishlist()
    {
        return $this->wishlist;
    }
}