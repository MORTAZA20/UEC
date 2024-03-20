<?php

if (isset($_POST['search'])) {
    session_start();
    include '../inc/conn.inc.php';
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    if ($_SESSION["admin_user"] == "department") {
        $department_id = $_SESSION["department_id"];
        $sql = "SELECT student_projects.*, departments.department_name 
        FROM student_projects
        LEFT JOIN departments ON student_projects.department_id = departments.department_id WHERE (project_name LIKE '%$search%' OR departments.department_name LIKE '$search') AND student_projects.department_id = '$department_id'";
    } else if ($_SESSION["admin_user"] == "college") {
        $college_id = $_SESSION["college_id"];
        $sql = "SELECT student_projects.*, departments.department_name 
        FROM student_projects
        LEFT JOIN departments ON student_projects.department_id = departments.department_id WHERE (project_name LIKE '%$search%' OR departments.department_name LIKE '$search') AND departments.college_id = '$college_id'";
    } else {
        $sql = "SELECT student_projects.*, departments.department_name 
        FROM student_projects
        LEFT JOIN departments ON student_projects.department_id = departments.department_id WHERE project_name LIKE '%$search%' OR departments.department_name LIKE '$search' ";
    }
} else {
    if ($_SESSION["admin_user"] == "department") {
        $department_id = $_SESSION["department_id"];
        $sql = "SELECT student_projects.*, departments.department_name 
            FROM student_projects
            LEFT JOIN departments ON student_projects.department_id = departments.department_id WHERE student_projects.department_id = '$department_id'";
    } else if ($_SESSION["admin_user"] == "college") {
        $college_id = $_SESSION["college_id"];
        $sql = "SELECT student_projects.*, departments.department_name 
            FROM student_projects
            LEFT JOIN departments ON student_projects.department_id = departments.department_id WHERE departments.college_id = '$college_id'";
    } else {
        $sql = "SELECT student_projects.*, departments.department_name 
        FROM student_projects
        LEFT JOIN departments ON student_projects.department_id = departments.department_id";
    }
}

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
?>
    <tr>

        <td><?php echo $row["department_name"] ?></td>
        <td><?php echo $row["project_name"] ?></td>
        <td><?php echo $row["student_name"] ?></td>
        <td><?php echo $row["project_supervisor"] ?></td>
        <td><img style="pointer-events: none;" src="./assets/pg/admins/<?php echo $row["student_projects_img_path"]; ?>">

        <td data-title="التحكم" class="text-center">
            <div class="control-buttons">
                <form id="ShowForm" action="ShowStudentProject" method="post">
                    <input type="hidden" name="Show_id" value="<?php echo $row['project_id']; ?>">
                    <input type="submit" name="btn_Show" value="عرض كل البيانات" class="Show-btn">
                </form>
                <?php if (isset($_SESSION["admin_user"])) {
                    if ($_SESSION["admin_user"] != "college") {
                ?>

                        <form id="EditForm" action="edit_student_projects" method="post">
                            <input type="hidden" name="edit_id" value="<?php echo $row['project_id']; ?>">
                            <input type="submit" name="btn_edit" value="تعديل" class="edit-btn">
                        </form>

                        <form id="deleteForm" action="delete_student_projects" method="post">
                            <input type="hidden" name="del_id" value="<?php echo $row['project_id']; ?>">
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