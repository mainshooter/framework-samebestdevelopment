var Ajax;
var Loader;

var Timer;
var timerInterval;
var timerTime;
// Contains the current time from the timer in s

(function() {
  Timer = {
    /**
     * Increase the current time on the timer by 1 sec
     * @return {[type]} [description]
     */
    counter: function() {
      timerTime++;
    },

    /**
     * Starts the timer
     * @return {[type]} [description]
     */
    start: function() {
      timerInterval = setInterval(function(){Timer.counter();}, 1000);
    },

    /**
     * Ends the timer
     * @return {[type]} [description]
     */
    end: function() {
      clearInterval(timerInterval)
    },

    /**
     * Returns the current time from the timer
     * @return {[INT]} [The current time that is displaying on the timer]
     */
    getCurrentTime: function() {
      return(timerTime);
    }
  }
})()

(function() {
  Loader = {
    /**
     * Starts the loader
     */
    start: function() {
      document.getElementById('loader').className = 'loaderEnable';
    },
    /**
     * Stops the loader
     */
    stop: function() {
      document.getElementById('loader').className = '';
    }
  }
})();

(function() {
  Ajax = {
    /**
     * Sends a get request with a callback
     * @param  {[string]} url [Where we want to send the ajax request to]
     * @return {[obj]}     [The result from ajax request as a object]
     */
    get_withCallback: function(url) {
      var xhttp = new XMLHttpRequest();
      xhttp.open("GET", url, false);
      xhttp.send();

      return(xhttp);
    },
    /**
     * Sends a get request without a callback
     * @param  {[string]} url [The URL where we send the request to]
     * @return {[object]} xhhtp [The returned object]
     */
    get_withoutCallBack: function(url) {
      var xhttp = new XMLHttpRequest();
      xhttp.open("GET", url, false);
      xhttp.send();
    },
    /**
     * Sends a post ajax request with a callback
     * @param  {[string]} url            [The url where we want to send the post request to]
     * @param  {[string]} postParameters [With the post values we will fill in]
     * @return {[type]}                [description]
     */
    post_withCallback: function(url ,postParameters) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          console.log("Done with ajax post with callBack");
        }
      };
      // contains te post values
      xhttp.open("POST", url, true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send(postParameters);

      return(xhttp);
    },
    /**
     * [description]
     * @param  {[string]} url [The url where we want to send the request to]
     * @param  {[string]} postParameters [With the postParameters in it]
     */
    post_withoutCallback: function(url, postParameters) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          console.log("Done with ajax post without callBack");
        }
      };
      // contains te post values
      xhttp.open("POST", url, false);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send(postParameters);
    }
  }
})();
