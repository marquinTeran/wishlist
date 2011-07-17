<?=form_open("wishlists/add-item/{$wishlist->getId()}", 'id="add-wishlist-item-form"')?>
	<input type="text" name="item_name" id="item-name" maxlength="255" value="<?=set_value('item_name')?>" />
	<button type="submit" name="add_item" class="positive"><span class="plus icon"></span>Add Item</button>
<?=form_close()?>