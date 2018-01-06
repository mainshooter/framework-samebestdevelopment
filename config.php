<?php
  $config;

  $config['project-name'] = 'Project naam';
  $config['project-author'] = 'Peter Romijn';
  $config['project-company'] = 'SameBestDevelopment';

  $config['base_url'] = 'http://localhost/framework/';
  // Location of our site;
  // You need to change this when it is in a diffrent folder our
  // If it is in the root folder than it must be empty!

  $config['db-ip'] = '';
  $config['db-port'] = 3306;
  $config['db-user'] = '';
  $config['db-password'] = '';
  $config['db-name'] = '';
  // DB config


  $config['mail-host'] = '';
  $config['mail-userName'] = '';
  $config['mail-password'] = '';
  $config['mail-SMTPSecure'] = '';
  $config['mail-port'] = '';
  $config['mail-sendFormAdress'] = '';
  $config['mail-senderName'] = '';
  // Mail config

  $GLOBALS['config'] = $config;

?>
