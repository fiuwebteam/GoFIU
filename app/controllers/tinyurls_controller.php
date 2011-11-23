<?php
class TinyurlsController extends AppController {
	//---------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------
	var $name = 'Tinyurls';
	var $uses = array('Tinyurl', 'Malware', "Bunch", "BunchUrl", 'BadIp', 'Badurl');
	var $components = array('Email','RequestHandler', 'HttpBlacklist');
	var $helpers = array('Date', 'Javascript');	
	//---------------------------------------------------------------------------------
	//---------------------------------------------------------------------------------
	function beforeFilter() {
		parent::beforeFilter();
		// Block requests from malicious IPs
		$this->HttpBlacklist->blockMalicious();
	}
	//---------------------------------------------------------------------------------
	function xmlreturn() {
		$this->layout = "ajax";
		return $this->bookmarklet();
	}
	//---------------------------------------------------------------------------------
	function bookmarklet() {
		$originalUrl = $this->params["url"]["create"];
		foreach($this->params["url"] as $key => $value) {
			if ($key != "url" && $key != "create" ) {
				$originalUrl .= "&" . $key . "=" . $value;
			}
		}
		$data = array("Tinyurl" => array("url" => $originalUrl ));
		$this->set('url', str_replace("&", "&amp;", $originalUrl));
		$this->_newTinyUrl($data);
	}
	//---------------------------------------------------------------------------------
	function dashboard() {
		if ($this->Session->read("isLoggedIn")) {
			$this->set('userName', $this->Session->read("userName"));
			$data = $this->data;
			if (isset($data["Bunch"])) {
				$this->_newBunch($data);
			} else if (isset($data["Tinyurl"])) {
				$this->_newTinyUrl($data);
			}
			
			$results = $this->Tinyurl->find("all", array("conditions" => array("owner" => $this->Session->read("userName"))));
			$this->set('ownedTinyUrls', $results);
			
			$results = $this->Bunch->find("all", array("conditions" => array("owner" => $this->Session->read("userName"))));			
			$this->set('ownedBunches', $results);
			
		} else {
			$this->redirect(array('controller' => 'tinyurls', 'action' => 'index'));
		}
	}
	//---------------------------------------------------------------------------------
	function drop($id) {
		if ($this->Session->read("isLoggedIn") == true) {
			$this->Tinyurl->id = $id;
			$tinyurl = $this->Tinyurl->read();
			if ($tinyurl["Tinyurl"]["owner"] == $this->Session->read("userName")) {
				$this->Tinyurl->delete($id);
				$this->Session->setFlash("Tiny Url \"{$tinyurl["Tinyurl"]["alias"]}\" dropped");				
			} else {
				$this->Session->setFlash("This Url does not belong to you.", 'default', array('class' => 'bad_flash message'));
			}
			$this->redirect(array('controller' => 'tinyurls', 'action' => 'dashboard'));
		} else {
			$this->Session->setFlash("You are not logged in", 'default', array('class' => 'bad_flash message'));
			$this->redirect(array('controller' => 'tinyurls', 'action' => 'index'));
		}
	}
	//---------------------------------------------------------------------------------
	function faq() {
		return;		
	}
	//---------------------------------------------------------------------------------
	function index() {
		if (isset($this->params["pass"][0])) {
			$this->layout = 'banner';
			$tinyurl = $this->Tinyurl->getTinyUrl($this->params["pass"][0]);
			if (!empty($tinyurl)) {
				$this->set('Tinyurl', $tinyurl);
				$forwardUrls = Configure::read('forwardUrls');
				$testUrl = $tinyurl["Tinyurl"]["url"];
				$parseUrl = parse_url($testUrl);
				$parseUrl["host"] = str_replace("www.", "", $parseUrl["host"]);
				if (in_array($parseUrl["host"], $forwardUrls)) {
					$this->redirect($testUrl);
					exit();
				}				
			} else {
				$this->Session->setFlash("Sorry, I couldn't find that alias.", 'default', array('class' => 'bad_flash message'));
				$this->redirect(array('controller' => 'tinyurls', 'action' => 'index'));
			}
		} else {
			$this->set('topFive', $this->Tinyurl->find("all", array("limit" => 5, "order" => "count DESC")));
			$data = $this->data;
			if (!empty($data)) {
				$this->_newTinyUrl($data);
			} 
		}
	}
	//---------------------------------------------------------------------------------
	function login() {
		if(!$this->RequestHandler->isSSL()) {
			$this->redirect('https://' . $_SERVER['SERVER_NAME'] . "/tinyurls/login");
			return;
		}
		
		if (isset($this->data)) {
			$data = $this->data;
			$username = $data["Login"]["username"];
			$password = $data["Login"]["password"];
			
			$ds = ldap_connect(Configure::read('ldapConnection'), 636) or die("I tried boss, but no dice.");		
			$r = ldap_search( $ds, "ou=people,dc=fiu,dc=edu", "(uid=$username)") or die("I tried boss, but no dice.");
			
			 if ($r) {
	            $result = ldap_get_entries( $ds, $r);
	            if (isset($result[0]) && $result[0]) {
	            	$bind = ldap_bind( $ds, $result[0]['dn'], $password);
	                if ( $bind && $password != "" ) {
	                    $this->Session->write("isLoggedIn", true);
						$this->Session->write("userName", $username);
						$this->redirect(array('controller' => 'tinyurls', 'action' => 'dashboard'));
						return;
	                } 
	            }
	        }
	        $this->Session->setFlash("Sorry, I couldn't find that username and password combination.");
		}
	}
	//---------------------------------------------------------------------------------
	
