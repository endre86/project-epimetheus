<?php
/**
 * AModel is the abstract top parent for all models. 
 */
class AModel
{
	public function __construct() { }
	
	/**
	 * Populates a models field members with data from assoc array.
	 * Assoc array must have key values that consist with
	 * the models field members.
	 * 
	 * @param type $assocArray
	 *		Assoc array with key value as model field member names and data
	 *		to store in them.
	 */
	public function populateFromAssocArray($assocArray)
	{
		foreach($assocArray as $key => $value)
		{
			// TODO: Surround with try-catch
			$this->$key = $value;
		}
	}
}
?>
