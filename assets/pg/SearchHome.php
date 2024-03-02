<?php
if (isset($_POST['search'])) {
    require_once("admins/inc/conn.inc.php");
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    if (is_numeric($search)) {
        $sql_search = "SELECT colleges.*, universities.university_name FROM colleges
        LEFT JOIN universities ON colleges.university_id = universities.university_id WHERE required_GPA LIKE '%$search%'";
    } else {
        $sql_search = "SELECT * FROM universities WHERE university_name LIKE '%$search%'";
    }
    $result_search = $conn->query($sql_search);
    if ($result_search->num_rows > 0) {
        while ($row_search = $result_search->fetch_assoc()) {
            if (is_numeric($search)) {
?>
                <div onclick="window.open('Show_Inf_college?id=<?php echo $row_search['college_id']; ?>', '_self');">
                    <?php echo $row_search['university_name'] . " - " . $row_search['college_name']; ?>
                    <p><?php echo $row_search['required_GPA']; ?></p>
                </div>

            <?php
            } else {
            ?>
                <div onclick="window.open('Show_Inf_university?id=<?php echo $row_search['university_id']; ?>', '_self');">
                    <?php echo $row_search['university_name']; ?>
                </div>
<?php
            }
        }
    } else {

        echo "لا توجد نتائج.";
    }
    $conn->close();
}
?>