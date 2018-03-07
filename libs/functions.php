<?php

  function loadHeader() {
    include APP_PATH . '/view/template/header.php';
  }
  function loadFooter() {
    include APP_PATH .'/view/template/footer.php';
  }
  function siteURL() {
    return($GLOBALS['config']['base_url']);
  }

  function redirect($newLocation) {
    header("Location: " . siteURL() . $newLocation);
  }


?>
