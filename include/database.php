<?php
    $servername = "localhost";
    $database = "cost_accounting_db";
    $username = "root";
    $password = "password";

    $connection = mysqli_connect($servername, $username, $password, $database);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }