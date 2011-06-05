$('#add-wishlist-item-form').submit(function(e) {
    e.preventDefault();

    $.post($(this).attr('action'), $(this).serialize(), function(data) {
        if (data.status == 'success') {
            $('#wishlist-items').append(data.new_item_html);
        }
    });
});