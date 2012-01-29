<div id="topic">
	<span>
		[<?= $numPosts; ?> replies]<br />
		<button onclick="newPost(<? echo $topic->tid; ?>)">Post Reply</button>
		<button onclick="window.location='/'">Back</button>
	</span>
	<div class="details">
    <h2><?= $topic->title; ?></h2>
    <h5><b>Details:</b><br /><?= $topic->details; ?></h5>
    </div>
	
	<div class="clear"></div>
	<hr>
	<ul>
		<? $i=0; foreach($post->result() as $p) { ?>
			<? if (($i%2)==0) $class='mod'; else $class=''; ?>
			<li>
				<span>
					<? if (($user->rank > 1) || ($user->username == $p->username)) { ?>
						<img title="Delete Post" style="float:left;" src="/static/images/icons/delete.png" onclick="deletePost(<?= $p->pid; ?>)" />
					<? } ?>
					<img class="topic_avatar" src="<?= $p->avatar; ?>" />
					<?= date(DATE_FORMAT, $p->date); ?>
					<br />
					User: <a href="/main/account/<?= $p->username; ?>/"><?= $p->username; ?></a>
				</span>
				<p><? echo $p->text; $i++; ?></p>
				<div class="clear"></div>
			</li>
		<? } if ($i==0) echo '<li><p style="text-align:center;">No Posts</p><div class="clear"></div></li>'; ?>
	</ul>
</div>