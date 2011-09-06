<?php
class Mysql {
	private $conn;
	private $arr = array();
		function __construct() {
		$this->conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or 
					  die('There was a problem connecting to the database.');
	}

    function minToHours($numMinutes){
        $hours = (int)($numMinutes / 60);
        $minutes = (int)($numMinutes % 60);
        return array('minutes'=>$minutes, 'hours'=>$hours);
    }
	
	function verify_Username_and_Pass($un, $pwd) {
				
		$query = "SELECT user_id,last_logged FROM users	WHERE username = ? AND password = ?	LIMIT 1";
		if($stmt = $this->conn->prepare($query)) {
			$stmt->bind_param('ss', $un, $pwd);
			$stmt->bind_result($userId,$lastLogged);
			$stmt->execute();
			$stmt->fetch();
			$stmt->close();
			setcookie('lastLogged',$lastLogged,time()+360000);
			return $userId;
		}else {return 0;}
	}
	
	function addToMailingList ($email){
		$q = "INSERT INTO mailinglist SET email = ?";
		if($stmt = $this->conn->prepare($q)) {
			$stmt->bind_param('s', $email);
			$stmt->execute();
            $stmt->fetch();
			return $stmt->insert_id;
		}else{
            throw new LogException($this->conn->error);
        }
	}
	

}