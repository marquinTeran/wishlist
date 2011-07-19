<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends WL_Controller {

	/**
	 * Default Page
	 *
	 * @return  void
	 */
	public function index()
	{
		$this->template->title('Welcome')
			->build('about/index');
	}

}

/* End of file about.php */
/* Location: ./application/controllers/about.php */