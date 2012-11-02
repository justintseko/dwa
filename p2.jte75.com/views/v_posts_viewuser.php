<? foreach($posts as $key => $post): ?>
	
	<h2><?=$post['first_name']?> posted:</h2>
	<?=$post['content']?>
	<a href='/posts/viewpost/<?=$post['post_id']?>'>Permalink</a>
	
	<br><br>
	
<? endforeach; ?>