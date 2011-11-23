<?php
class AdministratorsController extends AppController {
	//---------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------
	var $name = 'Administrators';
	var $uses = array('Tinyurl', 'Administrator', 'Bunch', 'BadIp', 'Badurl');
	var $helpers = array('Javascript');
	var $components = array('RequestHandler');
	//---------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------
	function index() {
		if ($this->Session->read("adminLogged") == true) {
			return;
		} else {
			$this->Session->setFlash("You are not logged in", 'default', array('class' => 'bad_flash message'));
			$this->redirect(array('controller' => 'administrators', 'action' => 'login'));
		}
	}
	//---------------------------------------------------------------------------------
	function login() {
		if(!$this->RequestHandler->isSSL()) {
			$this->redirect('https://' . $_SERVER['SERVER_NAME'] . $this->here);			
			return;
		}
		$data = $this->data;
		if (!empty($data)) {
			if ($this->Administrator->isAdministrator($data["Administrator"]["username"], $data["Administrator"]["password"])) {
				$this->Session->write("adminLogged", true);
				$this->Session->setFlash("You are now logged in {$data["Administrator"]["username"]}");
				$this->redirect('https://' . $_SERVER['SERVER_NAME'] . "/administrators/index");
			} else {
				$this->Session->setFlash("That username and password combination was not found.", 'default', array('class' => 'bad_flash message'));
			}
		}
	}
	//---------------------------------------------------------------------------------
	function tinyurl() {
		if ($this->Session->read("adminLogged") == true) {
			
			if (isset($_POST["renew"])) {	
				$this->Tinyurl->renew($this->data["Tinyurl"]["mark"]);	
				$this->Session->setFlash("You've renewed your aliases.");
			} else if (isset($_POST["drop"])) {
				$marks = $this->data["Tinyurl"]["mark"];
				foreach($marks as $key => $value) { $this->Tinyurl->delete($key); }
				$this->Session->setFlash("Tinyurls dropped");
			} else if (isset($_POST["flag"])) {
				$badIps = $this->Tinyurl->getIps($this->data["Tinyurl"]["mark"]);
				$badUrls = $this->Tinyurl->getUrls($this->data["Tinyurl"]["mark"]);
				
				$this->BadIp->flagIps($badIps);
				$this->Badurl->flagUrls($badUrls);
				
				foreach($this->data["Tinyurl"]["mark"] as $key => $value) { $this->Tinyurl->delete($key); }
			}
			
			$this->paginate = array( "order" => array("timestamp DESC"), "limit" => 50);
			$tinyurl = $this->paginate("Tinyurl");
			$this->set('tinyUrls', $tinyurl);
		} else {
			$this->Session->setFlash("You are not logged in", 'default', array('class' => 'bad_flash message'));
			$this->redirect(array('controller' => 'administrators', 'action' => 'login'));
		}
	}
	//---------------------------------------------------------------------------------
	function dropb($id) {
		if ($this->Session->read("adminLogged") == true) {
			$this->Bunch->delete($id);
			$this->Session->setFlash("Tinyurl dropped");
			$this->redirect("https://go.fiu.edu/administrators/bunches");
		} else {
			$this->Session->setFlash("You are not logged in", 'default', array('class' => 'bad_flash message'));
			$this->redirect(array('controller' => 'administrators', 'action' => 'login'));
		}
	}
	//---------------------------------------------------------------------------------
	function edit($id) {
		if ($this->Session->read("adminLogged") == true) {
			$this->Tinyurl->id = $id;
			if (isset($this->data)) {
				$data = $this->data;
				if ($data["Tinyurl"]["take"]) $data["Tinyurl"]["owner"] = "Admin";
				if ($this->Tinyurl->save($data)) {
					$this->redirect('https://' . $_SERVER['SERVER_NAME'] . "/administrators/tinyurl");
				}
			} else {			
				$this->data = $this->Tinyurl->read();
			}
		} else {
			$this->Session->setFlash("You are not logged in", 'default', array('class' => 'bad_flash message'));
			$this->redirect(array('controller' => 'administrators', 'action' => 'login'));
		}
	}
	//---------------------------------------------------------------------------------
	function editb($id) {
		if ($this->Session->read("adminLogged") == true) {
			$this->Bunch->id = $id;
			$bunch = $this->Bunch->read();
			$this->set('urlNumber', count($bunch["BunchUrl"]));
			if (isset($this->data)) {
				if ($this->Bunch->update($bunch, $this->data)) {
					$this->Session->setFlash("Your bunch has been edited.");
					$this->redirect('https://' . $_SERVER['SERVER_NAME'] . "/administrators/bunches");
				}				
			} else {
				$this->data = $bunch;
			}
		} else {
			$this->Session->setFlash("You are not logged in", 'default', array('class' => 'bad_flash message'));
			$this->redirect(array('controller' => 'administrators', 'action' => 'login'));
		}
	}
	//---------------------------------------------------------------------------------
	function renewb($id) {
		if ($this->Session->read("adminLogged") == true) {
			$this->Bunch->id = $id;
			$bunch = $this->Bunch->read();
			if ($bunch["Bunch"]["owner"] == $this->Session->read("userName")) {
				$bunch["Bunch"]["timestamp"] = date("Y-m-d h:i:s");
				if ($this->Bunch->save($bunch)) {
					$this->Session->setFlash("You've renewed your alias \"{$bunch["Bunch"]["alias"]}\"");
					$this->redirect('https://' . $_SERVER['SERVER_NAME'] . "/administrators/bunches");					
				}
			} else {
				$this->redirect('https://' . $_SERVER['SERVER_NAME'] . "/administrators/index");
			}
		} else {
			$this->Session->setFlash("You are not logged in", 'default', array('class' => 'bad_flash message'));
			$this->redirect(array('controller' => 'administrators', 'action' => 'login'));
		}
	}
	
	
	//---------------------------------------------------------------------------------
	function tinyurl_alias() {
		if ($this->Session->read("adminLogged") == true) {
			$data = $this->data;
			if (isset($data["Tinyurl"])) {
				$this->Tinyurl->loggedUser($data, "Admin");
				if ($this->Tinyurl->save($data)) {
					$this->Session->setFlash("Alias has been created. This alias WILL NOT be erased in 30 days.");
				}
			}			
		} else {
			$this->Session->setFlash("You are not logged in", 'default', array('class' => 'bad_flash message'));
			$this->redirect(array('controller' => 'administrators', 'action' => 'login'));
		}
	}
	//---------------------------------------------------------------------------------
	function bunches() {
		if ($this->Session->read("adminLogged") == true) {
			$bunch = $this->Bunch->find("all");
			$this->set('bunches', $bunch);			
		} else {
			$this->Session->setFlash("You are not logged in", 'default', array('class' => 'bad_flash message'));
			$this->redirect(array('controller' => 'administrators', 'action' => 'login'));
		}
	}	
	//---------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------
}