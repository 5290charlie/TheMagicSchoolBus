<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="/static/images/icons/favicon.ico" />
		<link href="/static/less/style.less" rel="stylesheet/less" type="text/css" />
		<link href="/static/css/jqueryUI.css" rel="stylesheet" type="text/css" />
		<script src="/static/js/jquery.js" type="text/javascript"></script>
		<script src="/static/js/jqueryUI.js" type="text/javascript"></script>
		<script src="/static/js/functions.js" type="text/javascript"></script>
		<script src="/static/js/less.js" type="text/javascript"></script>
		<title></title>
	</head>
	<body>
		<div id="container">
			<!-- This is where the user can login/logout (edit account/etc) -->
			<div id="userstatus">
				<?php if ($user) { ?>
					Welcome, <? echo $user->username; ?>
				<?php } else { ?>
					You are not logged in
				<?php } ?>
			</div>
			<!-- The header section (just title for now) at the top of every page -->
			<div id="header">
				TheMagicSchoolB.us
			</div>
			<!-- Content div begins in header.php and ends in footer.php -->
			<div id="content">