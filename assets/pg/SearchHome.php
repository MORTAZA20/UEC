<?php
if (isset($_POST['search'])) {
    require_once("admins/inc/conn.inc.php");
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    if (is_numeric($search) || strpos($search, "قسم") !== false) {

        $sql_search = "SELECT d.*, c.college_name, u.university_name
        FROM departments d
        LEFT JOIN colleges c ON d.college_id = c.college_id
        LEFT JOIN universities u ON c.university_id = u.university_id
        WHERE d.required_GPA LIKE '%$search%' 
        OR d.evening_GPA LIKE '%$search%' 
        OR d.parallel_GPA LIKE '%$search%'";
    } elseif (strpos($search, "كلية") !== false || strpos($search, "الكلية") !== false|| strpos($search, "معهد") !== false || strpos($search, "المعهد") !== false) {
        $sql_search = "SELECT colleges.*, universities.university_name FROM colleges
        LEFT JOIN universities 
        ON colleges.university_id = universities.university_id
        WHERE colleges.college_name LIKE '%$search%'";
    } else {
        $sql_search = "SELECT * FROM universities WHERE university_name LIKE '%$search%'";
    }
    $result_search = $conn->query($sql_search);
    if ($result_search->num_rows > 0) {
        while ($row_search = $result_search->fetch_assoc()) {
            if (is_numeric($search)) {
?>
                <div onclick="window.open('Show_Inf_department?id=<?php echo $row_search['department_id']; ?>', '_self');">
                    <?php echo $row_search['university_name'] . " - " . $row_search['college_name'] . " - " . $row_search['department_name']; ?>
                    <p>صباحي: <?php echo $row_search['required_GPA']; ?>
                        مسائي: <?php echo $row_search['evening_GPA']; ?>
                        موازي: <?php echo $row_search['parallel_GPA']; ?></p>
                </div>

            <?php
            } elseif (strpos($search, "كلية") !== false || strpos($search, "معهد") !== false || strpos($search, "المعهد") !== false)  {
            ?>
                <div onclick="window.open('Show_Inf_college?id=<?php echo $row_search['college_id']; ?>', '_self');">
                    <?php echo $row_search['university_name'] . " - " . $row_search['college_name']; ?>
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