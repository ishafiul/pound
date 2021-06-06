<?php
  require_once 'config/config.php';
  // Load Helpers
  //require_once 'helperslper.php';
  require_once 'helpers/session_helper.php';
  require_once 'helpers/function.php';
  require_once 'helpers/url_helper.php';
// Load Config/url_he

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  });
  
