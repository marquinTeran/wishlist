<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends IW_Controller {

	/**
	 * Constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();
	}

    /**
     * Default Page
     *
     * @return  void
     */
    public function index()
    {
		$this->template->title('Wishlist')
            ->build('about/index');
    }

}

/* End of file about.php */
/* Location: ./application/controllers/about.php */