<?php
//Information to connect to the DB
$dsn = "mysql:host=localhost; dbname=application";
$dbusername = "root";
$dbpwd = "";

//Creating a connector
$pdo = new PDO($dsn, $dbusername, $dbpwd);

//Debbugging the SQL DB
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
