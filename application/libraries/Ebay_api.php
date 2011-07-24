<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Ebay API Class
 *
 * @package		Wishlist
 * @subpackage	Libraries
 * @category	Product Integration
 * @author		Joseph Wynn
 * @since		Version 0.1
 */
class Ebay_api {

	/**
	 * eBay API AppID
	 * @var string
	 */
	protected $application_id = 'WildlyIn-9807-4a47-bcdf-6347233c49b0';

	/**
	 * This array determines which eBay site to use based on the selected language.
	 * Format is [language] => [site], e.g. english => EBAY-US
	 * @var array
	 */
	protected $ebay_sites = array();

	/**
	 * Site to use if there is no site corresponding to the selected language
	 * @var string
	 */
	protected $default_site = 'EBAY-GB';

	/**
	 * Site currently in use
	 * @var string
	 */
	protected $site;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->site = $this->_get_site();
	}

	/**
	 * Magical class loader
	 *
	 * If the specified class exists in application/libraries/Ebay, return a new
	 * instance of that class
	 *
	 * @param	string	$class
	 * @return	object
	 */
	public function __get($class)
	{
		$class_name = "Ebay_{$class}";
		$class_file = __DIR__ . '/Ebay/' . ucfirst($class) . '.php';

		if (file_exists($class_file))
		{
			require_once $class_file;
			return new $class_name;
		}
	}

	/**
	 * Make an API call using cURL and simplexml
	 *
	 * Set CURLOPT_HEADER to TRUE for debugging.
	 *
	 * @param	string	$url
	 * @return
	 */
	protected function _make_api_call($url)
	{
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($curl, CURLOPT_HEADER, FALSE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

		if ($result = curl_exec($curl))
		{
			return simplexml_load_string($result);
		}
		else
		{
			// TODO: Throw something here
		}
	}

	/**
	 * Return the eBay site identifier (determined by the current language)
	 *
	 * @return	string
	 */
	private function _get_site()
	{
		$ci =& get_instance();
		$language = $ci->config->item('language');

		if (isset($this->ebay_sites[$language]))
		{
			return $this->ebay_sites[$language];
		}
		else
		{
			return $this->default_site;
		}
	}

	/**
	 * Sanitise a string so that it is safe to send to the eBay API
	 *
	 * @param	string	$string
	 * @return	string
	 */
	protected function _sanitise($string)
	{
		return urlencode($string);
	}

}