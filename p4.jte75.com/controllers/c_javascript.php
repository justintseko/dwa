<?php

class javascript_controller extends base_controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function class1() {
		
		$this->template->content = View::instance("v_javascript_class1");
		
		$client_files = Array(
			"/js/class1.js");
			
		$this->template->client_files = Utils::load_client_files($client_files);
		
		echo $this->template;
		
	}


}