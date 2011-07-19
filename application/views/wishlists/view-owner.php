<?php if ($wishlist->isPublic()): ?>
	<p>This wish list can be <?=anchor("wishlists/share/{$wishlist->getId()}", 'viewed by everybody')?>. Don't feel like sharing? <?=anchor('', 'Make this wish list private')?></p>
<?php else: ?>
	<p>This wish list is private. Want to share it with friends and family? <?=anchor('', 'Make this wish list public')?></p>
<?php endif; ?>

<?=$new_item_form?>

<ul id="wishlist-items">
	<?php if ( ! empty($wishlist_items)): ?>
		<?=implode('', $wishlist_items)?>
	<?php else: ?>
		<li>There are no items in this wish list.</li>
	<?php endif; ?>
</ul>