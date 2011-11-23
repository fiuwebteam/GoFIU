<?php 
class BunchUrl extends AppModel {
//---------------------------------------------------------------------------------
	var $name = 'BunchUrl';
	
	var $belongsTo = array(
		'Bunch' => array(
			'classname' => "Bunch",
			'foreign_key' => "bunch_id"
		)
	);
	
	var $validate = array(
	   	'alias' => array( 'notEmpty', "isUnique"),
		'owner_ip' => 'notEmpty',
		'url' => array(
			array(
				'rule' => 'urlRule',
				'message' => 'Please make sure that your url is in the proper format. ie "http://www.google.com"'
			 )
		 )
    );
    //---------------------------------------------------------------------------------
    //---------------------------------------------------------------------------------
 	function urlRule( $field=array()) {
 		if ($field["url"] == "http://") {
 			return false;
 		}
 		return preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $field["url"]);   	
    }
	//---------------------------------------------------------------------------------
}

?>