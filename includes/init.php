<?php

	//set error reporting
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_USER_NOTICE | E_COMPILE_ERROR | E_CORE_ERROR);
	set_include_path('.:/home/genghis/sites/electionleaflets/includes:/home/genghis/sites/electionleaflets/includes/PEAR:/home/genghis/sites/electionleaflets/config');

	//default requires
	require_once ('general.php');
	require_once ('PEAR.php');
	require_once ('factory.php');
	require_once ('error_handle.php');
	require_once ('session.php');
	require_once('DB/DataObject.php');
	require_once('DB/DataObject/Cast.php');	
	require_once ('functions.php');	
	require_once ('pagebase.php');
	require_once ('s3.php');
?>
