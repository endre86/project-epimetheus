<?php
/*
 * This is where the initial magic happens.
 * Router takes the url input given from htaccess and creates the controller,
 * call the intended method and pass the data.
 */
if(!isset($_GET['url'])) 
{	// If no information about what to show is given:
	require_once 'Controllers/HomeController.php'; // Get home controller
	$controller = new HomeController(); // Create new home controller
	$controller->Index(); // Call index method
}
else
{	// Lets parse the info and get the requested view
	$params = explode('/', $_GET['url']); // Get info from url
	$controllerName = $params[0]  . 'Controller'; // Get controller name from url
	
	if(file_exists('Controllers/' . $controllerName . '.php')) // Check if controller exists
	{
	// If it exists..:
		require_once 'Controllers/' . $controllerName . '.php'; // Require controllers class file
		$controller = new $controllerName(); // Initiate controller
		$action = isset($params[1]) && !empty($params[1]) && method_exists($controller, $params[1]) ? $params[1] : 'Index'; // Get action from url, else use Index()
		$data = array_slice($params, 2); // Get optional parameters
		unset($params); // Unset the $params variable
		
		call_user_func_array(array($controller, $action), $data);
	}
	else
	{	// If controller does not exist
		include 'Views/Shared/404.php'; // Include 404 page
	}
}
?>