<h2>My NewsPages</h2>
<ul>
<? foreach($news as $key => $news): ?>
	
	<li><a href='/news/viewnews/<?=$news['news_id']?>'><?=$news['news_name']?></a><li><br />
	
<? endforeach; ?>
</ul>