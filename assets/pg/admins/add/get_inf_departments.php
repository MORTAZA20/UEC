<?php

include '../inc/conn.inc.php';

$college_id = $_POST['college_id'];

$sql = "SELECT * FROM departments WHERE college_id = '$college_id'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {

  echo "<option value='{$row['department_id']}'>";
  echo $row['department_name'];
  echo "</option>";

}

?>