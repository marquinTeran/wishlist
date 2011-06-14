<?php

namespace models;

/**
 * models\UserGroup
 */
class UserGroup
{
    /**
     * @var smallint $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var smallint $level
     */
    private $level;

    /**
     * @var models\User
     */
    private $users;

    public function __construct()
    {
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