<?php
set_include_path('.:/home/genghis/sites/electionleaflets/includes:/home/genghis/sites/electionleaflets/includes/PEAR:/home/genghis/sites/electionleaflets/config');
require_once('init.php');

class about_page extends pagebase {


	//bind
	function bind() {
		$this->page_title = "About";				
	}

}

//create class instance
$about_page = new about_page();

?>
