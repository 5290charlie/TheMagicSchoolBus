<button class="main-button" onclick="window.location='/'">Back</button>
<p>Admin Panel:</p>
<hr>
<button style="margin-top:25px;" class="main-button" onclick="window.location='/main/register/'">New User</button>
<h3 style="margin-top:25px;text-align:center;">User List</h3>
<hr>
<table class="admin">
	<tr>
		<th>UID</th>
		<th>Firstname</th>
		<th>Lastname</th>
		<th>Email</th>
		<th>Username</th>
		<th>Year</th>
		<th>Rank</th>
		<th></th>
	</tr>
	<? foreach ($user_list->result() as $usr) { ?>
		<tr>
			<td><?= $usr->uid;?></td>
			<td><?= $usr->firstname;?></td>
			<td><?= $usr->lastname;?></td>
			<td><?= $usr->email;?></td>
			<td><a href="/main/account/<?= $usr->username; ?>/"><?= $usr->username; ?></a></td>
			<td><?= $usr->year;?></td>
			<td><? if ($usr->rank==2) echo 'admin'; else echo 'student'; ?></td>
			<td><img title="Delete User" onclick="deleteUser(<?= $usr->uid; ?>)" src="/static/images/icons/delete.png" /></td>
		</tr>
	<? } ?>
</table>
<hr>
<button style="margin-top:25px;" class="main-button" onclick="newCategory()">New Category</button>
<h3 style="margin-top:25px;text-align:center;">Category List</h3>
<hr>
<table class="admin">
	<tr>
		<th>CID</th>
		<th>Title</th>
		<th>UID</th>
		<th>Updated</th>
		<th></th>
	</tr>
	<? foreach ($category_list->result() as $c) { ?>
		<tr>
			<td><?= $c->cid; ?></td>
			<td><?= $c->title; ?></td>
			<td><?= $c->uid; ?></td>
			<td><?= date(DATE_FORMAT, $c->updated); ?></td>
			<td><img title="Delete Category" onclick="deleteCategory(<?= $c->cid; ?>)" src="/static/images/icons/delete.png" /></td>
		</tr>
	<? } ?>
</table>
<hr>
<button style="margin-top:25px;" class="main-button" onclick="newTopicAdmin()">New Topic</button>
<h3 style="margin-top:25px;text-align:center;">Topic List</h3>
<hr>
<table class="admin">
	<tr>
		<th>TID</th>
		<th>Title</th>
		<th>Details</th>
		<th>CID</th>
		<th>UID</th>
		<th>Updated</th>
		<th>Views</th>
		<th></th>
	</tr>
	<? foreach ($topic_list->result() as $t) { ?>
		<tr>
			<td><?= $t->tid; ?></td>
			<td><?= $t->title; ?></td>
			<td><?= $t->details; ?></td>
			<td><?= $t->cid; ?></td>
			<td><?= $t->uid; ?></td>
			<td><?= date(DATE_FORMAT, $t->updated); ?></td>
			<td><?= $t->views; ?></td>
			<td><img title="Delete Topic" onclick="deleteTopic(<?= $t->tid; ?>)" src="/static/images/icons/delete.png" /></td>
		</tr>
	<? } ?>
</table>