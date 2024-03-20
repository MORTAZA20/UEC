<?php


if (isset($_POST['search'])) {
    session_start();
    include '../inc/conn.inc.php';
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    if ($_SESSION["admin_user"] == "department") {
        $department_id = $_SESSION["department_id"];
        $sql = "SELECT courses.*, departments.department_name FROM courses
                LEFT JOIN departments ON courses.department_id = departments.department_id WHERE (course_name LIKE '%$search%' OR departments.department_name LIKE '$search') AND courses.department_id = '$department_id'";
    } else if ($_SESSION["admin_user"] == "college") {
        $college_id = $_SESSION["college_id"];
        $sql = "SELECT courses.*, departments.department_name FROM courses
                LEFT JOIN departments ON courses.department_id = departments.department_id WHERE (course_name LIKE '%$search%' OR departments.department_name LIKE '$search') AND departments.college_id = '$college_id'";
    } else {
        $sql = "SELECT courses.*, departments.department_name FROM courses
                LEFT JOIN departments ON courses.department_id = departments.department_id WHERE course_name LIKE '%$search%' OR departments.department_name LIKE '$search'";
    }
} else {
    if ($_SESSION["admin_user"] == "department") {
        $department_id = $_SESSION["department_id"];
        $sql = "SELECT courses.*, departments.department_name 
            FROM courses
            LEFT JOIN departments ON courses.department_id = departments.department_id WHERE courses.department_id = '$department_id'";
    } else if ($_SESSION["admin_user"] == "college") {
        $college_id = $_SESSION["college_id"];
        $sql = "SELECT courses.*, departments.department_name 
            FROM courses
            LEFT JOIN departments ON courses.department_id = departments.department_id WHERE departments.college_id = '$college_id'";
    } else {
        $sql = "SELECT courses.*, departments.department_name 
            FROM courses
            LEFT JOIN departments ON courses.department_id = departments.department_id";
    }
}

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
?>
    <tr style="height: 100px;">

        <td><?php echo $row["course_id"] ?></td>
        <td><?php echo $row["course_name"] ?></td>
        <td><?php if($row['course_stage']==1){echo "الاولى";}elseif($row['course_stage']==2){echo "الثانية";}elseif($row['course_stage']==3){echo "الثالثة";}elseif($row['course_stage']==4){echo "الرابعة";}elseif($row['course_stage']==5){echo "الخامسة";}elseif($row['course_stage']==6){echo "السادسة";} ?></td>
        <td><?php echo $row["department_name"] ?></td>

        <td data-title="التحكم" class="text-center">
            <div class="control-buttons">
                <form id="ShowForm" action="ShowCourses" method="post">
                    <input type="hidden" name="Show_id" value="<?php echo $row['course_id']; ?>">
                    <input type="submit" name="btn_Show" value="عرض كل البيانات" class="Show-btn">
                </form>
                <?php if (isset($_SESSION["admin_user"])) {
                    if ($_SESSION["admin_user"] != "college") {
                ?>

                        <form id="EditForm" action="edit_courses" method="post">
                            <input type="hidden" name="edit_id" value="<?php echo $row['course_id']; ?>">
                            <input type="submit" name="btn_edit" value="تعديل" class="edit-btn">
                        </form>
                        <form id="deleteForm" action="delete_courses" method="post">
                            <input type="hidden" name="del_id" value="<?php echo $row['course_id']; ?>">
                            <input type="submit" name="btn_delete" value="حذف" class="delete-btn">
                        </form>
            </div>
    <?php
                    }
                }
    ?>
        </td>
    </tr>
<?php
}
$conn->close();
?>