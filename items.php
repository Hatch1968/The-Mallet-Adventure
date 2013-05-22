<?php
// Items are things the player can take with them.



$itemArray = array();


// Item #, Item Short Name, Item Description, Item Key Words REGEX
$itemArray[] = array(1, "Hatch's Cell Phone", "a Samsung Galaxy S3 Cell Phone.", '/(cell )?phone/');
$itemArray[] = array(2, "Unopened Doctor Who Mini", "an unopened Doctor Who collectable mini figure.", '/(mini )?figure/' );
$itemArray[] = array(3, "Hatch's Comforter", "a red and green comforter Hatch has owned since 1985.", '/comforter/');



function getItemShortName ($itemNum)
{

global $itemArray;

foreach ($itemArray as $item)
	{
	if ($item[0] == $itemNum)
		return $item[1];
	}
	
	return 0;

}

function getItemDescription ($itemNum)
{

global $itemArray;

foreach ($itemArray as $item)
	{
	if ($item[0] == $itemNum)
		return $item[2];
	}
	
	return 0;

}

function getItemRegex ($itemNum)
{

global $itemArray;

foreach ($itemArray as $item)
	{
	if ($item[0] == $itemNum)
		return $item[3];
	}
	
	return 0;

}

?>