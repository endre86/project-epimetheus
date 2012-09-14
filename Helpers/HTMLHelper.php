<?php
	class HTMLHelper
	{		
		
		private $js;
		/**
		 * Create a link to a location on site
		 * 
		 * @param type $target
		 *		Target (ie. Home/Search)
		 * @param type $name 
		 *		Link name / text (ie "Search Page")
		 */
		public function createLocalLink($target, $name)
		{
			return '<a href="' . $GLOBALS['PAGE']['root_dir'] . $target . '">' . $name . '</a>';
		}
		
		public function getRootDir()
		{
			return $GLOBALS['PAGE']['root_dir'];
		}
		
		/**
		 * Add a javascript to the HTML helper
		 * 
		 * @param type $javascript 
		 *		Full path to js file
		 */
		public function addJS($javascript)
		{
			$this->js = $this->js . '<script type="text/javascript" src="'. $GLOBALS['PAGE']['root_dir'] . $javascript . '"></script>';
		}
		
		/**
		 * Include javascripts added through
		 * HTMLHelper::addJS in source code 
		 */
		public function includeJS()
		{
			echo $this->js;
		}
	}
?>
