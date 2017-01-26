<?php

class UsersController
{
    public function register()
    {
        require_once('views/users/register.php');
    }

    public function listing()
    {
        $users = User::all();

        require_once('views/users/listing.php');
    }

    public function error()
    {
        require_once('views/users/error.php');
    }
}

?>