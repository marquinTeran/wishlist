<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wishlists extends WL_Controller {

	/**
	 * Display the current user's wishlist
	 *
	 * @return  void
	 */
	public function index()
	{
		$this->auth->require_login();

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
				$wishlist = new \models\Wishlist;
				$wishlist->setName($wishlist_name);
				$wishlist->setUser($this->user);
				$wishlist->setPublic($this->user->getSetting('default_public_wishlist')->getValue());

				$this->em->persist($wishlist);
				$this->em->flush();

				set_status('Woohoo! Your wish list was created. Why not ' . anchor("wishlists/{$wishlist->getId()}", 'add some things to it') . ' now?', 'success');
			}
			else
			{
				set_status('Sorry, your wish list name is too long.', 'error');
			}
		}

		redirect('wishlists');
	}

	/**
	 * View a wishlist
	 *
	 * @param   int		$wishlist_id
	 * @param	bool	$public_view	Set to TRUE to force public view
	 * @return  void
	 */
	public function view($wishlist_id = NULL, $public_view = FALSE)
	{
		if ( ! $wishlist_id || ! $wishlist = $this->em->getRepository('\models\Wishlist')->find($wishlist_id))
		{
			show_404();
		}

		$wishlist_items = array();

		foreach ($wishlist->getItems() as $wishlist_item)
		{
			$wishlist_items[] = $this->load->view('wishlists/wishlist-item', array(
				'wishlist_item' => $wishlist_item
			), TRUE);
		}

		if ($wishlist->getUser() == $this->user && ! $public_view)
		{
			// Wishlist belongs to this user
			$this->template->title($wishlist->getName())
				->addScript('js/view-wishlist.js')
				->build('wishlists/view-owner', array(
					'wishlist' => $wishlist,
					'wishlist_items' => $wishlist_items
				));
		}
		elseif ($wishlist->isPublic())
		{
			// User is not the owner, but this wish list is public
			$this->template->title($wishlist->getName())
				->build('wishlists/view-public', array(
					'wishlist' => $wishlist,
					'wishlist_items' => $wishlist_items
				));
		}
		else
		{
			// User is not logged in and wishlist is not public
			permission_error();
		}
	}

	/**
	 * The 'public' view of a wish list
	 *
	 * @param	int		$wishlist_id
	 * @return	void
	 */
	public function share($wishlist_id = NULL)
	{
		$this->view($wishlist_id, TRUE);
	}

	/**
	 * Add a WishlistItem to a Wishlist
	 *
	 * @param   int	 $wishlist_id
	 * @return  void
	 */
	public function add_item($wishlist_id = NULL)
	{
		if ( ! $wishlist_id || ! $wishlist = $this->em->getRepository('\models\Wishlist')->find($wishlist_id))
		{
			show_404();
		}

		$this->form_validation->set_rules('item_name', 'item name', 'max_length[255]');

		if ($item_name = $this->input->post('item_name'))
		{
			if ($this->form_validation->run() === TRUE)
			{
				// Create the new WishlistItem
				$item = new \models\WishlistItem;
				$item->setName($item_name);
				$item->setWishlist($wishlist);

				$this->em->persist($item);
				$this->em->flush();

				$status = "{$item_name} has been added to the <em>{$wishlist->getName()}</em> wishlist.";
				$status_class = 'success';
			}
			else
			{
				$status = 'Sorry, the item name was too long.';
				$status_class = 'error';
			}

			if (IS_AJAX)
			{
				echo json_encode(array(
					'status' => $status_class,
					'message' => $status,
					'wishlist_item' => $item->toArray(),
					'new_item_html' => $this->load->view('wishlists/wishlist-item', array(
						'wishlist_item' => $item,
			  			'class' => 'hidden'
					), TRUE)
				));

				return;
			}
		}

		set_status($status, $status_class);
		redirect("wishlists/view/{$wishlist->getId()}");
	}

	/**
	 * Remove a WishlistItem from a User's Wishlist
	 *
	 * @param   int	 $item_id
	 * @return  void
	 */
	public function remove_item($item_id = NULL)
	{
		if ( ! $item_id || ! $wishlist_item = $this->em->getRepository('\models\WishlistItem')->find($item_id))
		{
			show_404();
		}

		if ( ! $wishlist_item->getWishlist()->getUser()->getId() === $this->user->getId())
		{
			permission_error();
		}

		$this->em->remove($wishlist_item);
		$this->em->flush();

		if (IS_AJAX)
		{
			echo json_encode(array(
				'status' => 'success'
			));
		}

	}

	/**
	 * Change the settings of a wish list
	 *
	 * @param	int		$wishlist_id
	 * @return	void
	 */
	public function settings($wishlist_id = NULL)
	{
		if ( ! $wishlist_id || ! $wishlist = $this->em->getRepository('\models\Wishlist')->find($wishlist_id))
		{
			show_404();
		}

		if ( ! $wishlist->getUser()->getId() === $this->user->getId())
		{
			permission_error();
		}

		$wishlist->setPublic($this->input->post('public'));

		$this->em->persist($wishlist);
		$this->em->flush();

		redirect("wishlists/view/{$wishlist_id}");
	}

}

/* End of file wishlists.php */
/* Location: ./application/controllers/wishlists.php */