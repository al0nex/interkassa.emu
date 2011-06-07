<?php

$last_error = '';

function set_last_error($error)
{
	$GLOBALS['last_error'] = $error;
}

function clear_last_error()
{
	$GLOBALS['last_error'] = '';
}

function has_last_error()
{
	return !empty($GLOBALS['last_error']);
}

?>
