<?php
include "../inc/conn.inc.php";
$sql = "SELECT * FROM universities WHERE university_name LIKE '%$search%'";
$result = mysqli_query($conn,$sql) or die("SQl error");
$output="";
if(mysqli_num_rows($result)>0){
    echo $sql ;
    $conn->close();
}
?>