	function nightjob() {
		if ($_SERVER["HTTP_HOST"] != "localhost") {
			return;
		}
		
		$expDate = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-30, date("Y")));	
		$params = array("timestamp <" => $expDate);
		$params["conditions"][]["owner !="]= "Anonymous";
		$params["conditions"][]["owner !="]= "Admin";
		
		$this->Tinyurl->deleteAll($params);
		
		//.......................................
		
		$twentyDays = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-20, date("Y")));
		$params = array();		
		$params["conditions"] = array( "timestamp LIKE" => "%$twentyDays%" );
		$params["conditions"][]["owner !="]= "Anonymous";
		$params["conditions"][]["owner !="]= "Admin";
		
		$results = $this->Tinyurl->find("all", $params);
		
		App::import('Helper', 'Html');
		$html = new HtmlHelper();
		
		foreach($results as $tinyurl) {
				
			$url = "http://" . Configure::read('serverName') . "/" . $tinyurl['Tinyurl']['alias'];
			$dashboard = "http://" . Configure::read('serverName') . "/tinyurls/dashboard";
			
			$this->Email->from = 'GoFIU url shortener <noreply@fiu.edu>';
			$this->Email->to = ($tinyurl['Tinyurl']['owner'] . '<' . $tinyurl['Tinyurl']['owner'] . '@fiu.edu>');
			
			$this->Email->subject = 'GoFIU - url shortener : expiration warning';
			$body = "
Dear {$tinyurl['Tinyurl']['owner']},

The alias {$tinyurl['Tinyurl']['alias']} you've created will expire in 10 days.
If you would like to keep it, please log in and renew it.

This is the link {$url} it has been clicked on {$tinyurl['Tinyurl']['count']} times.

To renew or delete the url $dashboard here.

Thank you
-TinyUrl site
			";
			$this->Email->send($body);
			$this->Email->reset();
		}
		
		//.......................................
		
		$twoDays = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-28, date("Y")));
		$params = array();		
		$params["conditions"] = array( "timestamp LIKE" => "%$twoDays%" );
		$params["conditions"][]["owner !="]= "Anonymous";
		$params["conditions"][]["owner !="]= "Admin";
		
		$results = $this->Tinyurl->find("all", $params);
		
		foreach($results as $tinyurl) {
			
			$url = "http://" . Configure::read('serverName') . "/" . $tinyurl['Tinyurl']['alias'];
			$dashboard = "http://" . Configure::read('serverName') . "/tinyurls/dashboard";
			
			$this->Email->from = 'GoFIU url shortener <noreply@fiu.edu>';
			$this->Email->to = ($tinyurl['Tinyurl']['owner'] . '<' . $tinyurl['Tinyurl']['owner'] . '@' . Configure::read('emailDomainName'));
			$this->Email->subject = 'GoFIU - url shortener : expiration warning';
			$body = "
Dear {$tinyurl['Tinyurl']['owner']},

The alias {$tinyurl['Tinyurl']['alias']} you've created will expire in 2 days.
If you would like to keep it, please log in and renew it.

This is the link {$url} it has been clicked on {$tinyurl['Tinyurl']['count']} times.

To renew or delete the url $dashboard here.

Thank you
-TinyUrl site
			";
			$this->Email->send($body);
			$this->Email->reset();
		}
		
		$this->redirect(array('controller' => 'tinyurls', 'action' => 'index'));
		
	}
	//---------------------------------------------------------------------------------
	function renew($id) {
		$this->Tinyurl->id = $id;
		$tinyurl = $this->Tinyurl->read();
		if (
			$tinyurl["Tinyurl"]["owner"] != "" &&
			$tinyurl["Tinyurl"]["owner"] == $this->Session->read("userName")
		) {
			$tinyurl["Tinyurl"]["timestamp"] = date("Y-m-d h:i:s");
			if ($this->Tinyurl->save($tinyurl)) {
				$this->Session->setFlash("You've renewed your alias \"{$tinyurl["Tinyurl"]["alias"]}\"");
				$this->redirect(array('controller' => 'tinyurls', 'action' => 'dashboard'));
			}
		} else {
			$this->redirect(array('controller' => 'tinyurls', 'action' => 'index'));
		}
	}
	//---------------------------------------------------------------------------------
	function _newTinyUrl($data) {
		
		$BadIps = $this->BadIp->find("all");
		$evilIPs = array();
		foreach($BadIps as $value) { $evilIPs[] = $value["BadIp"]["ip"]; }
		
		$BadUrl = $this->Badurl->find("all");
		$evilUrls = array();
		foreach($BadUrl as $value) { $evilUrls[] = $value["Badurl"]["url"]; }
		
		$urlArray = parse_url($data["Tinyurl"]["url"]);
		$host = $urlArray["host"];
		
		if (
			$data["Tinyurl"]["url2"] != "" ||
			in_array($_SERVER['REMOTE_ADDR'], $evilIPs) ||
			in_array($host, $evilUrls)
		) {
			$this->Session->setFlash("I'm sorry, but I think you're a bot. If that's not the case, please contact this site's administrator. If it is, bugger off." , 'default', array('class' => 'bad_flash message'));
			return false;
		}
		
		if ($this->Malware->isMalware($data["Tinyurl"]["url"]) == true) {
			$this->Session->setFlash("The url you have submited is flagged as a malware site and will not be recorded." , 'default', array('class' => 'bad_flash message'));
			return false;
		}
		
		$isLoggedIn = $this->Session->read("isLoggedIn");		
		if (!$isLoggedIn) {
			$this->Tinyurl->anonymousUser($data);
		} else {
			$this->Tinyurl->loggedUser($data, $this->Session->read("userName"));
		}

		$owner = $this->Session->check("userName") ? $this->Session->read("userName") : "Anonymous";
		$results = $this->Tinyurl->find("first", array("conditions" => array("url" => $data["Tinyurl"]["url"], "owner" => $owner)));
		
		if (strpos($data["Tinyurl"]["url"],Configure::read('serverName'))) {
			$this->Session->setFlash("You're trying to bookmark ".Configure::read('serverName').".<br/>Don't do that!" , 'default', array('class' => 'bad_flash message'));
		} else if (!empty($results)) {
			$alias = $results["Tinyurl"]["alias"];
			$this->Session->setFlash("That url already exists.");
			$this->set('copyFunction', true);
			$this->set('alias', $alias);	
		} else if ($this->Tinyurl->save($data)) {
			
			if (strpos($data["Tinyurl"]["url"],"sites.fiu.edu/holidaycards") === false) {
				$this->Email->from = 'Tinyurl <noreply@'.Configure::read('emailDomainName').'>';
				$this->Email->to = Configure::read('approverEmail');
				$this->Email->subject = 'Tinyurl: New Entry';
				$body = "
Hey ".Configure::read('approverEmail').",

There's a new submission on TinyUrl

The link created is:
http://".Configure::read('serverName')."/{$data["Tinyurl"]["alias"]}

Which links to:
{$data["Tinyurl"]["url"]}

Click here to administer:
https://".Configure::read('serverName')."/admin

Thank you
-Tinyurl site 
			";
				$this->Email->send($body);
			}
			$alias = $data["Tinyurl"]["alias"];
			$this->Session->setFlash("Your url has been created.");
			$this->set('copyFunction', true);
			$this->set('alias', $alias);				
		} else {
			$this->Session->setFlash("Your url has NOT been created." , 'default', array('class' => 'bad_flash message'));
		}
		
	}
	//---------------------------------------------------------------------------------
	function _newBunch($data) {
		
		foreach($data["BunchUrl"] as $bunchUrl) {
			if ($this->Malware->isMalware($bunchUrl["url"]) == true) {
				$this->Session->setFlash("One of the urls you have submited is flagged as a malware site and your bunch will not be recorded.", 'default', array('class' => 'bad_flash message'));
				return;
			}
		}
		
		$bunchUrls = $data["BunchUrl"];
		$tempUrls = array();
		
		for($x = 0; $x < $data["Bunch"]["urls"]; $x++) {
			$tempUrls[] = array( "url" => $data["BunchUrl"][$x]["url"]);
		}
		
		$data["BunchUrl"] = $tempUrls;
		
		$isLoggedIn = $this->Session->read("isLoggedIn");		
		if ($isLoggedIn) {
			if(!empty($data)) {
				$data["Bunch"]["owner"] = $this->Session->read("userName");
				$data["Bunch"]["owner_ip"] = $_SERVER['REMOTE_ADDR'];
				if ($this->Bunch->saveAll($data, array("validate" => "first"))) {
					$this->Session->setFlash("Your bunch has been created.");
					$this->set('copyFunction', true);
					$this->set('bunch', $data["Bunch"]["alias"]);
				} 
			}
		}
	}
	//---------------------------------------------------------------------------------	
	//---------------------------------------------------------------------------------
}
