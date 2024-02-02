<?php

include '../inc/conn.inc.php';

$university_id = $_POST['university_id'];

$sql = "SELECT * FROM colleges WHERE university_id = '$university_id'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {

  echo "<option value='{$row['college_id']}'>";
  echo $row['college_name'];
  echo "</option>";

}

?>