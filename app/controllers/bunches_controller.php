<?php
class BunchesController extends AppController {
	//---------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------
	var $name = 'Bunches';
	var $helpers = array('Javascript');
	//---------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------
	function drop($id ) {
		$this->Bunch->id = $id;
		$bunch = $this->Bunch->read();  
		if ($bunch["Bunch"]["owner"] == $this->Session->read("userName")) { 
			$this->Bunch->delete($id);
			$params = array("bunch_id" => $id);
			$this->Bunch->BunchUrl->deleteAll($params);
			$this->Session->setFlash("Bunch \"{$bunch["Bunch"]["alias"]}\" has been dropped.");			
		} else {
			$this->Session->setFlash("You don't have permission to do that." , 'default', array('class' => 'bad_flash message'));
		}
		$this->redirect(array('controller' => 'tinyurls', 'action' => 'dashboard'));
		
	}
	//---------------------------------------------------------------------------------
	function index($alias, $page = 0) {
		$this->layout = "banner";
		if (isset($this->data)) {
			$page = $this->data["BunchJumper"]["page"];
		}		
		$results = $this->Bunch->getByAlias($alias);
		if (!empty($results)) {
			$this->Bunch->updateCount($results["Bunch"]["id"]);
		}
		$this->set('results', $results);
		
		if (isset($results)) {
			$options = array();
			foreach($results["BunchUrl"] as $key => $url) {
				$options[$key] =  $url["url"];
			}
			$this->set('options', $options);
			$this->set('page', $page);	
		} else {
			$this->Session->setFlash("Sorry, I couldn't find that alias.", 'default', array('class' => 'bad_flash message'));
			$this->redirect(array('controller' => 'tinyurls', 'action' => 'index'));
		}	
	}
	//---------------------------------------------------------------------------------
	function renew($id) {
		$this->Bunch->id = $id;
		$bunch = $this->Bunch->read();
		if ($bunch["Bunch"]["owner"] == $this->Session->read("userName")) {
			$bunch["Bunch"]["timestamp"] = date("Y-m-d h:i:s");
			if ($this->Bunch->save($bunch)) {
				$this->Session->setFlash("You've renewed your alias \"{$bunch["Bunch"]["alias"]}\"");
				$this->redirect(array('controller' => 'tinyurls', 'action' => 'dashboard'));
			}
		} else {
			$this->redirect(array('controller' => 'tinyurls', 'action' => 'index'));
		}
	}
	//---------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------
}