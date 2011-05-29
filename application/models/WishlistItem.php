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
    protected $id;

    /**
     * @Column(name="name", type="string", length=16, nullable=false)
     */
    protected $name;

    /**
     * @Column(name="sort_order", type="smallint", nullable=false)
     */
    protected $sort_order;

	/**
	 * @ManyToOne(targetEntity="Wishlist", inversedBy="wishlist_items")
	 */
	protected $wishlist;

    /**
     * Set the Wishlist that this WishlistItem belongs to
     *
     * @param   Wishlist    $wishlist
     * @return  WishlistItem
     */
    public function setWishlist(Wishlist $wishlist)
    {
        $this->wishlist = $wishlist;
        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSortOrder($sort_order)
    {
        $this->sort_order = $sort_order;
    }

    public function getSortOrder()
    {
        return $this->sort_order;
    }

}