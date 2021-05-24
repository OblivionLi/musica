<?php

// import credentials
require_once('db_credentials.php');

// create connect to database function
function db_connect()
{
    // try to connect to DB using the imported credentials by PDO connection
    try {
        $conn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connection error: ' . $e->getMessage();
    }

    // return connection
    return $conn;
}
