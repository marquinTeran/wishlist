<?=$new_item_form?>

<ul id="wishlist-items">
	<?php if ( ! empty($wishlist_items)): ?>
		<?=$wishlist_items?>
	<?php else: ?>
		<li>There are no items in this wish list.</li>
	<?php endif; ?>
</ul>
