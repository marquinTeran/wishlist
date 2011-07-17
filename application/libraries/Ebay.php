<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Ebay Class
 *
 * @package		Wishlist
 * @subpackage	Libraries
 * @category	Product Integration
 * @author		Joseph Wynn
 * @since		Version 0.1
 */
class Ebay {

	/**
	 * eBay API URL
	 * @var string
	 */
	private $url = 'http://svcs.ebay.com/services/search/FindingService/v1';

	/**
	 * eBay API version (SERVICE-VERSION)
	 * @var string
	 */
	private $version = '1.0.0';

	/**
	 * eBay API AppID
	 * @var string
	 */
	private $application_id = 'WildlyIn-9807-4a47-bcdf-6347233c49b0';

	/**
	 * This array determines which eBay site to use based on the selected language.
	 * Format is [language] => [site], e.g. english => EBAY-US
	 * @var array
	 */
	private $ebay_sites = array();

	/**
	 * Site to use if there is no site corresponding to the selected language
	 * @var string
	 */
	private $default_site = 'EBAY-GB';

	/**
	 * Site currently in use
	 * @var string
	 */
	private $site;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->site = $this->_get_site();
	}

	/**
	 * Search eBay for related items
	 *
	 * @param	string	$item
	 * @param	int		$limit
	 * @return	array
	 */
	public function get_recommendations($item, $limit = 1)
	{
		$url = $this->_build_api_url('findItemsIneBayStores');
		$url .= "&paginationInput.entriesPerPage={$limit}";
		$url .= '&keywords=' . $this->_sanitise($item);

		$response = $this->_make_api_call($url);

		if ($response->ack == 'Success')
		{
			return $response;
		}
		else
		{
			// TODO: Throw something here
		}
	}

	/**
	 * Build the URL for an API call
	 *
	 * @param	string	$operation
	 * @return	string
	 */
	private function _build_api_url($operation)
	{
		return "{$this->url}?OPERATION-NAME={$operation}&SERVICE-VERSION={$this->version}" .
				"&SECURITY-APPNAME={$this->application_id}&GLOBAL-ID={$this->site}";
	}

	/**
	 * Make an API call using cURL and simplexml
	 *
	 * Set CURLOPT_HEADER to TRUE for debugging.
	 *
	 * @param	string	$url
	 * @return
	 */
	private function _make_api_call($url)
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
	private function _sanitise($string)
	{
		return urlencode($string);
	}

}