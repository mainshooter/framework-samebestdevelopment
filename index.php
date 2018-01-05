<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

header('X-Frame-Options: DENY');

  require_once 'config.php';
  require_once 'model/Router.class.php';

  $Router = new Router2('http://localhost/framework/');
  $Router->set_default_controller('display');
  $Router->proces_router();

  if ($GLOBALS['config']['router-debug'] == true) {
    // $Router->routerDebug();
  }


?>
