<?php

namespace models;

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

    public function __construct()
    {
    	parent::__construct();

        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return	smallint $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param	string 	$name
     * @return	models\UserGroup
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
     * Set level
     *
     * @param	smallint 	$level
     * @return	models\UserGroup
     */
    public function setLevel($level)
    {
        $this->level = $level;
        return $this;
    }

    /**
     * Get level
     *
     * @return	smallint $level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Add users
     *
     * @param	models\User 	$users
     * @return	models\UserGroup
     */
    public function addUsers(\models\User $users)
    {
        $this->users[] = $users;
        return $this;
    }

    /**
     * Get users
     *
     * @return	Doctrine\Common\Collections\Collection $users
     */
    public function getUsers()
    {
        return $this->users;
    }

}