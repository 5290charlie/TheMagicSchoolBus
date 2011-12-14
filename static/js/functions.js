// Tell jQuery to run this function every time the document is ready
jQuery(document).ready(function() {
	// Apply jQueryUI tabs functionality on div#content
	$("#accordion").accordion({
		autoHeight: false,
		collapsible: true,
		icons: false
	});
	
	if ($("#autoFocus").val() != "")
		$($("#autoFocus").val()).focus();
	
	$("button, .button").button();
	
	$("#newTopic").dialog({
		height: 350,
		width: 400,
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
		height: 250,
		width: 400,
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
	
	$("#newCategory").dialog({
		height: 250,
		width: 400,
		resizable: false,
		buttons: {
			"Cancel": function() {
				$(this).dialog('close');
			},
			"Submit": function() {
				$("#newCategory form").submit();
			}
		}
	});
	
	
	$("#newTopic, #newPost, #newCategory").dialog('close');
});

function newTopic(cid) {
	$("#newTopic-category").val(cid);
	$("#newTopic").dialog('open');
}

function newTopicAdmin() {
	var cid = prompt('CategoryID (cid):');
	if (cid != null) {
		$("#newTopic-category").val(cid);
		$("#newTopic").dialog('open');
	} else {
		return false;
	}
}

function newPost(tid) {
	$("#newPost-topic").val(tid);
	$("#newPost").dialog('open');
}

function newCategory() {
	$("#newCategory").dialog('open');
}

function deleteTopic(tid) {
	if (confirm('Are you sure?'))
		window.location = "/main/deleteTopic/" + tid;
	else
		return false;
}

function deletePost(pid) {
	if (confirm('Are you sure?'))
		window.location = "/main/deletePost/" + pid;
	else
		return false;
}

function deleteUser(uid) {
	if (confirm('Are you sure?'))
		window.location = "/main/deleteUser/" + uid;
	else
		return false;
}