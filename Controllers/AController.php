<?php
require_once 'Load.php';
require_once 'Models/User.php';
/**
 * Abstract controller, parent to all controllers.
 * 
 * Deals with some initial setup and access restrictions.
 * 
 * It is the childrens job to keep the paths to views and models updated
 * beyond the root Views and Models folders.
 */
abstract class AController
{
	protected $controller;
	/** Alter / overwrite when using views in other folder than /Views */
	protected $pathToViews = 'Views/';
	private $pathToSharedViews = 'Views/Shared/';
	/** Alter / overwrite when using models in other folder than /Models */
	protected $pathToModels = 'Models/';

	private $load;

	/**
	 * Create a new AController
	 * @param AController $controller
	 *		Object that initialtes this abstract class. 
	 */
	protected function __construct(AController $controller)
	{
		$this->initSetup();
		$this->authUserCookie();
		$this->controller = $controller;
		$this->load = new Load();
	}

	public function __destruct() 
	{
		if(!empty($_SESSION['USER']))
		{
			$_SESSION['USER'] = serialize($_SESSION['USER']);
		}
		else 
		{
			unset($_SESSION);    
		}
	}
	
	/**
	 * Renders a view
	 * 
	 * @param view
	 *		Name of view 
	 *		Uses $this->pathToViews . $view . '.php' OR
	 *		$this->pathToSharedViews if it could not find the file OR
	 *		shows $this->pathToSharedViews/404.php if it could no find the file
	 *		(
	 * @param data
	 *		Supplied data (extracted in Load if array!)
	 */
	public function renderView($view, $data = null)
	{
		if(file_exists($this->pathToViews . $view . '.php'))
		{
		$this->load->load($this->pathToViews . $view . '.php', $data);
		}
		elseif(file_exists($this->pathToSharedViews . $view . '.php'))
		{
		$this->load->load($this->pathToSharedViews . $view . '.php', $data);
		}
		else
		{
		$this->load->load($this->pathToSharedViews . '404.php');
		}
	}

	/**
	 * Renders the no access view
	 */
	public function renderNoAccessView()
	{
		$this->load->load($this->pathToSharedViews . '403.php');
	}

	/**
	 * Call this method to restrict access to
	 * a method.
	 * 
	 * Will automagickly show access denied and kill
	 * rest of script
	 * 
	 * @param type $accessLevel
	 *		Access level needed to do function.
	 *		ex: 2 or 'view' or 'admin', as found in User::accesslvls
	 */
	public function restrictAccess($accessLevel)
	{
		if(!User::hasAccessTo($accessLevel))
		{
			$this->renderNoAccessView();
			exit;
		}
	}

	/**
	 * Default method called on controllers.
	 * Not implemented here. 
	 */
	public function Index() { }
	
	/*
	 * Initial setup stuff that happens "before anything else"
	 * in the application.
	 */
	private function initSetup()
	{
		require_once 'Models/User.php';
		if(!empty($_SESSION['USER']))
		{
			$_SESSION['USER'] = unserialize($_SESSION['USER']);
		}
	}

	/*
	 * Checks for auth cookie and invokes user
	 * authentication if found
	 */
	private function authUserCookie()
	{
		if(!isset($_SESSION['USER']))
		{
			if(isset($_COOKIE['pe_auth_cookie']))
			{
				User::authUserByAuthCookie();
			}
		}
	}
}
?>
