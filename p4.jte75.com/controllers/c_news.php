<?php

class news_controller extends base_controller {

  public function __construct() {	
		parent::__construct();	
	}
	
	
	/*-------------------------------------------------------------------------------------------------
	Loads the initial form that lets you choose your news source
	-------------------------------------------------------------------------------------------------*/
	public function load() {	
	
		# Setup view
			$this->template->content = View::instance('v_news_load');
			$this->template->title   = "Choose an news source to load";
			
		# Render template
			echo $this->template;
		
	
	}
	
	
	/*-------------------------------------------------------------------------------------------------
	This is what gets called by ajax and grabs the news
	-------------------------------------------------------------------------------------------------*/
	public function p_load() {
	
		// Taken from getrss.php on http://www.w3schools.com/php/php_ajax_rss_reader.asp
					
		//get the q parameter from URL
		$q=$_POST["q"];
		
		//find out which feed was selected
		if($q=="Google")
		  {
		  $xml=("http://news.google.com/news?ned=us&topic=h&output=rss");
		  }
		elseif($q=="MSNBC")
		  {
		  $xml=("http://rss.msnbc.msn.com/id/3032091/device/rss/rss.xml");
		  }
		
		$xmlDoc = new DOMDocument();
		$xmlDoc->load($xml);
		
		//get elements from "<channel>"
		$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
		$channel_title = $channel->getElementsByTagName('title')
		->item(0)->childNodes->item(0)->nodeValue;
		$channel_link = $channel->getElementsByTagName('link')
		->item(0)->childNodes->item(0)->nodeValue;
		$channel_desc = $channel->getElementsByTagName('description')
		->item(0)->childNodes->item(0)->nodeValue;
		
		//output elements from "<channel>"
		echo("<p><a href='" . $channel_link
		  . "'>" . $channel_title . "</a>");
		echo("<br>");
		echo($channel_desc . "</p>");
		
		//get and output "<item>" elements
		$x=$xmlDoc->getElementsByTagName('item');
		for ($i=0; $i<=2; $i++)
		  {
		  $item_title=$x->item($i)->getElementsByTagName('title')
		  ->item(0)->childNodes->item(0)->nodeValue;
		  $item_link=$x->item($i)->getElementsByTagName('link')
		  ->item(0)->childNodes->item(0)->nodeValue;
		  $item_desc=$x->item($i)->getElementsByTagName('description')
		  ->item(0)->childNodes->item(0)->nodeValue;
		
		  echo ("<p><a href='" . $item_link
		  . "'>" . $item_title . "</a>");
		  echo ("<br>");
		  echo ($item_desc . "</p>");
		  }
	
	}
			
	
	
} // end class
