<?php 
class Administrator extends AppModel {
//---------------------------------------------------------------------------------
	var $name = 'Administrator';
	
	//---------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------
 	function isAdministrator($user, $password) {
 		$params = array();
		$params["conditions"] = array(
		"username" => $user, 
		"password" => sha1($password));
		$results = $this->find("first", $params);
		return !empty($results);
 	}
	//---------------------------------------------------------------------------------
}

?>