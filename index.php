<?php
require_once('connection.php');

// This is the main PHP file that serves all requests

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else {
    $controller = 'users'; // If no URL is given, we redirect to the main user registration page
    $action = 'register';
}

require_once('views/layout.php');
?>