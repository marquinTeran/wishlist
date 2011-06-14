<?php

namespace models;

/**
 * models\Country
 */
class Country
{
    /**
     * @var string $iso
     */
    private $iso;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $printableName
     */
    private $printableName;

    /**
     * @var string $iso3
     */
    private $iso3;

    /**
     * @var models\User
     */
    private $users;

    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get iso
     *
     * @return	string $iso
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * Set name
     *
     * @param	string 	$name
     * @return	models\Country
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
     * Set printableName
     *
     * @param	string 	$printableName
     * @return	models\Country
     */
    public function setPrintableName($printableName)
    {
        $this->printableName = $printableName;
        return $this;
    }

    /**
     * Get printableName
     *
     * @return	string $printableName
     */
    public function getPrintableName()
    {
        return $this->printableName;
    }

    /**
     * Set iso3
     *
     * @param	string 	$iso3
     * @return	models\Country
     */
    public function setIso3($iso3)
    {
        $this->iso3 = $iso3;
        return $this;
    }

    /**
     * Get iso3
     *
     * @return	string $iso3
     */
    public function getIso3()
    {
        return $this->iso3;
    }

    /**
     * Add users
     *
     * @param	models\User 	$users
     * @return	models\Country
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