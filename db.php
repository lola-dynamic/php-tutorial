<?php
/* database connection settings */
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'php-tutorialaccount';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error); 
