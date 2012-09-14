<?php
require_once 'AController.php';
require_once 'Models/User.php';

class HomeController extends AController
{
	public function __construct() 
	{
		parent::__construct($this);
		$this->pathToViews = $this->pathToViews . 'Home/';
	}
	
	public function Index($data = null)
	{
		if(User::hasAccessTo('view'))
		{
		$this->renderView('Search', $data);
		}
		else
		{
		$this->renderView('Login', $data);
		}
	}
	
	public function Login()
	{
		if(User::loginUser($_POST['email'], $_POST['password'], isset($_POST['rememberme'])))
			{
				$this->Index();
			}
			else
			{
				$this->Index(array('error' => true));
			}
	}
	
	public function Logout()
	{
		if(isset($_SESSION['USER']))
		{
			$_SESSION['USER']->logout();
		}
		$this->Index();
	}
	
	public function Search($search)
	{
		if(is_array($search))
		{
			//$result = InterviewObject::AdvancedSearch($search);
		}
		elseif(is_string($search))
		{
			//$result = InterviewObject::generalSearch();
		}
		
		$this->renderView('SearchResult', $result);
	}
}
?>
