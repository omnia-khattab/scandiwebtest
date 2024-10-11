<?php
require __DIR__ . '/vendor/autoload.php'; // Use Composer's autoloader

use Utils\Connection;

$connection = new Connection();
$connection->connect();

// header("Location: /frontend/index.js");
// exit();

?>