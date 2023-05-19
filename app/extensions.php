<?php

/*
	datetime blade extension
*/

Blade::extend(function($view, $compiler){

	$hit = $compiler->createMatcher('datetime');

	return preg_replace($hit, '$1<?php echo date(\'F d, Y H:i A\', $2) ?>', $view);
});