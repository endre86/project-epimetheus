<?php
require_once 'AModel.php';
require_once 'DBHandler.php';

/**
 * User model 
 */
class User extends AModel
{
    /*
    * Access lvls used within application
    */
   public static $accesslvls = array(
       'view' => 1,
       'edit' => 2,
       'delete' => 3,
       'admin' => 8,
       'superadmin' => 9
   );
	
    public $email;
    public $accessLevel;
    public $firstname;
    public $lastname;
    public $phone;

    public function __construct($email, $accessLevel, $firstname, $lastname, $phone) 
    {
	parent::__construct();
	$this->email = $email;
	$this->accessLevel = $accessLevel;
	$this->firstname = $firstname;
	$this->lastname = $lastname;
	$this->phone = $phone;
    }

    public function getName()
    {
		return $this->firstname . ' ' . $this->lastname;
    }
    

    /**
     * Checks if user has a specific access level.
     * 
     * This is a static method and will check with the
     * session variable $_SESSION['USER']
     * 
     * @param $access
     *		Either integer access level or name of access level as found in User::accesslvls (private)
     * 
     * @return bool
     *		True if it was found that user has access, else false
     */
    public static function hasAccessTo($access)
    {
		if(!isset($_SESSION['USER']) || !is_a($_SESSION['USER'], 'User'))
		{
			return false;
		}

		if(is_int($access))
		{
			return $this->accessLevel >= $access;
		}

		$access = strtolower($access);
		if(array_key_exists($access, self::$accesslvls))
		{
			return $_SESSION['USER']->accessLevel >= self::$accesslvls[$access];
		}

		return false;
    }

    /**
     * Add a user to the database
     * @param String $email
     * @param String $password
     * @param int $accessLevel
     *		Access level given to a user, accordint to $PAGE['accessLevel']
     * @param String $firstname
     * @param String $lastname
     * @param int $phone
     * 
     * @return boolean
     *		True if user was added, else false 
     */
    public static function addUser($email, $password, $accessLevel, $firstname, $lastname, $phone)
    {
		$db = DBHandler::getDBHandler();
		return $db->addUser($email, $password, $accessLevel, $firstname, $lastname, $phone);
    }
	
	public static function editUser($oldEmail, $email, $accessLevel, $firstname, $lastname, $phone)
	{
		$db = DBHandler::getDBHandler();
		return $db->editUser($oldEmail, $email, $accessLevel, $firstname, $lastname, $phone);
	}
	
	public static function deleteUser($email)
	{
		$db = DBHandler::getDBHandler();
		return $db->deleteUser($email);
	}

    public static function getUser($email)
    {		
		$db = DBHandler::getDBHandler();
		return $db->getUser($email);
    }
	
	public static function getAllUsers($fromLimit = 0, $toLimit = 50)
	{
		$db = DBHandler::getDBHandler();
		return $db->getAllUsers();
	}

    /**
     * Logs a user in and stores user object in
     * $_SESSION['USER']
     * 
     * @param type $email
     * @param type $password
     * 
     * @return boolean 
     *		True if OK, else false
     */
    public static function loginUser($email, $password, $rememberme)
    {
		$db = DBHandler::getDBHandler();
		$result = $db->loginUser($email, $password);

		if(empty($result))
		{
			return false;
		}

		$_SESSION['USER'] = new User($result['email'], $result['accessLevel'], $result['firstname'], $result['lastname'], $result['phone']);

		if($rememberme === true)
		{
			self::createAuthCookie($result['email']);
		}

		return true;
    }

    public static function authUserByAuthCookie()
    {
		$db = DBHandler::getDBHandler();
		$result = $db->getEmailByAuthCookie($_COOKIE['pe_auth_cookie'], date('Y-m-d h:i:s'));
		if(empty($result))
		{
			self::removeAuthCookie();
		}
		else
		{
			$user = $db->getUser($result['email']);
			$_SESSION['USER'] = new User($user['email'], $user['accessLevel'], $user['firstname'], $user['lastname'], $user['phone']);
			self::createAuthCookie($result['email'], $_COOKIE['pe_auth_cookie']);
		}
    }

    public function logout()
    {
		session_unset();
		session_destroy();
		isset($_COOKIE['pe_auth_cookie']) ? $oldCookie = $_COOKIE['pe_auth_cookie'] : $oldCookie = null;
		self::removeAuthCookie($oldCookie);
    }

    private static function createAuthCookie($email, $oldCookie = null)
    {
		$db = DBHandler::getDBHandler();

		if($oldCookie !== null)
		{
			$db->removeAuthCookie($oldCookie);
		}

		$cookie =  $db->createAuthCookie($email, date('Y-m-d h:i:s', time() + 604800)); // expires in 7 days

		if($cookie !== null)
		{
			setcookie('pe_auth_cookie', $cookie, time() + 604800, '/'); //project epimetheus authentication cookie, expires in 7 days
		}

		}

		private static function removeAuthCookie()
		{
		if(isset($_COOKIE['pe_auth_cookie']))
		{
			$db = DBHandler::getDBHandler();
			$db->removeAuthCookie($_COOKIE['pe_auth_cookie']);
			setcookie('pe_auth_cookie', '', time() - 60000, '/'); // expire auth cookie
		}
	}
}
?>
