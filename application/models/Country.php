<?php

namespace models;

use \Doctrine\Common\Collections\ArrayCollection;

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
    protected $iso;

    /**
     * @var string $name
     *
     * @Column(name="name", type="string", length=80, nullable=false)
     */
    protected $name;

    /**
     * @var string $printableName
     *
     * @Column(name="printable_name", type="string", length=80, nullable=false)
     */
    protected $printableName;

    /**
     * @var string $iso3
     *
     * @Column(name="iso3", type="string", length=3, nullable=true)
     */
    protected $iso3;

    /**
     * @OneToMany(targetEntity="User", mappedBy="country")
     */
    protected $users;

    public function getIso()
    {
    	return $this->iso;
    }

    public function getName()
    {
    	return ucwords(strtolower($this->name));
    }

}