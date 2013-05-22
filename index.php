<?php

//when the page is reloaded, clear the temporary information so that the chapter headings are shown again
session_start ();
unset ($_SESSION['visited']);

?><!DOCTYPE html>
<meta charset="utf-8" />
<title>The Mallet Adventure</title>
<link rel="stylesheet" href="book.css" />


<section class="page">
	
	<p class="sup">
		<br /><br /><br /><br /><br />
		J. Alan Hatcher<br /><br /> presents
	</p>
	
	<h1>The Mallet Adventure<br /> Volume 1: Noontar Rising</h1>
	
	<br /><br />
	
	<p class="center">
		Published by
	</p>
	<p class="sup">
		Pipart · Games<br />
	</p>
	<p class="sup center">
		2013
	</p>
	
</section>

<section class="page">




<p class="sup">
	<br /><br /><br /><br /><br />
	Prologue
</p>
<h2>Hatch Arrives</h2>

<blockquote><p>
	"Butt is bad.  Hatch is worse." - Unknown<br /><br />
</p></blockquote>

<blockquote>
<p>
	Hatch left Nashville at 11pm on a Thursday night to drive down to Tuscaloosa. The A Day game was this weekend, and more importantly the annual spring party called The Spring Orgy.
        A weekend of spending time with old friends and new gave Hatch a warm feeling as he finally turned off McCorvey Drive and rolled the passenger side window down as he passed Palmer Hall.
</p>
</blockquote>
</section>
<!-- PAGE BREAK -->
<section class="page">
<header><hgroup>
	<h1>Chapter One</h1>
	<h2>Location: The White Nissan Frontier</h2>
</hgroup></header>




</p>
<blockquote>
<p>
	Hint: Try typing “<samp>look at phone</samp>” (sans-quotes) now and pressing <kbd>Enter</kbd> to
	continue.
</p>
</blockquote>
<form id="input" method="post" action="game.php" />
	<label for="q">
		¶ <input type="text" id="q" name="q" autocomplete="off" />
	</label>
	<input type="submit" id="enter" />
</form>

</section>


<p id="copyright"><small>Engine Copyright © Kroc Camen 2011, <a rel="licence" href="http://creativecommons.org/licenses/by/3.0/deed.en_GB">cc-by</a> creative commons attribution 3.0 licence</small></p>
<script src="jquery-1.6.1.min.js"></script>
<script>

$(function() {
	//tided up and improved by @mathias
	var $input = $('#input'),
	    $q = $('#q'),
	    $window = $(window)
	;
	$input.submit(function() {
		$.post('game.php', $input.serialize(), function(response) {
			// split into pages
			var pages = response.split('<!-- PAGE BREAK -->'),
			    $section
			;
			// the first piece of text is always inserted to the end of the current page
			$input.before(pages.shift());
			// and if there was any more pages,
			if (pages.length) {
				// insert them
				$.each(pages, function(i, text) {
					$section = $('<section class="page">' + text + '</section>');
					$('section:last').after($section);
				});
				// then move the input box to the last page
				$section.append($input);
			}
			$q.val('');
		});
		return false;
	}).submit();
	
	$window.scroll(function() {
		var top = $q.offset().top;
		if (top >= $window.scrollTop() && top <= $window.scrollTop() + $window.height()) {
			$q.focus();
		}
	}).scroll().click(function() {
		$window.scroll();
	});
});

</script>