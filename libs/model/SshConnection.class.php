<?php
  abstract class SshConnection {
    protected $serverIP;
    protected $serverPort;
    protected $serverUsername;
    protected $serverPassword;

    protected $sshShell;
    // The active ssh connection lives here

    protected $sshConnectionActive = false;
    // If the connection is active

    protected function __construct(array $sshCredentials) {
      $this->serverIP = $sshCredentials['ip'];
      $this->serverPort = $sshCredentials['port'];
      $this->serverUsername = $sshCredentials['username'];
      $this->serverPassword = $sshCredentials['password'];
    }


    /**
     * Starts a ssh connection
     * @return [string on fail or boolean on succes] [The result form the connection and auth]
     */
    protected function sshConnect() {
      $this->sshShell = ssh2_connect($this->serverIP, $this->serverPort);
      // Start the connection
      if ($this->sshShell != false) {
        // We can connect to the server
        if (ssh2_auth_password($this->sshShell, $this->serverUsername, $this->serverPassword)) {
          // connection is a succes
          $this->sshConnectionActive = true;
          return(true);
        }
        // Start the auth

        else {
          // The auth has failt
          $this->sshConnectionActive = false;
          die('Wrong server username or password');
        }
      }

      else {
        // The connection is failt
        die('No connection with the server');
      }
    }

    protected function executeCommand($command) {
      if ($this->sshConnectionActive === true) {
        $sshShell = ssh2_exec($this->sshShell, $command);
        // Execute the command
        stream_set_blocking($sshShell, true);
      }
      else {
        return(false);
      }
    }
  }


?>
