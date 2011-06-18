<?php

namespace models;

/**
 * Country
 *
 * @Entity(repositoryClass="models\CountryRepository")
 * @Table(name="country")
 * @author Joseph Wynn
 */
class Country extends BaseModel
{
    /**
     * @var string $iso
     *
     * @Column(name="iso", type="string", length=2, nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $iso;

    /**
     * @var string $name
     *
     * @Column(name="name", type="string", length=80, nullable=false)
     */
    private $name;

    /**
     * @var string $printableName
     *
     * @Column(name="printable_name", type="string", length=80, nullable=false)
     */
    private $printableName;

    /**
     * @var string $iso3
     *
     * @Column(name="iso3", type="string", length=3, nullable=true)
     */
    private $iso3;

    /**
     * @OneToMany(targetEntity="User", mappedBy="country")
     */
    private $users;

    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getName()
    {
    	return ucwords(strtolower($this->name));
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
     * Get printableName
     *
     * @return	string $printableName
     */
    public function getPrintableName()
    {
        return $this->printableName;
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
     * Get users
     *
     * @return	Doctrine\Common\Collections\Collection $users
     */
    public function getUsers()
    {
        return $this->users;
    }

}