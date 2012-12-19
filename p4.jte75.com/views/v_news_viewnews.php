<? foreach($news as $key => $news): ?>

<script>
google.load("feeds", "1");

function OnLoad() {
  // Create a feed control
  var feedControl = new google.feeds.FeedControl();

  // Add feeds.
  feedControl.addFeed("<?=$news['feed_1_url']?>", "<?=$news['feed_1_name']?>");

  feedControl.addFeed("<?=$news['feed_2_url']?>", "<?=$news['feed_2_name']?>");

  feedControl.addFeed("<?=$news['feed_3_url']?>", "<?=$news['feed_3_name']?>");

  feedControl.addFeed("<?=$news['feed_4_url']?>", "<?=$news['feed_4_name']?>");

  feedControl.addFeed("<?=$news['feed_5_url']?>", "<?=$news['feed_5_name']?>");

  feedControl.addFeed("<?=$news['feed_6_url']?>", "<?=$news['feed_6_name']?>");
  
    // Draw it.
  feedControl.draw(document.getElementById("content1"));
}

google.setOnLoadCallback(OnLoad);
</script>
	
<div id="content1"></div>
	
<? endforeach; ?>