<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * IW Router Class
 *
 * Overrides set_method() to automatically convert dashes (-) in the URI
 * to underscores (_)
 *
 * @author  Joseph Wynn
 */
class IW_Router extends CI_Router {

    /**
	 * Set the method name
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	function set_method($method)
	{
		$this->method = str_replace('-', '_', $method);
	}

}