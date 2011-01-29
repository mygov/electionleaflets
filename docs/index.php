<?php
set_include_path('.:/home/genghis/sites/electionleaflets/includes:/home/genghis/sites/electionleaflets/includes/PEAR:/home/genghis/sites/electionleaflets/config');

require_once('init.php');
require_once('table_classes/party.php');
require_once('table_classes/constituency.php');

class index_page extends pagebase {

	//bind
	function bind() {
		$this->page_title = SITE_TAG_LINE;	
		$this->onloadscript = "$('#divScroller ul').jcarousel({wrap: 'last',initCallback: mycarousel_initCallback,buttonNextHTML: null,buttonPrevHTML: null});";

        //get count of leaflets
        $leaflet = factory::create('leaflet');
        $this->assign("leaflet_count", $leaflet->count_live());

	//get recent leaflets
	$leaflet_search = factory::create("leaflet_search");
        $leaflet_search->start = 0;
        $leaflet_search->number = 60;
        
        $leaflets = $leaflet_search->search(true);

        //counts
        $party_counts = tableclass_party::get_party_count(STAT_ZERO_DATE);
        $not_spots = tableclass_constituency::get_not_spots();        
        $constituency_counts = tableclass_constituency::get_constituency_count(STAT_ZERO_DATE);                

        //assign
        $this->assign("party_counts", $party_counts);
        $this->assign("constituency_counts", $constituency_counts);        
        $this->assign("constituencies", $constituencies);        
        $this->assign("not_spots", $not_spots);        

        $this->assign("leaflets", $leaflets);			
        $this->assign("is_home", true);
	}

}

//create class instance
$index_page = new index_page();

?>
