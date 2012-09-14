<?php
/**
 * Load takes care of loading in a view. 
 * Using Views/Shared/Layout/default.php as default layout.
 */
class Load
{
	
	private $layout_root_dir = 'Views/Shared/Layouts/';
	private $layout = 'default.php';
	
	function __construct() 
	{
		// If using mobile, change $layout to mobile layout ? 
	}
	
	/**
	 * Load a view and data
	 * 
	 * @param type $view
	 *		View, with full path from root directory.
	 * @param type $data 
	 *		Data passed.
	 *		If assoc array, variables are extracted
	 *		If extraction collides, uses prefix 'extracted_'
	 */
	public function load($view, $data = null)
	{
		if(is_array($data)) { extract($data, EXTR_PREFIX_SAME, "extracted_"); } // Extract data (?) Prefix existing vars.		
		include $this->layout_root_dir . $this->layout; // Include the layout
							   // (which _should_ include $view..)
		unset($data); // Unset the data
	}
	
	/**
	 * Set the layout that should be used when rendering the view.
	 * Default: Default.php
	 * 
	 * @param type $pathToLayout 
	 *		Path from /Views/Shared/Layout/
	 *		Ex: 'default.php' or 'Mobile/default.php'
	 */
	public function setLayout($pathToLayout)
	{
		$this->layout = $pathToLayout;
	}
	
	/**
	 * Returns full path to layout
	 * ex: Views/Shared/Layout/default.php 
	 */
	public function getLayout()
	{
		return $this->layout_root_dir . $this->layout;
	}
}
?>