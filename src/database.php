<?php 

$hostdb = "localhost";
$userdb = "root";
$passdb = "";
$namedb = "my_api";


$conn = new mysqli( $hostdb , $userdb, $passdb, $namedb);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>