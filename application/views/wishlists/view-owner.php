<?=$new_item_form?>

<ul id="wishlist-items">
<?php foreach ($wishlist->getItems() as $wishlist_item): ?>
    <li class="wishlist-item"><?=$wishlist_item->getName()?></li>
<?php endforeach; ?>
</ul>
