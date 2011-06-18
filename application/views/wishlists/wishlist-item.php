<li class="wishlist-item <?=isset($class) ? $class : ''?>">
	<?=$wishlist_item->getName()?> <?=anchor("wishlists/remove-item/{$wishlist_item->getId()}", 'Remove', 'class="remove-item"')?>
</li>