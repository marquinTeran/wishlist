<?=form_open('wishlists/create')?>
	<input type="text" name="wishlist_name" id="wishlist_name" maxlength="255" value="<?=set_value('wishlist_name')?>" />
	<button type="submit" name="create_wishlist" class="positive"><span class="plus icon"></span>Create New Wishlist</button>
<?=form_close()?>