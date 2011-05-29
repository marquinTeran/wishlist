<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Set the 'status' flashdata to be displayed in the status div.
 * The full status is returned after the flashdata has been set.
 *
 * @param   string  $status
 * @param   string  $class
 * @return  string
 */
function set_status($status, $class = '')
{
    $formatted_status = '<span class="' . $class . '">' . $status . '</span>';

    $CI =& get_instance();
    $CI->session->set_flashdata('status', $formatted_status);

    return $formatted_status;
}

/**
 * Recursively print a variable wrapped in <pre> tags
 *
 * @param   $var
 * @param   bool    $exit
 * @return  void
 */
function debug($var, $exit = TRUE)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';

    if ($exit)
    {
        exit;
    }
}