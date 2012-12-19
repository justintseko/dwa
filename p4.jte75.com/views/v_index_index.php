<? if(!$user): ?>
	Welcome stranger! Please log in or sign up<br>
<? else: ?>
	Welcome back <?=$user->first_name?><br>
	<a href='/users/logout'>Logout</a>
<? endif; ?>