<?php

require_once '../vendor/autoload.php';

session_start();

// init configuration
$clientID = '628942522796-q4v5hd233vb8tsnk4th7iffafvc7ent8.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/projet/test/welcome.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// Connect to database
$hostname = "localhost";
$username = "root";
$password = "";
$database = "youtube-google-login";

//$conn = mysqli_connect($hostname, $username, $password, $database);
