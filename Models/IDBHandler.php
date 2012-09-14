<?php
interface IDBHandler
{
	/**
	 * @return DBHandler
	 *		DBHandler object (singelton), null if connection
	 */
	public static function getDBHandler();
	
	/**
	 * Adds a user to the database 
	 * 
	 * @return
	 *		True if successful, else false
	 */
	public function addUser($email, $password, $salt, $accessLevel, $firstname, $lastname);
	
	/**
	 * Edit user in database 
	 * 
	 * @return
	 *		True if successful, else false
	 */
	public function editUser($email, $accessLevel, $firstname, $lastname, $phone, $oldemail);
	
	
	/**
	 * Change a users password.
	 * Uses $_SESSION['user']['email'] to target user.
	 * 
	 * @param $password
	 *		New password 
	 */
	public function changeUserPassword($email, $password);
	/**
	 * Logs in a user
	 * 
	 * @return
	 *		Users data according to User model, or null if unsuccessfull
	 */
	public function loginUser($email, $password);
	
	/**
	 * Create authentication cookie
	 * 
	 * @param $email
	 *		Users email
	 * @param $expiration
	 *		Date cookie should expire
	 * 
	 * @return
	 *		Cookie value, else null 
	 */
	public function createAuthCookie($email, $expiration);
}
?>