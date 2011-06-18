<?php

namespace models;

/**
 * WishlistItem
 *
 * @Entity
 * @Table(name="wishlist_item")
 * @author Joseph Wynn
 */
class WishlistItem extends BaseModel
{
    /**
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Column(name="name", type="string", length=16, nullable=false)
     */
    private $name;

    /**
     * @Column(name="sort_order", type="smallint", nullable=true)
     */
    private $sort_order;

	/**
	 * @ManyToOne(targetEntity="Wishlist", inversedBy="wishlist_items")
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