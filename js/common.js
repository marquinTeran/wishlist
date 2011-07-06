// Global Variables
var FADE_SPEED = 'fast';

// Ajax-editable text fields
$('.ajax-editable').each(function(index) {
	$(this).click(function() {
		$(this).removeClass('plain-text').attr('title', '');
	});

	$(this).blur(function() {
		make_plain_text($(this));
	});
	
	make_plain_text($(this));
});

function make_plain_text(element) {
	element.addClass('plain-text').attr('title', 'Click to edit');
}