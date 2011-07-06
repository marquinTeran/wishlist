<?=$new_item_form?>

<ul id="wishlist-items">
	<?php if ( ! empty($wishlist_items)): ?>
		<?=$wishlist_items?>
	<?php else: ?>
		<li>There are no items in this wish list.</li>
	<?php endif; ?>
</ul>

<h3>Recommended Items</h3>
<ul id="recommendations">
<?php foreach ($wishlist->getItems() as $item): ?>
	<li><?php print_r($item->getRecommendedItems()); ?></li>
<?php endforeach; ?>
</ul>
