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
		$this->template->title   = "Create a new splash";
			
		# Render template
		echo $this->template;
	
	}
	
	public function p_createnew() {
			
		# Associate this post with this user
		$_POST['user_id']  = $this->user->user_id;
		
		# Unix timestamp of when this post was created / modified
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		
		# Insert
		# Note we didn't have to sanitize any of the $_POST data because we're using the insert method which does it for us
		DB::instance(DB_NAME)->insert('splashes', $_POST);
		
		# Quick and dirty feedback
		echo "Your post has been added. <a href='/posts/index'>Back to posts</a>";

	}


	public function index() {
	
		# Set up view
		$this->template->content = View::instance('v_news_index');
		$this->template->title   = "Splash";
		
		# Build a query of the users this user is following - we're only interested in their posts
		$q = "SELECT * 
			FROM users_users
			WHERE user_id = ".$this->user->user_id;
		
		# Execute our query, storing the results in a variable $connections
		$connections = DB::instance(DB_NAME)->select_rows($q);
		
		# In order to query for the posts we need, we're going to need a string of user id's, separated by commas
		# To create this, loop through our connections array
		$connections_string = "";
		foreach($connections as $connection) {
			$connections_string .= $connection['user_id_followed'].",";
		}
		
		# Remove the final comma 
		$connections_string = substr($connections_string, 0, -1);
		
	
		# Now, lets build our query to grab the posts
		$q = "SELECT * 
			FROM posts 
			JOIN users USING (user_id)
			WHERE posts.user_id IN (".$connections_string.")"; # This is where we use that string of user_ids we created
					
		# Run our query, store the results in the variable $posts
		$posts = DB::instance(DB_NAME)->select_rows($q);
		
		# Pass data to the view
		$this->template->content->posts = $posts;
		
		# Render view
		echo $this->template;

	}
	
}