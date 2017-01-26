<?php

/**
 * This method is responsible for calling the correct controller actions based on the URL request
 *
 * @param $controller
 * @param $action
 */
function call($controller, $action)
{
    require_once('controllers/' . ucfirst($controller) . 'Controller.php');

    switch ($controller) {
        case 'users':
            // we need the model to query the database later in the controller
            require_once('models/user.php');
            $controller = new UsersController();
            break;
    }

    $controller->{$action}();
}

// This is where we register the controllers and controller actions
$controllers = array(
    'users' => ['register', 'listing']
);

if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('users', 'error');
    }
} else {
    call('users', 'error');
}
?>