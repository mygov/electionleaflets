<?php
set_include_path('.:/home/genghis/sites/electionleaflets/includes:/home/genghis/sites/electionleaflets/includes/PEAR:/home/genghis/sites/electionleaflets/config');
require_once('init.php');
require_once('table_classes/rate_value.php');

class rate_page extends pagebase {

    function load(){
        //if(!session_read('analysis_name') || !session_read('analysis_email')){
            redirect(WWW_SERVER . '/analyze.php');
        //}
    }
    
	//bind
	function bind() {

        $this->onloadscript = "setupRate();";
        
        //get name
        $name = session_read("analysis_name");
        $tmp = split(' ', $name);
        $name = $tmp[0];
        
        //get user count
        $user_count = tableclass_rate_value::user_count(session_read("analysis_email"), false);
        
		//get the leaflet
		$search = factory::create("search");
		$result = $search->search("leaflet",
		    array(array("live", "=", 1), array("date_uploaded", ">", STAT_ZERO_DATE)),
		    'AND',
		    null,
		    array(array('RAND()', 'DESC')),
		    1
		);

		$leaflet = null;
		if(count($result) != 1){
		    throw_404();
	    }else{
	        $leaflet = $result[0];
        }

        //get images
        $leaflet_images = $search->search("leaflet_image", 
            array(array("leaflet_id", "=", $leaflet->leaflet_id)),
            'AND',
            null,
            array(array("sequence", "ASC"))
            );

        //get rate types
        $rate_types = $search->search("rate_type", 
            array(array("1", "=", "1")));

        //assign
		$this->page_title = "Rate '" . $leaflet->title . "'";
	    $this->assign("leaflet", $leaflet);
	    $this->assign("leaflet_images", $leaflet_images);
        $this->assign("hide_header", true);
        $this->assign("leaflet_id", $leaflet->leaflet_id);
        $this->assign("rate_types", $rate_types);
        $this->assign("name", $name);        
        $this->assign("user_count", $user_count);        
        
		
	}

    function process(){
        //get rate types
		$search = factory::create("search");        
        $rate_types = $search->search("rate_type", array(array("1", "=", "1")));
        $rate_values = array();
        
        //get leaflet_id
        $leaflet_id = $this->data['hidLeafletId'];
        
        if(isset($leaflet_id) && $leaflet_id > 0 && $leaflet_id != ''){
            
            $name = session_read('analysis_name');
            $email = session_read('analysis_email');
            
            
            //loop through types
            foreach ($rate_types as $rate_type) {
                if(isset($this->data['hidRateValue_' . $rate_type->rate_type_id])){
                    $rate_value = factory::create('rate_value');
                    $rate_value->rate_type_id = $rate_type->rate_type_id;
                    $rate_value->leaflet_id = $leaflet_id;                    
                    $rate_value->value = $this->data['hidRateValue_' . $rate_type->rate_type_id]; 
                    $rate_value->user_name = $name;
                    $rate_value->user_email = $email;
                    array_push($rate_values, $rate_value);
                }else{
                    trigger_error("Unknown rate type on rate page");                    
                }
            }
        }else{
            trigger_error("No leaflet ID set on rate page");
        }
        
        //save rate values
        foreach ($rate_values as $rate_value) {
            $rate_value->insert();
        }
        
        //anything interesting?
        $interesting = trim($this->data['txtInteresting']);
        if(isset($interesting) && $interesting != '' && strlen($interesting) > 30){
            $rate_interesting = factory::create('rate_interesting');
            $rate_interesting->leaflet_id = $leaflet_id;                    
            $rate_interesting->description = $interesting; 
            $rate_interesting->user_name = $name;
            $rate_interesting->user_email = $email;
            $rate_interesting->insert();
        }
        
        
        redirect(WWW_SERVER . "/rate.php");
    }
	
	
}

//create class instance
$rate_page = new rate_page();

?>
