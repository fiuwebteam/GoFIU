<?php 
class Tinyurl extends AppModel {
//---------------------------------------------------------------------------------
	var $name = 'Tinyurl';
	var $validate = array(
	    'url' => array(
			array(
				'rule' => 'urlRule',
				'message' => 'Please make sure that your url is in the proper format. ie "http://www.google.com"'
			 ),
			 array( 
			 	'rule' => 'notEmpty',
			 	'message' => 'Please type in a valid url.'
			 )
		 ),
		'alias' => array(
		 	array(
		 		'rule' => 'notEmpty',
		 		'message' => 'You need an alias.'
		 	),
		 	array(
		 		'rule' => 'isUnique',
		 		'message' => 'That alias is already taken' 
		 	),
	 		array(
				'rule' => 'adminRule',
				'message' => 'That alias is already taken'
		 	)
		),
		'owner_ip' => 'notEmpty'  
    );
    //---------------------------------------------------------------------------------
	function getUrls($marks) {
    	$urls = array();
    	foreach($marks as $key => $value) {
			$this->id = $key;
			$tinyurl = $this->read();			
			$urls[] = $tinyurl["Tinyurl"]["url"];			 
		}
		return $urls;
    }
    
    //---------------------------------------------------------------------------------
    function getIps($marks) {
    	$ips = array();
    	foreach($marks as $key => $value) {
			$this->id = $key;
			$tinyurl = $this->read();			
			$ips[] = $tinyurl["Tinyurl"]["owner_ip"];			 
		}
		return $ips;
    }
    //---------------------------------------------------------------------------------
    function renew($marks) {
    	$return = true;
    	foreach ($marks as $key => $value) {
			$this->id = $key;
			$tinyurl = $this->Tinyurl->read();
			$tinyurl["Tinyurl"]["timestamp"] = date("Y-m-d h:i:s");
			$check = $this->save($tinyurl);
			if ($check == false) {$return = $check;}
		}
		return $return;
    }
    //---------------------------------------------------------------------------------    
	function adminRule( $field=array()) {
 		if ($field["alias"] == "admin" || $field["alias"] == "admin/") {
 			return false;
 		}
 		return true;
    }
    //---------------------------------------------------------------------------------
    function anonymousUser(&$data) {
    	$result = array();
    	$result["Tinyurl"]["alias"] = dechex($this->getLastId() + 1);
		$result["Tinyurl"]["owner_ip"] = $_SERVER['REMOTE_ADDR'];
		$result["Tinyurl"]["owner"] = "Anonymous";
		$result["Tinyurl"]["url"] = htmlspecialchars($data["Tinyurl"]["url"]);
		$data = $result;
    }
    //---------------------------------------------------------------------------------
    function getLastId() {
    	$params = array();
    	$params['order'] = "id DESC";
    	$params['fields'] = array('Tinyurl.id');
    	$id = $this->find("first", $params);
    	return $id["Tinyurl"]["id"];
    }
    //---------------------------------------------------------------------------------
    function getTinyUrl($alias) {
    	$params = array();
    	$params['conditions'] = array("alias" => $alias);
    	$tinyUrl = $this->find("first", $params);
    	if (empty($tinyUrl)) {
    		return false;
    	}
    	$tinyUrl["Tinyurl"]["count"] = $tinyUrl["Tinyurl"]["count"] + 1; 
    	$this->id = $tinyUrl["Tinyurl"]["id"];
    	$this->save($tinyUrl);
    	return $tinyUrl;
    }
    //---------------------------------------------------------------------------------
    function loggedUser(&$data, $user) {
    	$result = array();
    	$result["Tinyurl"]["url"] = htmlspecialchars($data["Tinyurl"]["url"]);
    	$result["Tinyurl"]["alias"] = (isset($data["Tinyurl"]["alias"])) ? $data["Tinyurl"]["alias"] : dechex($this->getLastId() + 1);
		$result["Tinyurl"]["owner_ip"] = $_SERVER['REMOTE_ADDR'];
		$result["Tinyurl"]["owner"] = $user;
		$data = $result;
    }    
	//---------------------------------------------------------------------------------
    function urlRule( $field=array()) {
    	if ($field["url"] == "") {
    		return true;
    	}
    	if ($field["url"] == "http://") {
    		return false;
    	}
    	
    	return preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $field["url"]);
    	    	
    }
	//---------------------------------------------------------------------------------
}

?>