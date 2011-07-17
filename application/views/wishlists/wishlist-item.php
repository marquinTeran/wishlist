<li class="wishlist-item <?=isset($class) ? $class : ''?>">
	<?=$wishlist_item->getName()?> <?=anchor("wishlists/remove-item/{$wishlist_item->getId()}", '<span class="cross icon"></span>Remove', 'class="small negative remove-item button"')?>
</li>