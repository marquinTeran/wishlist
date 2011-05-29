<?php

namespace models;

use \Doctrine\ORM\EntityRepository;

/**
 * CountryRepository
 */
class CountryRepository extends EntityRepository
{
	public function getAllCountries()
	{
		return $this->_em->createQuery('SELECT c FROM models\Country c ORDER BY c.name')
						 ->getResult();
	}
}