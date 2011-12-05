// Tell jQuery to run this function every time the document is ready
jQuery(document).ready(function() {
	// Apply jQueryUI tabs functionality on div#content
	$("#accordion").accordion({
		autoHeight: false,
		collapsible: true,
		active: false
	});
});