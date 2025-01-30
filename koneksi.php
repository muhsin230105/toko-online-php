<?php
$con = mysqli_connect("localhost", "root", "", "toko_online", "3306");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
