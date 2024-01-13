<?php


if (isset($_POST['search'])) {
    include '../inc/conn.inc.php';
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    $sql = "SELECT courses.*, departments.department_name FROM courses
                LEFT JOIN departments ON courses.department_id = departments.department_id WHERE course_name LIKE '%$search%' OR departments.department_name LIKE '$search'";

} else {
    $sql = "SELECT courses.*, departments.department_name 
            FROM courses
            LEFT JOIN departments ON courses.department_id = departments.department_id";


}

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    ?>
    <tr>
                <td><span class="badge"><?php echo $row["course_id"] ?></span></td>
                <td><?php echo $row["department_name"] ?></td>
                <td><?php echo $row["course_name"] ?></td>
                <td><?php echo $row["course_stage"] ?></td>
                <td><?php echo $row["course_description"] ?></td>

                <td data-title="التحكم" class="text-center"> 
                <div class="control-buttons">
                    <form id="EditForm" action="edit_courses" method="post">
                            <input type="hidden" name="edit_id" value="<?php echo $row['course_id'];?>">
                            <input type="submit" name="btn_edit" value="تعديل" class="edit-btn">
                    </form>
                    <form id="deleteForm" action="delete_courses" method="post" >
                            <input type="hidden" name="del_id" value="<?php echo $row['course_id'];?>">
                            <input type="submit" name="btn_delete" value="حذف" class="delete-btn">
                    </form>
                </div>
                </td>
            </tr>
            <?php 
}
$conn->close();
?>