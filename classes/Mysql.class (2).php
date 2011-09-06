<?php
class Mysql {
	private $conn;
	private $arr=array();
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
	
	function updateLastLogged ($un){
		$q = "UPDATE users SET last_logged = logged,loggedIn = 1 WHERE username = ?";
		if($stmt = $this->conn->prepare($q)) {
			$stmt->bind_param('s', $un);
			$stmt->execute();
			$stmt->fetch();
			$stmt->close();
			return true;
		}else {return false;}
	}
	
	function logoutUser($id){
		$q = "UPDATE users SET loggedIn = 0 WHERE user_id = ?";
		if($stmt = $this->conn->prepare($q)) {			
			$stmt->bind_param('i', $id);
			$stmt->execute();
			$stmt->fetch();
			$stmt->close();
			return true;
		}else {
			return false;
		}
	}
	
    function getCategories(){
        if($stmt = $this->conn->prepare('SELECT id, name, description, lowest_price FROM category')){
            $stmt->bind_result($id, $name, $description, $lowestPrice);
            $stmt->execute();
            while($stmt->fetch()){
                $arr[$id] = array('id'=>$id, 'name'=>$name, 'description'=>$description, 'lowest_price'=>$lowestPrice);
            }
            return $arr;
        }else{
            throw new EmailException($this->conn->error);
        }
    }
    function getProductsByCatId($catId){
        if($stmt = $this->conn->prepare('SELECT * FROM products WHERE category = ?')){
            $stmt->bind_param('i', $catId);
            $stmt->bind_result($id, $category, $name, $description, $depth);
            $stmt->execute();
            while($stmt->fetch()){
                $arr[$id] = array('id'=>$id, 'category'=>$category, 'name'=>$name, 'description'=>$description, 'depth'=>$depth);
            }
            return $arr;
        }else{
            throw new EmailException($this->conn->error);
        }
    }
    function getSizesByCatId($catId){
        if($stmt = $this->conn->prepare('SELECT name, description FROM products WHERE category = ? GROUP BY name')){
            $stmt->bind_param('i', $catId);
            $stmt->bind_result($name, $description);
            $stmt->execute();
            while($stmt->fetch()){
                $arr[] = array('name'=>$name, 'description'=>$description);
            }
            return $arr;
        }else{
            throw new EmailException($this->conn->error);
        }
    }
    function getCategoryInfo($catId){
        if($stmt = $this->conn->prepare('SELECT id, name, description, description_long, lowest_price FROM category WHERE id = ?')){
            $stmt->bind_param('i', $catId);
            $stmt->bind_result($id, $name, $description, $longDesc, $lowest);
            $stmt->execute();
            while($stmt->fetch()){
                $arr = array('id'=>$id, 'name'=>$name, 'description'=>$description, 'description_long'=>$longDesc, 'lowest_price'=>$lowest);
            }
            return $arr;
        }else{
            throw new EmailException($this->conn->error);
        }
    }
    function getDepth($catId){
        if($stmt = $this->conn->prepare('SELECT depth FROM products WHERE category = ? GROUP BY depth')){
            $stmt->bind_param('i', $catId);
            $stmt->bind_result($depth);
            $stmt->execute();
            while($stmt->fetch()){
                $arr[] = $depth;
            }
            return $arr;
        }else{
            throw new EmailException($this->conn->error);
        }
    }
    function getInfoByZip($zipcode){
        if($stmt = $this->conn->prepare('SELECT city, st FROM zipcode WHERE zip = ? LIMIT 1')){
            $stmt->bind_param('i', $zipcode);
            $stmt->bind_result($city, $st);
            $stmt->execute();
            $stmt->fetch();
                $arr['zipcode'] = $zipcode;
                $arr['city'] = $city;
                $arr['state'] = $st;
            return $arr;
        }else{
            throw new EmailException($this->conn->error);
        }
    }


}