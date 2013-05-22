<?php

$locationArray = array();


// Location #, Location Short Name, Initial Description, Subsequent Description, Initial Items at Location
$locationArray[] = array(0, "The White Nissan Frontier",
 'You are sitting in the driver\'s seat of Hatch\'s white Nissan Frontier, having just parked across the street from Palmer Hall in Billy\'s parking space after yelling "Fuck You Mallet!" as you drove by.  Your right arm is resting on the center <em>console</em>.',
'You are sitting in the drivers\'s seat of Hatch\'s white Nissan Frontier.', 
array (1,3));

$locationArray[] = array(1, "Palmer Hall Front Stoop", 
'You walk up to the front stoop of Palmer Hall.  There are several benches and ashtrays here.  There is a small porch at the top of the steps.',
'You walk up to the front stoop of Palmer Hall.',    
array ());    


function getLocationShortName ($location)
{

global $locationArray;

foreach ($locationArray as $loc)
	{
	if ($loc[0] == $itemNum)
		return $loc[1];
	}
	
	return 0;

}

function getLocationInitialItems ($location)
{

global $locationArray;

foreach ($locationArray as $loc)
	{
	if ($loc[0] == $location)
		return $loc[4];
		
	}
	
	return 0;

}

function getLocationInitialDescription ($location)
{

global $locationArray;

foreach ($locationArray as $loc)
	{
	if ($loc[0] == $itemNum)
		return $loc[2];
	}
	
	return 0;

}
?>