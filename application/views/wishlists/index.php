<?=$new_wishlist_form?>

<?php if (count($wishlists) == 0): ?>
	<p class="notice">You don't have any wish lists!</p>
<?php else: ?>
	<ul>
	<?php foreach($wishlists as $wishlist): ?>
		<li><?=anchor("wishlists/{$wishlist->getId()}", "{$wishlist->getName()} (" . count($wishlist->getItems()) . " items)")?></li>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>