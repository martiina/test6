<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

spl_autoload_register(function($class) {
	include_once 'classes/'. $class .'.php';
});

include_once 'functions/sanitize.php';

$user = new User();

// Set timezone
date_default_timezone_set(Config::get('app.timezone'));