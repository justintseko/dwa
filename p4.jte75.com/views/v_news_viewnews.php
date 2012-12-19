<? foreach($news as $key => $news): ?>

<script>
google.load("feeds", "1");

function OnLoad() {
  // Create a feed control
  var feedControl = new google.feeds.FeedControl();

  // Add feeds.
  feedControl.addFeed("<?=$news['feed_1_url']?>", "<?=$news['feed_1_name']?>");

  // Draw it.
  feedControl.draw(document.getElementById("content1"));

  feedControl.addFeed("<?=$news['feed_2_url']?>", "<?=$news['feed_2_name']?>");

  feedControl.draw(document.getElementById("content2"));

  feedControl.addFeed("<?=$news['feed_3_url']?>", "<?=$news['feed_3_name']?>");

  feedControl.draw(document.getElementById("content3"));

  feedControl.addFeed("<?=$news['feed_4_url']?>", "<?=$news['feed_4_name']?>");
 
  feedControl.draw(document.getElementById("content4"));

  feedControl.addFeed("<?=$news['feed_5_url']?>", "<?=$news['feed_5_name']?>");
 
  feedControl.draw(document.getElementById("content5"));

  feedControl.addFeed("<?=$news['feed_6_url']?>", "<?=$news['feed_6_name']?>");
  
  feedControl.draw(document.getElementById("content6"));
}

google.setOnLoadCallback(OnLoad);
</script>
	
<div id="content1"></div>
<div id="content2"></div>
<div id="content3"></div>
<div id="content4"></div>
<div id="content5"></div>
<div id="content6"></div>
	
<? endforeach; ?>