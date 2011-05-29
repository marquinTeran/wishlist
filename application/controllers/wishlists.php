<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wishlists extends IW_Controller {

	/**
	 * Constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();
	}

    /**
     * Display the current user's wishlist
     *
     * @return  void
     */
    public function index()
    {
        $user = new User;
		$this->auth->set_permissions();

        $this->template->title('My Wishlists')
            ->build('wishlists/index', array(
                'wishlists' => $this->user->getWishlists(),
                'new_wishlist_form' => $this->load->view('wishlists/create', NULL, TRUE)
            ));
    }

    /**
     * Create a new wishlist
     *
     * @return void
     */
    public function create()
    {
        $this->form_validation->set_rules('wishlist_name', 'wishlist name', 'max_length[255]');

        if ($wishlist_name = $this->input->post('wishlist_name'))
        {
            if ($this->form_validation->run() === TRUE)
            {
                // Create the new Wishlist
                $wishlist = new models\Wishlist;
                $wishlist->setName($wishlist_name);
                $wishlist->setUser($this->user);

                $this->em->persist($wishlist);
			    $this->em->flush();

                set_status('Woohoo! Your wishlist was created. Why not ' . anchor("wishlists/{$wishlist->getId()}", 'add some things to it') . ' now?', 'success');
            }
            else
            {
                set_status('Sorry, your wishlist name is too long.', 'error');
            }
        }

        redirect('wishlists');
    }

    /**
     * View a wishlist
     *
     * @param   int     $wishlist_id
     * @return  void
     */
    public function view($wishlist_id = NULL)
    {
        if ( ! $wishlist_id || ! $wishlist = $this->em->getRepository('models\Wishlist')->find($wishlist_id))
        {
            show_404();
        }

        if ($wishlist->getUser() === $this->user)
        {
            $this->template->title($wishlist->getName())
                ->addPartial('new_item_form', 'wishlists/add-wishlist-item')
                ->build('wishlists/view-owner', array(
                    'wishlist' => $wishlist
                ));
        }

        // TODO: If the current user has permission to view this wishlist, load wishlists/view-guest
    }

    /**
     * Add a WishlistItem to a Wishlist
     *
     * @param   int     $wishlist_id
     * @return  void
     */
    public function add_item($wishlist_id = NULL)
    {
        if ( ! $wishlist_id || ! $wishlist = $this->em->getRepository('models\Wishlist')->find($wishlist_id))
        {
            show_404();
        }

        $this->form_validation->set_rules('item_name', 'item name', 'max_length[255]');

        if ($item_name = $this->input->post('item_name'))
        {
            if ($this->form_validation->run() === TRUE)
            {
                // Create the new WishlistItem
                $item = new models\WishlistItem;
                $item->setName($item_name);
                $item->setWishlist($wishlist);

                $this->em->persist($item);
                $this->em->flush();
            }
        }
    }

}

/* End of file wishlists.php */
/* Location: ./application/controllers/wishlists.php */