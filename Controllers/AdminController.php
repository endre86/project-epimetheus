<?php
require_once 'AController.php';
require_once 'Models/User.php';

class AdminController extends AController
{
	public function __construct() 
	{
		parent::__construct($this);
		parent::restrictAccess('admin');
		
		$this->pathToViews = $this->pathToViews . 'Admin/';
	}
	
	public function Index()
	{
	    $this->renderView('Index');
	}
	
	public function AddUser($err = null)
	{
	    if($_SERVER['REQUEST_METHOD'] === 'POST')
	    {
			if(User::addUser($_POST['email'], $_POST['password'], $_POST['accessLevel'], $_POST['firstname'], $_POST['lastname'], $_POST['phone']))
			{
				$this->ViewUser($_POST['email']);
			}
			else
			{
				unset($_POST);
				$this->renderView('AddUser', array('error' => true));
			}
	    }
	    else
	    {
		$this->renderView('AddUser');
	    }
	}
	
	public function EditUser($email = null, $error = false)
	{
		if($_SERVER['REQUEST_METHOD'] === 'POST' &&
				User::editUser($_POST['old_email'], $_POST['email'], $_POST['accessLevel'], $_POST['firstname'], $_POST['lastname'], $_POST['phone']))
		{
			$this->ViewUser($_POST['email']);
		}
		else
		{
			$user = User::getUser($email);
			if($error)
			{
				$user['error'] = true;
			}
			$this->renderView('EditUser', $user);
		}
	}
	
	public function ViewUser($email, $error = false)
	{		
		$user = User::getUser($email);
		if(!empty($user))
		{
			if($error === true)
			{
				$user['error'] = true;	
		}
			$this->renderView('ViewUser', $user);
		}
		else
		{
			$this->ListAllUsers();
		}
		
		
	}
	
	public function DeleteUser($email, $confirm = false)
	{
		parent::restrictAccess('superadmin');
		
		if(User::deleteUser($email))
		{
			$this->ListAllUsers();
		}
		else
		{
			$this->ViewUser($email, true);
		}
	}
	
	public function ListAllUsers($fromLimit = 0, $toLimit = 50)
	{
		$allUsers = User::getAllUsers($fromLimit, $toLimit);
		if(empty($allUsers))
		{
			$allUsers = array('error' => true);
		}
		
		$this->renderView('ListAllUsers', $allUsers);
	}
}
?>