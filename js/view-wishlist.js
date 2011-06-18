$('#add-wishlist-item-form').submit(function(e) {
    e.preventDefault();

    $.post($(this).attr('action'), $(this).serialize(), function(data) {
        if (data.status == 'success') {
			var new_item = $(data.new_item_html);
            $('#item-name').val('');
			new_item.appendTo($('#wishlist-items')).fadeIn(FADE_SPEED);
        }
    }, 'json');
});

$('#wishlist-items').delegate('.remove-item', 'click', function(e) {
    e.preventDefault();

    var row = $(this).parent('li');

    $.get($(this).attr('href'), function(data) {
        if (data.status == 'success') {
            row.fadeOut(FADE_SPEED, function() {
				$(this).remove();
			});
        }
    }, 'json');
});