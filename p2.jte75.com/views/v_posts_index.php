<? foreach($posts as $post): ?>
	
	<h2><?=$post['first_name']?> posted:</h2>
	<?=$post['content']?>
	
	<br><br>
	
<? endforeach; ?>