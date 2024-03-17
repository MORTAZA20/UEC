<?php

if (isset($_POST['search'])) {
        session_start();
        include '../inc/conn.inc.php';
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        if ($_SESSION["admin_user"] == "department") {
                $department_id = $_SESSION["department_id"];
                $sql = "SELECT top_students.*, departments.department_name FROM top_students
                LEFT JOIN departments ON top_students.department_id = departments.department_id WHERE (student_name LIKE '%$search%' OR  departments.department_name LIKE '$search') AND top_students.department_id = '$department_id'";
        } else if ($_SESSION["admin_user"] == "college") {
                $college_id = $_SESSION["college_id"];
                $sql = "SELECT top_students.*, departments.department_name FROM top_students
                LEFT JOIN departments ON top_students.department_id = departments.department_id WHERE (student_name LIKE '%$search%' OR  departments.department_name LIKE '$search') AND departments.college_id = '$college_id'";
        } else {
                $sql = "SELECT top_students.*, departments.department_name FROM top_students
                LEFT JOIN departments ON top_students.department_id = departments.department_id WHERE student_name LIKE '%$search%' OR  departments.department_name LIKE '$search'";
        }
} else {
        if ($_SESSION["admin_user"] == "department") {
                $department_id = $_SESSION["department_id"];
                $sql = "SELECT top_students.*, departments.department_name FROM top_students
                LEFT JOIN departments ON top_students.department_id = departments.department_id WHERE top_students.department_id = '$department_id'";
        } else if ($_SESSION["admin_user"] == "college") {
                $college_id = $_SESSION["college_id"];
                $sql = "SELECT top_students.*, departments.department_name FROM top_students
                LEFT JOIN departments ON top_students.department_id = departments.department_id WHERE departments.college_id = '$college_id'";
        } else {
                $sql = "SELECT top_students.*, departments.department_name FROM top_students
        LEFT JOIN departments ON top_students.department_id = departments.department_id";
        }
}
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
?>
        <tr>
                <td><?php echo $row["student_id"] ?></td>
                <td><?php echo $row["department_name"] ?></td>
                <td>
                        <?php
                        if (!empty($row["top_students_img_path"])) {
                        ?>
                                <img style="pointer-events: none;" src="./assets/pg/admins/<?php echo $row["top_students_img_path"]; ?>">
                        <?php
                        } else {
                        ?>
                                <img style="pointer-events: none;" src="./assets/pg/admins/img/profile-avatar.png">
                        <?php
                        }
                        ?>
                </td>
                <td><?php echo $row["student_name"] ?></td>
                <td><?php echo $row["Cumulative_Rating"] ?></td>
                <td><?php echo $row["Graduation_Year"] ?></td>
                <td data-title="التحكم" class="text-center">
                        <?php if (isset($_SESSION["admin_user"])) {
                                if ($_SESSION["admin_user"] != "college") {
                        ?>
                                        <div class="control-buttons">
                                                <form id="EditForm" action="edit_top_students" method="post">
                                                        <input type="hidden" name="edit_id" value="<?php echo $row['student_id']; ?>">
                                                        <input type="submit" name="btn_edit" value="تعديل" class="edit-btn">
                                                </form>
                                                <form id="deleteForm" action="delete_top_students" method="post">
                                                        <input type="hidden" name="del_id" value="<?php echo $row['student_id']; ?>">
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