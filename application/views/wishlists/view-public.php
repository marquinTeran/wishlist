<p>This wish list was created by <?=$wishlist->getUser()->getUsername()?> on </p>

<ul id="wishlist-items">
	<?php if ( ! empty($wishlist_items)): ?>
		<?=implode('', $wishlist_items)?>
	<?php else: ?>
		<li>There are no items in this wish list.</li>
	<?php endif; ?>
</ul>