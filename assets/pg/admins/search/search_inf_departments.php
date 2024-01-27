<?php

if (isset($_POST['search'])) {
    session_start();
    include '../inc/conn.inc.php';
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT departments.*, colleges.college_name FROM departments
                LEFT JOIN colleges ON departments.college_id = colleges.college_id WHERE department_name LIKE '%$search%' OR colleges.college_name LIKE '$search'";
} else {
    $sql = "SELECT departments.*, colleges.college_name FROM departments
                LEFT JOIN colleges ON departments.college_id = colleges.college_id";
}

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    ?>
        <tr>
        <div class="truncated-text">
                <td><?php echo $row["department_id"] ?></td>               
                <td><?php echo $row["college_name"] ?></td>
                <td><?php echo $row["department_name"] ?></td>
        </div>
            <td><img src="assets/pg/admins/<?php echo $row["departments_img_path"]; ?>">
            </td>
            
            

            <td data-title="التحكم" class="text-center">
                <div class="control-buttons">
                    <form id="ShowForm" action="Show_inf_departments" method="post">
                        <input type="hidden" name="Show_id" value="<?php echo $row['department_id']; ?>">
                        <input type="submit" name="btn_Show" value="عرض كل البيانات" class="Show-btn">
                    </form>
                    <form id="EditForm" action="edit_inf_departments" method="post">
                        <input type="hidden" name="edit_id" value="<?php echo $row['department_id']; ?>">
                        <input type="submit" name="btn_edit" value="تعديل" class="edit-btn">
                    </form>
                    <?php if (isset($_SESSION["admin_user"])) {
                                if ($_SESSION["admin_user"] == "Admin") {
                     ?>
                    <form id="deleteForm" action="delete_inf_departments" method="post">
                        <input type="hidden" name="del_id" value="<?php echo $row['department_id']; ?>">
                        <input type="submit" name="btn_delete" value="حذف" class="delete-btn">
                    </form>
                    <?php 
                    }
                    }
                    ?>
                </div>
            </td>
        </tr>

    <?php
}
$conn->close();
?>
