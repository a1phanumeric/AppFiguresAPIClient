<?php

class AppFiguresAPIClient{
	
	// Variables
	private $appFiguresAPIURL = 'https://api.appfigures.com/v1.1';
	
	private $username = '';
	private $password = '';
	private $userData = array();
	
	private $errorCodes = array(400 => "One of the parameters in the request are incorrect or invalid.",
															401 => "Unauthorised. The user or password are incorrect.",
															403 => "The authenticated user does not have permission to access the requested resource.",
															404 => "The resource you are requesting does not exist. Make sure the URL is correct.",
															420 => "You have exceeded the number of allowed requests for the day.",
															500 => "A general error that means something's wrong on our side.",
															503 => "The API is currently unavailable due to maintenance.");
	
	
	
	public $lastResponse = array();
	public $error = '';
	
	
	// Constructor
	function AppFiguresAPIClient($username, $password){
		$this->username = $username;
		$this->password = $password;
		if(!$this->GetUserData()){
			die('[AppFiguresAPIClient] Could not retrieve user data.');
		}
	}
	
	
	
	// Private functions
	private function SendRequest($resourcePath){
		$ch = curl_init($this->appFiguresAPIURL . $resourcePath);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $additionalHeaders));
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_USERAGENT, 'AppFiguresAPI (PHP)');
		$this->lastResponse = json_decode(curl_exec($ch), true);
		return $this->ParseResponse();
	}
	
	private function ParseResponse(){
		if($this->errorCodes[$this->lastResponse['status']]){
			$this->error = $this->errorCodes[$this->lastResponse['status']];
			return false;
		}
		return $this->lastResponse;
	}
	
	
	
	// Public functions
	public function GetUserData($emailAddress = false){
		// If we haven't got the user data yet, perform the API call.
		// Otherwise return what we retrieved earlier.
		// This is simply to save on making un-necessary API calls.
		if(empty($this->userData)){
			if(!$emailAddress) $emailAddress = $this->username;
			$resourcePath = "/users/{$this->username}";
		
			if($this->SendRequest($resourcePath)){
				$this->userData = $this->lastResponse; 
				return $this->lastResponse;
			}
		}else{
			return $this->userData;
		}
	}
	
	public function GetProducts(){
		if(empty($this->userData)){
			$this->error = 'The user data is empty. The API possibly failed to connect (but you should have been warned about this?)';
			return false;
		}
		
		return $this->userData['products'];
		
	}
	
}

?>