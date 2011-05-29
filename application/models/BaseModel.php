<?php

namespace models;

/**
 * BaseModel Class
 *
 * The base class of most Doctrine models.
 *
 * @package		iWant
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
	 * Magic __call method
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
	 * @param	string	$method
	 * @param	array	$args
	 * @return	object|mixed
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
			show_error("<strong>Fatal Error:</strong> Tried to call undefined function {$method}() on class " . get_class($this) . ". (Caught by BaseModel::__call())");
		}

		// Property doesn't exist
		if ( ! property_exists($this, $property))
		{
			show_error("<strong>Fatal Error:</strong> Tried to call {$method}() on " . get_class($this) . ". Property '{$property}' doesn't exist.");
		}

		// Set() methods
		if ($method_name == 'set')
		{
			// More than one argument was given
			if (count($args) > 1)
			{
				show_error("<strong>Fatal Error:</strong> Tried to set " . get_class($this) . "->{$property}. 1 argument expected; " . count($args) . " given.");
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