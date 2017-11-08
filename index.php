<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

header('X-Frame-Options: DENY');

  require_once 'config.php';
  require_once 'model/Router.class.php';

  $Router = new Router();

  $Router->installedPath = $GLOBALS['config']['base_url'];

  $Router->standardController = 'display';
  $Router->customURLs = array(
    "login" => "user/loginForm/",
    "logout" => "user/logout/"
  );
  $Router->customUrl();
  $Router->parseUrl();

  $Router->getController();
  $Router->getMethod();
  $Router->getParameters();

  $Router->parseRouter();

  if ($GLOBALS['config']['router-debug'] == true) {
    $Router->routerDebug();
  }


?>
