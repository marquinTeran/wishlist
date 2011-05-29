<?=$new_wishlist_form?>

<?php if (count($wishlists) == 0): ?>
    <p>No wishlists!</p>
<?php else: ?>
    <ul>
    <?php foreach($wishlists as $wishlist): ?>
        <li><?=anchor("wishlists/{$wishlist->getId()}", $wishlist->getName())?></li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>