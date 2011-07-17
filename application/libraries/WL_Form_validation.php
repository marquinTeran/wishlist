<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * WL_Form_validation Class
 *
 * Extends the CI_Form_validation class to add custom validation methods
 *
 * @author  Joseph Wynn
 */
class WL_Form_validation extends CI_Form_validation {


	/**
	 * Required Select
	 *
	 * Alias for required, allowing the use of a different error message for select/radio inputs
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function required_select($str)
	{
		return parent::required($str);
	}

}

/* End of file WL_Form_validation.php */
/* Location: ./application/libraries/WL_Form_validation.php */