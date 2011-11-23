<?php 
class Bunch extends AppModel {
//---------------------------------------------------------------------------------
	var $name = 'Bunch';
	
	var $hasMany = array(
		"BunchUrl" => array(
			'className'    => 'BunchUrl',
			'foreign_key'  => 'bunch_id'
		)
	);
	
	var $validate = array(
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
		'owner_ip' => 'notEmpty',
		'owner' => 'notEmpty'  
    );
    //---------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------
	function adminRule( $field=array()) {
 		if ($field["alias"] == "admin" || $field["alias"] == "admin/") {
 			return false;
 		}
 		return true;
    }
	//---------------------------------------------------------------------------------
	function update($bunch, $data) {
		$bunchUrls = $data["BunchUrl"];
		$tempUrls = array();
		for($x = 0; $x < $data["Bunch"]["urls"]; $x++) {
			$tempUrls[] = array( "url" => $data["BunchUrl"][$x]["url"]);
		}
		$data["BunchUrl"] = $tempUrls;
		$data["Bunch"]["id"] = $id;
		foreach($bunch["BunchUrl"] as $key => $bunchUrl) {
			if (isset($data["BunchUrl"][$key])) {
				$data["BunchUrl"][$key]["id"] = $bunchUrl["id"];
			} else {$this->BunchUrl->del($bunchUrl["id"]);}
		}
		if ($this->saveAll($data, array("validate" => "first"))) {return true;}
		return false;
	}
	//---------------------------------------------------------------------------------
	function getByAlias($alias) {
		$params = array();
		$params["conditions"] = array("alias" => $alias);		
		return $this->find("first", $params);
	}
	//---------------------------------------------------------------------------------
	function updateCount($id) {
		$this->id = $id;
		$bunch = $this->read();
		$bunch["Bunch"]["count"] = $bunch["Bunch"]["count"] + 1;
		return $this->save($bunch);
	}
	//---------------------------------------------------------------------------------
}

?>