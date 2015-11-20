<?php

/*
 * Converts all HTML characters to their applicable symbols.
*/
function escape($input) {
	return htmlentities($input, ENT_QUOTES, 'UTF-8');
}

/*
 * Calculate percentage
*/
function percentage($value, $max) {
	return ($value/$max)*100;
}