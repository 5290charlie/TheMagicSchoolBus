<p>Please provide your username and password to login:</p>
<hr>
<input type="hidden" id="autoFocus" value="#username" />
<form id="login-form" method="post" action="/main/authenticate/">
	<table align="center">
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
			<td>
			</td>
			<td>
				<input class="button" type="submit" value="Login" />
			</td>
		</tr>
	</table>
	<hr>
	<div class="alt">
		if you don't have an account yet,<br />
		<a class="button" href="/main/register/">Click here to sign up!</a> 
	</div>
</form>
