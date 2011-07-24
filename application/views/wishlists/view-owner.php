<?=form_open("wishlists/settings/{$wishlist->getId()}")?>
<?php if ($wishlist->isPublic()): ?>
	<p>
		This wish list can be <?=anchor("wishlists/share/{$wishlist->getId()}", 'viewed by everybody')?>. Don't feel like sharing?
		<button type="submit" name="public" value="0"><span class="lock icon"></span>Make this wish list private</button>
	</p>
<?php else: ?>
	<p>
		This wish list is private. Want to share it with friends and family?
		<button type="submit" name="public" value="1"><span class="unlock icon"></span>Make this wish list public</button>
	</p>
<?php endif; ?>
<?=form_close()?>

<?=form_open("wishlists/add-item/{$wishlist->getId()}", 'id="add-wishlist-item-form"')?>
	<input type="text" name="item_name" id="item-name" maxlength="255" value="<?=set_value('item_name')?>" />
	<button type="submit" name="add_item" class="positive"><span class="plus icon"></span>Add Item</button>
<?=form_close()?>

<ul id="wishlist-items">
	<?php if ( ! empty($wishlist_items)): ?>
		<?=implode('', $wishlist_items)?>
	<?php else: ?>
		<li class="empty-wishlist">This wish list is empty!</li>
	<?php endif; ?>
</ul>