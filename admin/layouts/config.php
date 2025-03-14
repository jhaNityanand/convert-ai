
<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    error_reporting(E_ALL);
    session_start();

    $base_url = "http://localhost/convert/";
    define('base_url', $base_url);

    $servername = "localhost";
    $username = "root";
    $passwordss = "";
    $database = "convert";

    $conn = new mysqli($servername, $username, $passwordss, $database);
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

?>
