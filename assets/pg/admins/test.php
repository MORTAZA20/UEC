<?php 


require_once("inc/conn.inc.php");

$universityId = 12;

// SQL query to select universities_img_path for a specific university ID
$sql = "SELECT universities_img_path FROM universities WHERE university_id = $universityId";

// Execute the query
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output data
    $row = $result->fetch_assoc();
    echo "University Image Path: " . $row["universities_img_path"];
} else {
    echo "0 results";
}


echo '<img src="assets/pg/admins/universities_img/1.png" style="width:100px; height:100px;">' ;
