			<!-- End of content div -->
			</div>
			<!-- Footer div at the bottom of every page -->
			<div id="footer">
				Copyright &copy; 2011 TheMagicSchoolB.us
			</div>
		</div>
	</body>
	<? if ($user) { ?>
	<div title="New Topic" id="newTopic">
		<form method="post" action="/main/newTopic/">
			<input type="hidden" name="category" id="newTopic-category" />
			<input type="hidden" name="user" value="<?= $user->uid; ?>" />
			<label for="newTopic-title">Title: </label>
			<input type="text" name="title" id="newTopic-title" />
			<label for="newTopic-details">Details: </label><br />
			<textarea id="newTopic-details" name="details"></textarea>
		</form>
	</div>
	<div title="New Post" id="newPost">
		<form method="post" action="/main/newPost/">
			<input type="hidden" name="topic" id="newPost-topic" />
			<input type="hidden" name="user" value="<?= $user->uid; ?>" />
			<label for="newPost-text">Details: </label><br />
			<textarea id="newPost-text" name="text"></textarea>
		</form>
	</div>
	<? } ?>
</html>