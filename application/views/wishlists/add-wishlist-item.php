<?=form_open("wishlists/add-item/{$wishlist->getId()}")?>
    <input type="text" name="item_name" id="item_name" maxlength="255" value="<?=set_value('item_name')?>" />
    <button type="submit" name="add_item">Add Item</button>
<?=form_close()?>