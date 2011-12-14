<button class="main-button" onclick="window.location='/'">Back</button>
<p>Admin Panel:</p>
<hr>
<button style="margin-top:25px;" class="main-button" onclick="window.location='/main/register/'">New User</button>
<h3 style="margin-top:25px;text-align:center;">User List</h3>
<ul style="list-style:none;margin:0;padding:0;">
	<? foreach ($user_list->result() as $usr) { ?>
		<li style="line-height:auto;padding:10px;">
			<?= $usr->firstname . ' ' . $usr->lastname; ?>
			AKA <a href="/main/account/<?= $usr->username; ?>">
			<?= $usr->username; ?></a> [<?= $usr->email; ?>]
			<a href="#" onclick="deleteUser(<?= $usr->uid; ?>)">
				<img title="Delete User" style="float:right;" src="/static/images/icons/delete.png" />
			</a>
			<span style="vertical-align:middle;font-size:12px;float:right;margin-right:15px;">
				[uid: <?= $usr->uid; ?>]
			</span>
			<span style="vertical-align:middle;font-size:12px;float:right;margin-right:15px;">
				[<? if ($usr->rank==2) echo 'admin'; else echo 'student'; ?>]
			</span>
		</li>
	<? } ?>
</ul>
<button style="margin-top:25px;" class="main-button" onclick="newCategory()">New Category</button>
<h3 style="margin-top:25px;text-align:center;">Category List</h3>
<ul style="list-style:none;margin:0;padding:0;">
	<? foreach ($category_list->result() as $c) { ?>
		<li style="padding:10px;">
			<?= $c->title; ?>
			<a href="#" onclick="return false">
				<img title="Delete Category" style="float:right;" src="/static/images/icons/delete.png" />
			</a>
			<span style="vertical-align:middle;font-size:12px;float:right;margin-right:15px;">
				[cid: <?= $c->cid; ?>]
			</span>
		</li>
	<? } ?>
</ul>
<button style="margin-top:25px;" class="main-button" onclick="newTopicAdmin()">New Topic</button>
<h3 style="margin-top:25px;text-align:center;">Topic List</h3>
<ul style="list-style:none;margin:0;padding:0;">
	<? foreach ($topic_list->result() as $t) { ?>
		<li style="line-height:auto;padding:10px;">
			<?= $t->title; ?>
			<a href="#" onclick="deleteTopic(<?= $t->tid; ?>)">
				<img title="Delete Topic" style="float:right;" src="/static/images/icons/delete.png" />
			</a>
			<span style="vertical-align:middle;font-size:12px;float:right;margin-right:15px;">
				[tid: <?= $t->tid; ?>]
			</span>
		</li>
	<? } ?>
</ul>