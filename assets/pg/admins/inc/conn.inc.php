<?php
$server = "localhost";
$user_serv = "root";
$pass_serv = "";
$dbname = "universityeducationcompass_db";
$conn = new mysqli($server, $user_serv, $pass_serv, $dbname);
if($conn->connect_error){die("Connection Error: " . $conn->connect_error);}