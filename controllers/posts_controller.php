<?php
  class PostsController {
    public function register() {
      // we store all the posts in a variable
//      $posts = Post::all();
      require_once('views/posts/register.php');
    }

    public function listing() {
      require_once('views/posts/listing.php');
    }

    public function error() {
      require_once('views/posts/error.php');
    }
  }
?>