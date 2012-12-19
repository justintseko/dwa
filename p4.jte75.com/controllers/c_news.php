<?php

class news_controller extends base_controller {

	public function __construct() {
		parent::__construct();
		
		# Make sure user is logged in if they want to use anything in this controller
		if(!$this->user) {
			die("Members only. <a href='/users/login'>Login</a>");
		}

	}

	public function createnew() {
	
		# Setup view
		$this->template->content = View::instance('v_news_createnew');
		$this->template->title   = "Create a new news";
			
		# Render template
		echo $this->template;
	
	}
	
	public function p_createnew() {
			
		# Associate this news with this user
		$_POST['user_id']  = $this->user->user_id;
		
		# Unix timestamp of when this news was created / modified
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		
		# Insert
		# Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
		DB::instance(DB_NAME)->insert('news', $_POST);
		
		# Quick and dirty feedback
		echo "Your news has been added. <a href='/news/index'>Back to news</a>";

	}


	public function index() {

		$this->template->content = View::instance('v_news_index');
		$this->template->title   = 'My news';
		
		$q = "SELECT * 
		FROM news 
		JOIN users USING (user_id)
		WHERE user_id = ".$this->user->user_id;
		
		$news = DB::instance(DB_NAME)->select_rows($q);
	
		# Pass data to the view
		$this->template->content->news = $news;
		
		# Render view
		echo $this->template;
	}

	public function viewnews($news_id) {
		
		$this->template->content = View::instance('v_news_viewnews');
		$this->template->title   = 'View news';
		
		$q = "SELECT * 
		FROM news 
		JOIN users USING (user_id)
		WHERE news.news_id IN (".$news_id.")";
		
		$news = DB::instance(DB_NAME)->select_rows($q);
		
		# Pass data to the view
		$this->template->content->news = $news;
		
		# Render view
		echo $this->template;
	}

}