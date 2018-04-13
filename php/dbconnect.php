<?php

DEFINE('DB_HOST', 'localhost');
DEFINE('DB_PORT', '54321');
DEFINE('DB_NAME', 'vorlesung');
DEFINE('DB_USER', 'student');
DEFINE('DB_PASSWORD', 'student');

try {
	$db = pg_connect('host='.DB_HOST.' port='.DB_PORT.' dbname='.DB_NAME.' user='.DB_USER.' password='.DB_PASSWORD);
} catch (Exception $e) {
	$e->getMessage();
}

?>