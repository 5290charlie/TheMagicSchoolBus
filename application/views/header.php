<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="/static/images/icons/favicon.ico" />
		<link href="/static/less/style.less" rel="stylesheet/less" type="text/css" />
		<link href="/static/css/jqueryUI.css" rel="stylesheet" type="text/css" />
        <link href="/static/css/style.css" rel="stylesheet" type="text/css" />
		<script src="/static/js/jquery.js" type="text/javascript"></script>
		<script src="/static/js/jqueryUI.js" type="text/javascript"></script>
		<script src="/static/js/functions.js" type="text/javascript"></script>
		<script src="/static/js/less.js" type="text/javascript"></script>
		<title>CUCS</title>
	</head>
	<body>
		<div id="container">
			<!-- This is where the user can login/logout (edit account/etc) -->
			<div id="userstatus">
				<?php if ($user) { ?>
					Welcome, <?= $user->username; ?> | <a href="/main/account/<?= $user->username; ?>">account</a> 
					<? if ($user->rank > 1) { ?>| <a href="/main/admin/">admin</a> <? } ?>
					| <a href="/main/logout/">logout</a>
				<?php } else { ?>
					You are not logged in
				<?php } ?>
			</div>
			<!-- The header section (just title for now) at the top of every page -->
			<div onclick="window.location='/'" id="header">
				CUCS Forums
			</div>
			<!-- Content div begins in header.php and ends in footer.php -->
			<div id="content">