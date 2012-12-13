<? if(!$user): ?>
	Welcome stranger<br>
	<a href='/users/login'>Login</a> | 
	<a href='/users/signup'>Signup</a>
<? else: ?>
	Welcome back <?=$user->first_name?><br>
	<a href='/users/logout'>Logout</a>
<? endif; ?>