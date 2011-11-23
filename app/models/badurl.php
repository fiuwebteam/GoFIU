<?php 
class Badurl extends AppModel {
//---------------------------------------------------------------------------------
	var $name = 'Badurl';
	
	//---------------------------------------------------------------------------------
    var $validate = array( 'url' => "isUnique" );
	//---------------------------------------------------------------------------------
	function flagUrls($urls) {
 		foreach($urls as $key => $value) {
 			
 			$urlArray = parse_url($value);
			$badUrl = array(
				"Badurl" => array(
					"url" => $urlArray["host"]
				)
			);
			$this->create();
			$this->save($badUrl);
 		} 
 	}
	//---------------------------------------------------------------------------------
}

?>