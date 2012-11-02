<?php
class users_controller extends base_controller {

	public function __construct() {
		parent::__construct();
	} 
	
	public function index() {
		echo "Welcome to the users's department";
	}
	
	public function signup() {
		
		# Setup view
			$this->template->content = View::instance('v_users_signup');
			$this->template->title   = "Signup";
			
		# Render template
			echo $this->template;
		
	}
	
	public function p_signup() {
	
		#Password encryption
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();
		$_POST['token']    = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

		
		# Dump out the results of POST to see what the form submitted
		print_r($_POST);
		
		#Put the data in the database
		DB::instance(DB_NAME)->insert('users', $_POST);
		
		echo "You are registered!";
		
	}
	
	public function login($error = NULL) {
		
		# Set up the view
		$this->template->content = View::instance("v_users_login");
		
		# Pass data to the view
		$this->template->content->error = $error;
		
		# Render the view
		echo $this->template;
		
	}
	
	public function p_login() {
		
		# Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		# Hash submitted password so we can compare it against one in the db
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		
		# Search the db for this email and password
		# Retrieve the token if it's available
		$q = "SELECT token 
			FROM users 
			WHERE email = '".$_POST['email']."' 
			AND password = '".$_POST['password']."'";
		
		$token = DB::instance(DB_NAME)->select_field($q);	
					
		# Login failed
		if($token == "") {
		Router::redirect("/users/login/error"); # Note the addition of the parameter "error"
	}
		# Login passwed
		else {
		setcookie("token", $token, strtotime('+2 weeks'), '/');
		Router::redirect("/");
	}

}
	
	public function logout() {
		# Generate and save a new token for next login
		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
		
		# Create the data array we'll use with the update method
		# In this case, we're only updating one field, so our array only has one entry
		$data = Array("token" => $new_token);
		
		# Do the update
		DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
		
		# Delete their token cookie - effectively logging them out
		setcookie("token", "", strtotime('-1 year'), '/');

		# Send them back to the main landing page
		Router::redirect("/");
	}
	
	public function profile($user_name = NULL) {
	
	# If user is blank, they're not logged in, show message and don't do anything else
	if(!$this->user) {
		echo "Members only. <a href='/users/login'>Login</a>";
		return false;
	}

		
		if($user_name == NULL) {
			echo "No user specified" ;
			}
		else {
		
			# Set up view
				$this->template->content = View::instance('v_users_profile');
				$this->template->title   = "Profile";

			# Load CSS / JS
				$client_files = Array(
						"/css/users.css",
						"/js/users.js",
						);
			
				$this->template->client_files = Utils::load_client_files($client_files);   

			# Pass information to the view
				$this->template->content->user_name = $user_name;
					
			# Render template
				echo $this->template;

		}
	}
		
} # end of the class