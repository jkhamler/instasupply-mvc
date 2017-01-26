<?php
require_once('connection.php');

// This is the home page that serves all requests and redirects to the correct controller actions

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else {
    $controller = 'users'; // If no URL is given, we redirect to the main user registration page
    $action = 'register';
}

require_once('views/layout.php');
?>