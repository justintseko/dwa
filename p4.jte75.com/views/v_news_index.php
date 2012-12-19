<? foreach($news as $key => $news): ?>
	
	<a href='/news/viewnews/<?=$news['news_id']?>'><?=$news['news_name']?></a></h2>
	
	<br><br>
	
<? endforeach; ?>