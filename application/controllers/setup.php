<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This controller sets up default records in the database
 */
class Setup extends WL_Controller {

	public function index()
	{
		$group = new \models\UserGroup;
		$group->setName('User');
		$group->setLevel(1);
		$this->em->persist($group);

		$group = new \models\UserGroup;
		$group->setName('Admin');
		$group->setLevel(8);
		$this->em->persist($group);

		$group = new \models\UserGroup;
		$group->setName('Super Admin');
		$group->setLevel(9);
		$this->em->persist($group);

		$this->em->flush();
	}

}