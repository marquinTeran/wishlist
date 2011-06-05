<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Template Class
 *
 * @package		Wishlist
 * @subpackage	Libraries
 * @category	Templating
 * @author		Joseph Wynn
 * @since		Version 0.1
 */
class Template {

	/**
	 * Content variables
	 *
	 * @var	string
	 */
	public	$title,
			$long_title,
			$content;

	/**
	 * An array of views containing scripts to be loaded into the template.
     * Converted to a string during build() for direct access in the template layout.
	 *
	 * @var array
	 */
	public $scripts = array();

	/**
	 * CodeIgniter Instance
	 *
	 * @var CI_Controller
	 */
	private $CI;

	/**
	 * The template layout view
	 *
	 * @var string
	 */
	private $layout;

	/**
	 * Max title length
	 *
	 * @var	int
	 */
	private $title_length;

    /**
     * Views to be loaded as variables when the template is build
     *
     * @var array
     */
    private $partials = array();

	/**
	 * Variables to be loaded when the template is built
	 *
	 * @var array
	 */
	private $vars = array();

    /**
     * Script root
     *
     * @var string
     */
    private $script_root;

	/**
	 * Constructor - Get the current CI instance and load the default
	 * configuration options
	 */
	public function __construct()
	{
		$this->CI =& get_instance();

		//Load configuration options
		$this->title_length = $this->CI->config->item('max_title_length');
		$this->layout = $this->CI->config->item('template_default_layout');
		$this->script_root = $this->CI->config->item('script_root');

        if ($this->CI->config->item('prepend_base_url'))
        {
            $this->script_root = base_url() . $this->script_root;
        }
	}

	/**
	 * Set Template Layout
	 *
	 * @access	public
	 * @param	string	$view
	 * @return	Template
	 */
	public function layout($view)
	{
		$this->layout = $view;
		return $this;
	}

	/**
	 * Set Page Title and Long Title
	 *
	 * @access	public
	 * @param	string	$title
	 * @return	Template
	 */
	public function title($title)
	{
		// If the long title isn't already set, use this title
		if ( ! $this->long_title)
		{
			$this->long_title = $title;
		}

		// Trim the title based on the title_length configuration
		if ($this->title_length != 0 && strlen($title) > $this->title_length)
		{
			$title = substr($title, 0, $this->title_length) . '&elipsis;';
		}

		$this->title = $title;
		return $this;
	}

	/**
	 * Set Long Title
	 *
	 * @access	public
	 * @param	string	$title
	 * @return	Template
	 */
	public function longTitle($title)
	{
		$this->long_title = $title;
		return $this;
	}

	/**
	 * Set a Variable
	 *
	 * @access	public
	 * @param	string|array	$vars
	 * @param	mixed           $value
	 * @return	Template
	 */
	public function setVar($vars, $value = NULL)
	{
        if ( ! is_array($vars))
        {
            $vars = array($vars => $value);
        }

        foreach ($vars as $var => $value)
        {
            $this->vars[$var] = $value;
        }

		return $this;
	}

	/**
	 * Unset a Variable
	 *
	 * @access	public
	 * @param	string	$var
	 * @return	Template
	 */
	public function unsetVar($var)
	{
        if (array_key_exists($var, $this->vars))
        {
            unset($this->vars[$var]);
        }

		return $this;
	}

	/**
	 * Add a Script
	 *
	 * @param	string	$script
	 * @return	Template
	 */
	public function addScript($script)
	{
		$this->scripts[] = $script;
		return $this;
	}

    /**
     * Remove a Script
     *
     * @param   string  $script
     * @return  Template
     */
    public function removeScript($script)
    {
        if (array_key_exists($script, $this->scripts))
        {
            unset($this->scripts[$script]);
        }

        return $this;
    }

    /**
     * Add a Partial
     *
     * @param   string|array    $partial
     * @param   string          $view
     * @return  Template
     */
    public function addPartial($partials, $view)
    {
        if ( ! is_array($partials))
        {
            $partials = array($partials => $view);
        }

        foreach ($partials as $partial => $view)
        {
            $this->partials[$partial] = $view;
        }

        return $this;
    }

    /**
     * Remove a Partial
     *
     * @param   string  $partial
     * @return  Template
     */
    public function removePartial($partial)
    {
        if (array_key_exists($partial, $this->partials))
        {
            unset($this->partials[$partial]);
        }

        return $this;
    }

	/**
	 * Build Page
	 *
	 * @access	public
	 * @param	string	$content		the view to assign to $template['content']
	 * @param	array	$vars			any variables to pass to the content view
	 * @param	bool	$return			whether to display the view (FALSE) or return it (TRUE)
	 * @return	string|void
	 */
	public function build($content, $content_vars = array(), $return = FALSE)
	{
		// Make sure content vars are in an array
		if ( ! is_array($content_vars))
		{
			$content_vars = array($content_vars);
		}

		// Set the content vars
		foreach ($content_vars as $index => $value)
		{
			$this->setVar($index, $value);
		}

		// Load the $template var (can be used in scripts, partials, layout and content)
		$this->setVar('template', $this);

        // Load the partials
        foreach ($this->partials as $partial => $view)
        {
            $this->setVar($partial, $this->CI->load->view($view, $this->vars, TRUE));
        }

		// Process the scripts
		foreach ($this->scripts as &$script)
		{
            // First try and load the script as a view
			if (file_exists(APPPATH . 'views/' . $script . '.php'))
			{
				$script = $this->CI->load->view($script, $this->vars, TRUE);
			}
            else
            {
                // The script isn't a valid view. Add it as a <script> element
                $script = '<script type="text/javascript" src="' . rtrim($this->script_root, '/') . '/' . $script . '"></script>';
            }
		}

		// Merge the content of all of the scripts
		$this->scripts = implode('', $this->scripts);

		// Load the content
		$this->content = $this->CI->load->view($content, $this->vars, TRUE);

		// Build the template
		return $this->CI->load->view($this->layout, $this->vars, $return);
	}

}