<form method='POST' action='/posts/p_follow'>
		
	<? foreach($users as $key => $user): ?>
	
		<a href='/posts/viewuser/<?=$user['user_id']?>'><?=$user['first_name']?> <?=$user['last_name']?> </a>
		
		<? $user_id = $user['user_id'] ?>
		
		<? if(isset($connections[$user['user_id']])): ?>
			<a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>
		
		<? else: ?>
			<a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
		<? endif; ?>
	
		<br><br>
	
	<? endforeach; ?>

</form>