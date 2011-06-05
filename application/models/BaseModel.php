<?php

namespace models;

/**
 * BaseModel Class
 *
 * The base class of most Doctrine models.
 *
 * @package		Wishlist
 * @subpackage	Classes
 * @category	Magic
 * @author		Joseph Wynn
 * @since		Version 0.1
 */
class BaseModel
{

	/**
	 * Constructor
	 * 
	 * @access	public
	 */
	public function __construct()
	{
	}

    /**
     * Convert the model to an array
     *
     * Please note that this method can be very slow and should be avoided where possible.
     *
     * @access  public
     * @return  array
     */
    public function toArray()
    {
        $CI =& get_instance();
        $CI->load->helper('inflector');
        
        $this_as_array = array();

        foreach($this as $property => $value)
        {
            $get_method = camelize('get_' . $property);

            // Try and use the getProperty() method
            try
            {
                $value = $this->$get_method();
            }
            catch (Exception $e)
            {
                // Just use the property as it is
            }

            // If we find another instance of BaseModel, convert it to an array
            if ($value instanceof self)
            {
                $value = $value->toArray();
            }

            $this_as_array[$property] = $value;
        }

        return $this_as_array;
    }

	/**
	 * __call override method
	 *
	 * Attempt to set/get a property. Only supports all-lowercase, underscore-separated
     * properties i.e. $this_is_a_property can be accessed using getThisIsAProperty().
     *
	 * This method differs from __set() and __get(), as we want to be able to have custom get()
	 * and set() methods (e.g. setPassword() encrypts the password before setting it).
	 *
	 * set() methods will return the Object to allow method chaining.
	 *
	 * Note that this method can be very slow and it is recommended that you set up
	 * get() and set() methods where possible.
	 *
	 * @access	public
     * @throws  Exception
	 * @param	string	$method
	 * @param	array	$args
	 * @return	object|mixed
     *
	 */
	public function __call($method, $args)
	{
		// Find words by camelCase (e.g. setUsername, getUserGroup)
		$method_words = preg_split('/(?=[A-Z])/', $method);
		$method_name = $method_words[0];

		// Remove the method name from method_words
		unset($method_words[0]);

		// The remaining method_words make up the property name
		// UserGroup becomes user_group
		$property = strtolower(implode('_', $method_words));

		if ($method_name != 'set' && $method_name != 'get')
		{
            throw new Exception("Tried to call undefined function {$method}() on class " . get_class($this));
		}

		// Property doesn't exist
		if ( ! property_exists($this, $property))
		{
            throw new Exception("Tried to call {$method}() on " . get_class($this) . ". Property '{$property}' doesn't exist.");
		}

		// Set() methods
		if ($method_name == 'set')
		{
			// More than one argument was given
			if (count($args) > 1)
			{
                throw new Exception("Tried to set " . get_class($this) . "->{$property}. 1 argument expected; " . count($args) . " given.");
			}

			$this->$property = $args[0];
			return $this;
		}

		// Get() methods
		if ($method_name == 'get')
		{
			return $this->$property;
		}
	}
}