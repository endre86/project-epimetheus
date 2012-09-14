<?php
require_once 'IDBHandler.php';

class DBHandler implements IDBHandler
{
	private $username = 'proj-ep';
	private $password = 'pe';
	private $host = 'localhost';
	private $database = 'project-epimetheus';
	
	private static $dbHandler = null;
	private $mysqli = null;
	
	private function __construct() 
	{
		$this->mysqli = new mysqli($this->host, $this->username, 
				$this->password, $this->database);
	}
	
	public function __destruct() 
	{
		$this->mysqli->close();
	}
	
	public static function getDBHandler()
	{
		// This is an singelton, so need to check if DBHandler is created
		if(self::$dbHandler === null)
		{
			self::$dbHandler = new DBHandler();
			if(self::$dbHandler->mysqli->connect_error)
			{
				self::$dbHandler = null;
				return null;
			}
		}
		
		return self::$dbHandler;
	}

	public function addUser($email, $password, $accessLevel, $firstname, 
			$lastname, $phone) 
	{		
		$salt = $this->generateSalt(50);
		$password = hashPassword($password, $salt);
		
		$stmt = $this->mysqli->prepare(
				'INSERT INTO user (email, password, salt, accessLevel, 
					firstname, lastname, phone) VALUES (?,?,?,?,?,?,?)'
			);
		$stmt->bind_param(
				'sssissi', $email, $password, $salt, $accessLevel, $firstname, 
				$lastname, $phone
			);
		$result = $stmt->execute();
		
