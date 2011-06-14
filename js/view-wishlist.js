$('#add-wishlist-item-form').submit(function(e) {
    e.preventDefault();

    $.post($(this).attr('action'), $(this).serialize(), function(data) {
        if (data.status == 'success') {
            $('#item-name').val('');
            $('#wishlist-items').append(data.new_item_html).fadeIn(FADE_SPEED);
        }
    }, 'json');
});

$('#wishlist-items').delegate('.remove-item', 'click', function(e) {
    e.preventDefault();

    var row = $(this).parent('li');

    $.get($(this).attr('href'), function(data) {
        if (data.status == 'success') {
            row.fadeOut(FADE_SPEED).remove();
        }
    }, 'json');
});