<?php
/**
 * Echo out a tree showing an array (of arrays etc..)
 * 
 * @param type $array
 *		Array to show
 * @param type $offset
 *		Since using <pre>, set an initial tab offset
 * @param type $maxLevel 
 *		How deep into arrays of arrays to go?
 */
function echoArrayTree($array, $offset = 0, $maxLevel = 0)
{
	if(is_array($array) || is_object($array))
	{
		echo '<pre>' . arrayTree($array, '', $offset, $offset, $maxLevel) . '</pre>';
	}
	else if(empty($array))
	{
		echo 'Was given an empty variable..';
	}
	else
	{
		echo 'Found value "' . $array . '", not a tree of values..';
	}
}

/*
 * Used by echoArrayTree function.
 * Iterates over arrays of arrays etc and returns key => value as string 
 */
function arrayTree($array, $tree, $offset, $orgOffset, $maxLevel, $currLevel = 0)
{	
	foreach($array as $key => $value)
	{
		for($i = 0; $i < $offset; $i++)
		{
			$tree = $tree . '	';
		}
		
		$tree = $tree . $key;
		if(is_array($value) || is_object($value))
		{
			if($maxLevel !== 0 && $currLevel > $maxLevel)
			{
				$tree = $tree . 'MAX LEVEL REACHED.. <br />';
			}
			else
			{
				if(is_object($value))
				{
					$tree = '('. get_class($value) . ')' . $tree . ' -> ' . '<br />';
				}
				else
				{
					$tree = $tree . ' => ' . '<br />';
				}
				
				$tree = arrayTree($value, $tree, ($offset + 1), $orgOffset, $maxLevel, ($currLevel + 1));
			}
		}
		else
		{
			$tree = $tree . ' = ' . $value . '<br />';
			
			if($offset == $orgOffset)
			{
				$tree = $tree . '<br />';
			}
		}
	}
	return $tree . '<br />';
}
?>
