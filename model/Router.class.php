<?php
  require_once 'controller/display.Controller.php';
  class Router {

    var $siteLocation;
    var $defaultController;
    var $defaultMethod;

    private $url;
    private $path;

    private $locationOfThePath;
    // It is used to track wat we allready have seperated

    private $controller;
    private $method;
    private $parameters;


    function __construct() {

      $this->url = parse_url($_SERVER['REQUEST_URI']);
      $this->path = $this->url['path'];
    }


    public function procesTheURL() {
      if ($this->path == $this->siteLocation) {
          $this->path = $this->defaultController . '/' . $this->defaultMethod . '/';
          // The default path what we are gone do
      }
      else {
        $this->path = $this->replaceString($this->siteLocation, '', $this->url['path']);
        // The slash is te prefent that the router thinks that there are parameters when there arent
      }

      if (!$this->checkIfLastValueIsASlash($this->path)) {
        $this->path .= '/';
      }


      $this->controller = $this->getController($this->path) . 'Controller';
      $this->method = $this->getMethod($this->path);
      $this->parameters = $this->getParamters($this->path);

      if ($this->method == '') {
        // If we don't get a method, we use the default method in the controller
        $this->method = $this->defaultMethod;
      }

      $this->sendToDestination();
    }

    /**
     * Well we make everything for the call user func array and send it away to the controller
     * @param  [string] $controller [The name of the controller]
     * @param  [string] $method     [The name of the method]
     * @param  [array] $parameters [the parameters we got from the url]
     */
    private function sendToDestination() {
      $controller = new $this->controller;
      $method = $this->method;
      $parameters = $this->parameters;

      call_user_func_array(array($controller, $method), [$parameters]);
      // Controller is the name of the controller
      // The method is the method of the controller
      // parameters is send as a array in a array to be send as a array
    }

    /*
      Debugs the incoming request
     */
    public function debug() {
      echo '<div style="font-size: 1.6em;padding: 1em;">';
        echo "<h2 style='padding: 0; margin: 4px;'>Router debug</h2>";
        echo "Path: " . $this->path;
        echo "<br>";
        echo "Controller: " . $this->controller;
        echo "<br>";
        echo "Methode: " . $this->method;
        echo "<br>";
        echo "Parameters: ";
        echo "<pre>";
        var_dump($this->parameters);
        echo "</pre>";
      echo "</div>";
    }

    private function checkIfLastValueIsASlash($string) {
      $array = $this->stringToArray($string);
      $arrayLenght = count($array) - 1;

      if ($array[$arrayLenght] != '/') {
        return(false);
      }
      else {
        return(true);
      }
    }

    /**
     * Gets all parameters
     * @return [array] [With all parameters]
     */
    private function getParamters() {
      $location = $this->replaceString($this->locationOfThePath, '', $this->path);
      // To get remove from the location what we already have done

      $howManyParameters = $this->countSlashes($location);

      for ($i=0; $i < $howManyParameters; $i++) {
        $this->parameters[] = $this->getNextValue($this->locationOfThePath);
        // This gets all new parameters

        $this->locationOfThePath .= $this->parameters[$i] . '/';
        // To save what we already have done
      }

      return($this->parameters);
    }

    /**
     * Get the next value between 2 slashes
     * @param  [string] $string [The path what we already did]
     * @return [type]         [description]
     */
    private function getNextValue($string) {
      $string = $this->replaceString($string, '', $this->path);
      // To get remove from the location what we already have done

      $array = $this->stringToArray($string);
      $resultArray;

      $pastSlash = 0;
      foreach ($array as $key) {
        if ($pastSlash == 0) {
          if ($key != '/') {
            $resultArray[] = $key;
          }
          else if ($key == '/') {
            $pastSlash = 1;
          }
        }
      }
      return($this->arrayToString($resultArray));
    }

    /**
     * Gets the method
     * @return [string] [method name]
     */
    private function getMethod() {
      $this->method = $this->getNextValue($this->locationOfThePath);

      $this->locationOfThePath .= $this->method . '/';
      // To save what we already have done

      return($this->method);
    }

    /**
     * Counts how many / there are for hoe many parameters there are
     * @param  [string] $string [The path string]
     * @return [INT]         [How many slashes we have]
     */
    private function countSlashes($string) {
      $array = $this->stringToArray($string);

      $count = 0;
      foreach ($array as $key) {
        if ($key == '/') {
          $count++;
        }
      }

      return($count);
    }

    /**
     * Gets the name of the controller
     * @param  [string] $string [The path that we now have]
     * @return [string] [With the name of the controller]
     */
    private function getController($string) {
      $this->controller = $this->getNextValue($this->locationOfThePath);

      $this->locationOfThePath .= $this->controller . '/';
      // To save what we already have done

      return($this->controller);
    }

    /**
     * Converts a string to a array
     * @param  [string] $string [The string we want to go to a array]
     * @return [array] [the result]
     */
    private function stringToArray($string) {
      $array = str_split($string);
      return($array);
    }

    /**
     * Array to string
     * @param  [1 dept array] $array [The array we want to convert to a string]
     * @return [string] [The array converted to a string]
     */
    private function arrayToString($array) {
      $string = implode('', $array);
      return($string);
    }

    /**
     * [replaceString description]
     * @param  [string] $searchString [What we want te replace]
     * @param  [string] $replace      [What we will replace it with]
     * @param  [string] $stringSub    [The string that we will use]
     * @return [string]               [The replaced string]
     */
    private function replaceString($searchString, $replace, $stringSub) {
      $string = str_replace($searchString, $replace, $stringSub);
      return($string);
    }





  }
?>
