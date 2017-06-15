<?php

  require_once 'model/Router.class.php';
  require_once 'config.php';

  $Router = new Router();

  $Router->defaultController = 'display';
  $Router->defaultMethod = 'default';
  $Router->siteLocation = $GLOBALS['config']['base_url'];

  $Router->procesTheURL();

  if ($GLOBALS['config']['router-debug'] == true) {
    $Router->debug();
  }
?>
