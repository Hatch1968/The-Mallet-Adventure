<?php

//is this a request from JavaScript?
//(if so, only the text to add will be sent, rather than the whole page)
define (IS_AJAX, @$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest');

//retreieve current progress
session_start ();
$c = isset ($_SESSION['c']) ? $_SESSION['c'] : 0;		//chapter
$r = isset ($_SESSION['r']) ? $_SESSION['r'] : 0;		//room number
$lr = isset ($_SESSION['lr']) ? $_SESSION['lr'] : 0;		//last room number visited
$s = isset ($_SESSION['s']) ? $_SESSION['s'] : 0;		//step (or 'scene')
$i = isset ($_SESSION['i']) ? $_SESSION['i'] : array ();	//inventory

define ('QUERY', strtolower (trim (@$_POST['q'])));		//query
//echo "Quer = " . QUERY . "<br />";
//provide a way to forget current game progess (debugging)
if (QUERY == "end") {
	session_unset ();
	session_destroy ();
	exit (<<<HTML
<p><small>
	Your current session state has been cleared. Please reload the page to start again.
</small></p>
HTML
	);
}

//identify the verbs
foreach (array (
	'TAKE'  => '/^(?:take|pick up|get) (.+)/',
        'DROP'  => '/^drop (.+)/',
	'LOOK'  => '/^(?:look(?: at| in)?|read) (.+)/',
	'OPEN'  => '/^open (.+)/',
	'INVENTORY' => '/^(?:inv|i|inventory)/',
	'CLOSE' => '/^(?:close|shut) (.+)/',
	'GOTO'  => '/^(?:go(?: ?to| through)?|enter) (.+)/',
	'TALK'  => '/^(?:talk|speak)(?: to)? (.+)/',
	'USE'   => '/^use (.+?)(?: (?:on|with) (?>(.+)))?$/',
	''	=> '//'

//the verb goes into $v, and if matched stops checking for more verbs
) as $v => $regx) if (preg_match ($regx, QUERY, $_)) {
	$n  = isset ($_[2]) ? $_[2] : $_[1];
	$ni = isset ($_[2]) ? $_[1] : '';
	break;
}

//echo ("$v: '".QUERY."' / '$n' : '$ni'");

?>