<p>Please fill out the following information to sign up:</p>
<hr>
<input type="hidden" id="autoFocus" value="#firstname" />
<form id="register-form" method="post" action="/main/addUser/">
	<table align="center">
		<tr>
			<td class="right">
				<label for="firstname">Firstname: </label>
			</td>
			<td>
				<input type="text" id="firstname" name="firstname" />
			</td>
		</tr>
		<tr>
			<td class="right">
				<label for="lastname">Lastname: </label>
			</td>
			<td>
				<input type="text" id="lastname" name="lastname" />
			</td>
		</tr>
		<tr>
			<td class="right">
				<label for="email">Email: </label>
			</td>
			<td>
				<input type="email" id="email" name="email" />
			</td>
		</tr>
		<tr>
			<td class="right">
				<label for="username">Username: </label>
			</td>
			<td>
				<input type="text" id="username" name="username" />
			</td>
		</tr>
		<tr>
			<td class="right">
				<label for="password">Password: </label>
			</td>
			<td>
				<input type="password" id="password" name="password" />
			</td>
		</tr>
		<tr>
			<td class="right">
				<label for="confirm">Confirm: </label>
			</td>
			<td>
				<input type="password" id="confirm" name="confirm" />
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>
				<input class="button" type="submit" value="Register" />
			</td>
		</tr>
	</table>
	<hr>
	<div class="alt">
		if you already have an account,<br />
		<a class="button" href="/main/login/">Click here to login!</a> 
	</div>
</form>
