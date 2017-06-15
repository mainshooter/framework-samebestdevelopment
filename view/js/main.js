var main;
var ajax;

(function() {
  main = {
    // The main object for you javascript
  }
})();

(function() {
  ajax = {
    get_withCallback: function(url) {
      var xhttp = new XMLHttpRequest();
      xhttp.open("GET", url, false);
      xhttp.send();

      return(xhttp.responseText);
    },
    get_withoutCallBack: function(url) {
      var xhttp = new XMLHttpRequest();
      xhttp.open("GET", url, true);
      xhttp.send();
    }
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

      return(xhttp.responseText);
    },
    post_withoutCallback: function() {
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
