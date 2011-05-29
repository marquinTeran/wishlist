<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends IW_Controller {

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(); 
    }

    /**
     * 404 error handler
     *
     * @return  void
     * @author  Joseph Wynn
     */
    public function error_404()
    {
        $this->template->title('Page Not Found')
            ->build('error/404');
    }

}

/* End of file error.php */
/* Location: ./application/controllers/error.php */