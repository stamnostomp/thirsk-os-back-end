<?php

/* 
This is the file that tells all of the internet applications how to connect to the database they need for storing and referencing to data. 
Check with your server administrator for the following settings.
Most servers will use 'localhost' as the server, but check with your server administrator.
*/

//Connection settings for the MDS database
define("HOST", "localhost"); //In most cases this is fine to leave as 'localhost'

// Credentials for MAMP locally
define("USER", "root");
define("PASSWORD", "root");
define("DATABASE", "thirskApp");

// // Credentials for Server deploy
// define("USER", "root");
// define("PASSWORD", "root");
// define("DATABASE", "thirskApp");

//Connection settings for the student information database.
//If you have imported student data into a different database on your server, 
//then enter the name of the database they are stored in. Otherwise, leave this setting as its default value.

define("WEBFILES", "public_html");
?>