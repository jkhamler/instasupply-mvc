<?php
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

// we're adding an entry for the new controller and its actions
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