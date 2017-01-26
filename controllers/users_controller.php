<?php
  class UsersController {
    public function register() {
      // we store all the users in a variable
//      $users = User::all();
      require_once('views/users/register.php');
    }

    public function listing() {
      require_once('views/users/listing.php');
    }

    public function error() {
      require_once('views/users/error.php');
    }
  }
?>