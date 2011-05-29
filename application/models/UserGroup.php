<?php

namespace models;

use \Doctrine\Common\Collections\ArrayCollection;

/**
 * UserGroup
 *
 * @Entity
 * @Table(name="user_group")
 * @author Joseph Wynn
 */
class UserGroup extends BaseModel
{
    /**
     * @Column(name="id", type="smallint", nullable=false)
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(name="name", type="string", length=16, nullable=false)
     */
    protected $name;

    /**
     * @Column(name="level", type="smallint", nullable=false)
     */
    protected $level;

    /**
     * @OneToMany(targetEntity="User", mappedBy="user_group")
     * @OrderBy({"username" = "ASC"})
     */
    protected $users;

	/**
	 * Constructor
	 *
	 * Initialize ArrayCollection objects
	 */
    public function __construct()
    {
    	parent::__construct();

		$this->users = new ArrayCollection();
    }

    /**
     * Get all users in this group
     *
     * @return	ArrayCollection
     */
    public function getUsers()
    {
    	return $this->users->toArray();
    }

}