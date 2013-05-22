<?php

include 'parse.inc.php';
include 'items.php';
include 'locations.php';

$html = '';

/* INVENTORY DEFINITIONS:
   ====================================================================================================================== */
// inventory definitions are handled at a global level because you can carry items from room to room and sometimes
// between chapters, however these definitions are not returned until no other response has first been given from the
// main logic. this allows for items that do nothing in one particular room, but may excite another response elsewhere

$ITEMS = array ();  // Initialize item array


if ($v == "INVENTORY")
    {
    echo "You are currently carrying: <br />";
    	
    foreach ($i as $invItem)
        echo getItemShortName($invItem) . "<br />";
	
       
    
    }

// Begin Location Based Code

$itemsHere = getLocationInitialItems ($r);

if (!@$_SESSION['visited']['$r']) 
{
	$_SESSION['visited']['$r'] = true;
	
	// If this Room has never been visited then
	// print introductionary text for first time
	$html .= getLocationInitialDescription ($r);
	
	// Also show Initial List of Items in the Room
	// Show list of items
	

	if (sizeof($itemsHere) > 0)
		{
		$html .= "<br /><br />";
		foreach ($itemsHere as $item)
			$html .= getItemShortName ($item) . " is here.<br />";
			
		$html .= "<br />";	
		}
	
}
else // Room has Been Visited Before
{
	// If this room is the same as the last room visited, then don't show anything new.
	// If it's not the last room visited, show the Subsequent Description and show the items again
	//$html .= getLocationSubsequentDescription ($r);


}

// Is there a Command Preg Match for any item?
if (sizeof($itemsHere) > 0)
		{
		foreach ($itemsHere as $item)
		{
		if (preg_match (getItemRegex($item), $n)) switch ($v)
			{
			case 'LOOK': 
			
			$html .= "<blockquote><p>It appears to be " . getItemDescription($item) . "</p></blockquote>";
			
			break;
			
			case 'TAKE':
                        $html .= "<blockquote><p>You pick up " . getItemShortName($item) . "</p></blockquote>";
                        $i [] = $item;
                        break;
			
			case 'DROP':
                        $i = array_diff($i, array($item));  
                        $html .= "<blockquote><p>You drop " . getItemShortName($item) . "</p></blockquote>";    
                        break;
			}
		
		
		}
}
/* --- the phone ---------------------------------------------------------------------------------------------------------- 
if (preg_match ('/(cell )?phone/', $n)) switch ($v) 
{

case 'LOOK': $html .=  <<<HTML
<blockquote><p>
	It appears to be a Samsung Galaxy S3 on the Verizon network.
</p></blockquote>

HTML;

break;

case 'TAKE': $html .= <<<HTML
<blockquote><p>
	You pick up the cell phone.
</p></blockquote>

HTML;
    $i[] = 1;
break;

case 'USE': if (preg_match ($ITEMS['a ball of string']['regx'], $ni)) {
	$html .= <<<HTML
<p>
	You take the ball of string out of your pocket and immediately the cat’s attention is caught. You wave the ball
	about a bit and the cat’s eyes follow. As soon as you throw the ball of string the cat pounces after it into the
	corner of the room and off the mat. It sits happily in the corner batting the ball back and forth, completley
	transfixed and happy to ignore you.
</p>
HTML;
//take the item out of your inventory
	$i = array_diff ($i, array ('a ball of string'));
}; break;

default: $html .= <<<HTML
<p class="error">
	Cats are not for that purpose.
</p>
HTML;
break;
}
*/

//save any changes that occured
$_SESSION['c'] = $c;
$_SESSION['r'] = $r;
$_SESSION['s'] = $s;
$_SESSION['i'] = $i;

echo $html;

?>