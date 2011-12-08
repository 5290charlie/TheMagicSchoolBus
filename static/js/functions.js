// Tell jQuery to run this function every time the document is ready
jQuery(document).ready(function() {
	// Apply jQueryUI tabs functionality on div#content
	$("#accordion").accordion({
		autoHeight: false,
		collapsible: true
	});
	
	$("button").button();
	
	$("#newTopic").dialog({
		resizable: false,
		buttons: {
			"Cancel": function() {
				$(this).dialog('close');
			},
			"Submit": function() {
				$("#newTopic form").submit();
			}
		}
	});
	
	$("#newPost").dialog({
		resizable: false,
		buttons: {
			"Cancel": function() {
				$(this).dialog('close');
			},
			"Submit": function() {
				$("#newPost form").submit();
			}
		}
	});
	
	$("#newTopic, #newPost").dialog('close');
});

function newTopic(cid) {
	$("#newTopic-category").val(cid);
	$("#newTopic").dialog('open');
}

function newPost(tid) {
	$("#newPost-topic").val(tid);
	$("#newPost").dialog('open');
}