<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * WL Router Class
 *
 * Overrides _set_request() to automatically convert dashes (-) in the URI to underscores (_)
 *
 * @author  Joseph Wynn
 */
class WL_Router extends CI_Router {

	/**
	 * Set the Route
	 *
	 * This function takes an array of URI segments as
	 * input, and sets the current class/method
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	void
	 */
	function _set_request($segments = array())
    {
        for ( $i = 0; $i < 2; $i++ )
        {
            if ( isset($segments[ $i ]) && strpos($segments[ $i ], '-') !== FALSE )
            {
                $segments[ $i ] = str_replace('-', '_', $segments[ $i ]);
            }
        }

        return parent::_set_request($segments);
	}

}