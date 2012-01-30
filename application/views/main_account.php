<? $myself = ($display_user->username == $user->username); ?>
<button class="main-button" onclick="window.location='/'">Back</button>
<p>
	<? if ($myself)
		echo 'My';
	else
		echo $display_user->username . "'s";
	?> Account:
</p>
<hr>
<? if ($myself) { ?>
	<form id="account-form" enctype="multipart/form-data" method="post" action="/main/updateAccount/<?= $user->uid; ?>/">
<? } ?>
<span class="account_avatar">
	<h2>Avatar</h2>
	<br />
	<img class="account_avatar" src="<?= $display_user->avatar; ?>" />
	<? if($myself) { ?>
		<br />
		<input type="file" name="photo" onchange="document.getElementById('account-form').submit()" /> 
	<? } ?>
</span>
<span class="account_info">
	<h2>User Info</h2>
	<table>
		<tr>
			<td class="right">Firstname:</td>
			<td>
				<? if($myself) { ?>
					<input type="text" id="firstname" name="firstname" value="<?= $user->firstname; ?>" />
				<? } else { echo $display_user->firstname; } ?>
			</td>
		</tr>
		<tr>
			<td class="right">Lastname:</td>
			<td>
				<? if($myself) { ?>
					<input type="text" id="lastname" name="lastname" value="<?= $user->lastname; ?>" />
				<? } else { echo $display_user->lastname; } ?>
			</td>
		</tr>
		<tr>
			<td class="right">Email:</td>
			<td>
				<? if($myself) { ?>
					<input type="email" id="email" name="email" value="<?= $user->email; ?>" />
				<? } else { echo $display_user->email; } ?>
			</td>
		</tr>
		<tr>
			<td class="right">Track:</td>
			<td>
				<? if($myself) { ?>
					<input type="text" id="track" name="track" value="<?= $user->track; ?>" />
				<? } else { echo $display_user->track; } ?>
			</td>
		</tr>
		<tr>
			<td class="right">Year:</td>
			<td>
				<? if($myself) { ?>
					<input type="text" id="year" name="year" value="<?= $user->year; ?>" />
				<? } else { echo $display_user->year; } ?>
			</td>
		</tr>
		<tr>
			<td class="right">Bio:</td>
			<td>
				<? if($myself) { ?>
					<textarea id="bio" name="bio"><?= $user->bio; ?></textarea>
				<? } else { echo $display_user->bio; } ?>
			</td>
		</tr>
	<? if ($myself) { ?>
		<tr>
			<td class="right">New Password:</td>
			<td>
				<input type="password" id="password" name="password" />
			</td>
		</tr>
		<tr>
			<td class="right">Confirm Password:</td>
			<td>
				<input type="password" id="confirm" name="confirm" />
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>
				<input class="button" type="submit" value="Update Account" />
			</td>
		</tr>
	<? } ?>
	</table>
</span>
<? if ($myself) { ?>
	</form>
<? } ?>