		$stmt->close();
		return $result;
	}
	
	public function getUser($email)
	{
		$stmt = $this->mysqli->prepare(
				'SELECT email, accessLevel, firstname, lastname, phone
					FROM user WHERE email=?
			');
		$stmt->bind_param('s', $email);
		$stmt->execute();	
		
		$result = $this->createAssocArrayOfResult($stmt);
		$stmt->close();
		return $result;
	}
	
	public function getAllUsers($from = 0, $numHits = 50)
	{
		// TODO: Add count num users and use in view to show "next 50" button etc.
		$stmt = $this->mysqli->prepare(
				'SELECT email, accessLevel, firstname, lastname, phone
					FROM user LIMIT ?,?'
			);
		$stmt->bind_param('ii', $from, $numHits);
		$stmt->execute();
		
		$result = $this->createAssocArrayOfResult($stmt);
		$stmt->close();
		return $result;
	}

	public function editUser($oldEmail, $email, $accessLevel, $firstname, 
			$lastname, $phone)
	{
		$stmt = $this->mysqli->prepare(
				'UPDATE user SET email=?, accessLevel=?, firstname=?, 
					lastname=?, phone=? WHERE email = ?'
			);
		$stmt->bind_param('sissis', $email, $accessLevel, $firstname, $lastname, 
				$phone, $oldEmail);
		$result = $stmt->execute();
		
		$stmt->close();
		return $result;
	}
	
	public function deleteUser($email)
	{
		$stmt = $this->mysqli->prepare('DELETE FROM user WHERE email=?');
		$stmt->bind_param('s', $email);
		$result = $stmt->execute();
		
		$stmt->close();
		return $result;
	}
	
	public function changeUserPassword($email, $password)
	{
		$salt = $this->generateSalt();
		$password = hashPassword($password, $salt);
		
		$stmt = $this->mysqli->prepare(
				'UPDATE user SET password=?, salt=? WHERE email=?'
			);
		$stmt->bind_param('sss', $email, $password, $salt);
		$result = $stmt->execute();
		
		$stmt->close();
		return $result;
	}

	public function loginUser($email, $password) 
	{
		$salt = $this->getUserSalt($email);
		
		if($salt === false)
		{
			return null;
		}
		
		$password = hashPassword($password, $salt);
		
//		for($i = 0; $i < 1000; $i++)
//		{
//			$password = hash('sha512', $password);
//		}
		
		$stmt = $this->mysqli->prepare(
				'SELECT email, accessLevel, firstname, lastname, phone 
					FROM user WHERE email=? AND password=?'
			);
		$stmt->bind_param('ss', $email, $password);
		$stmt->execute();
		
		$result = $this->createAssocArrayOfResult($stmt);
		$stmt->close();
		return $result;
	}
	
	public function createAuthCookie($email, $expiration)
	{
		$rand = $this->generateSalt(rand(15, 100));
		$cookie = hash('sha512', $email . $rand . $expiration);
		
		$stmt = $this->mysqli->prepare(
				'INSERT INTO user_cookie (email, cookie, expires) VALUES (?,?,?)'
			);
		$stmt->bind_param('sss', $email, $cookie, $expiration);
		
		if(!$stmt->execute())
		{
			$cookie = null;
		}
		
		$stmt->close();
		return $cookie;
	}
	
	public function getEmailByAuthCookie($auth_cookie, $expiration)
	{
		$stmt = $this->mysqli->prepare(
				'SELECT email FROM user_cookie WHERE cookie=? AND expires >= ?'
			);
		$stmt->bind_param('ss', $auth_cookie, $expiration);
		$stmt->execute();
		
		$result = $this->createAssocArrayOfResult($stmt);
		$stmt->close();
		return $result;
	}
	
	public function removeAuthCookie($auth_cookie)
	{
		$stmt = $this->mysqli->prepare('DELETE FROM user_cookie WHERE cookie=?');
		$stmt->bind_param('s', $auth_cookie);
        $result = $stmt->execute();
		
		$stmt->close();
		return $result;
	}
	
	/*
	 * Returns an select queries result as (assoc) array.
	 * 
	 * If multiple rows were selected:
	 * array[row_number][field_name]
	 * 
	 * If one row was selected:
	 * array[field_name]
	 * 
	 * This method also checks that there is actually a valid result
	 * and will return an empty array if not.
	 */
	private function createAssocArrayOfResult(mysqli_stmt $statement)
	{
		$statement->store_result();
		
		if($statement->num_rows <= 0)
		{
			return array();
		}
		
		$meta = $statement->result_metadata();

		while ($field = $meta->fetch_field()) { 
			$params[] = &$row[$field->name]; 
		}
		
		call_user_func_array(array($statement, 'bind_result'), $params);  
		
		if($statement->num_rows === 1)
		{
			$statement->fetch();
			foreach($row as $key => $val) 
			{ 
				$result[$key] = $val; 
			}
		}
		
		while ($statement->fetch()) { 
			foreach($row as $key => $val) 
			{ 
				$c[$key] = $val; 
			} 
			$result[] = $c; 
		}
		
		return $result;
	}
	
	/*
	 * Gets a users salt
	 * 
	 * @return
	 *		False if fails, else returns salt
	 */
	private function getUserSalt($email)
	{
		$stmt = $this->mysqli->prepare('SELECT salt FROM user WHERE email=?');
		$stmt->bind_param('s', $email);
		$stmt->execute();
		
		$stmt->bind_result($salt);
		if(!$stmt->fetch())
		{
			$salt = false;
		}
		
		$stmt->close();
		return $salt;
	}
	
	/**
	* This function generates a password salt as a string of x (default = 15) characters
	* in the a-zA-Z0-9!@#$%&*? range.
	* @param $max integer The number of characters in the string
	* @return string
	* @author AfroSoft <info@afrosoft.tk>
	*/
	private function generateSalt($max = 15) 
	{
		$characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
        $i = 0;
        $salt = "";
        while ($i < $max) {
            $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
            $i++;
        }
        return $salt;
	}
	
	private function hashPassword($password, $salt)
	{
		$password = hash('sha512', $password . $salt);
		$password = hash('sha512', $salt . $password);
		
		for($i = 0; $i < 500; $i++)
		{
			$password = hash('sha512', $password);
		}
	}
}
?>
