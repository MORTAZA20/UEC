<?php

if (isset($_POST['search'])) {
    include '../inc/conn.inc.php';
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT inf_login.*, departments.department_name 
    FROM inf_login 
    LEFT JOIN departments ON inf_login.department_id = departments.department_id 
    WHERE AdminUserName LIKE '%$search%' OR Admin_id = '$search'";
    $result = $conn->query($sql);
} else {
    $sql = "SELECT inf_login.*, departments.department_name 
    FROM inf_login 
    LEFT JOIN departments ON inf_login.department_id = departments.department_id";
    $result = $conn->query($sql);
}
while ($row = $result->fetch_assoc()) {
?>
    <tr>
    <div class="truncated-text">
        <td><?php echo $row["Admin_id"] ?></td>
        <td><?php echo $row["department_name"] ?></td>
        <td><?php echo $row["AdminUserName"] ?></td>
        <td><?php echo $row["RegistrationData"] ?></td>
        <td><?php echo $row["RegistrationTime"] ?></td>
        <td><?php echo $row["type"] ?></td>
    </div>
        <td data-title="التحكم" class="text-center">

            <div class="control-buttons">
                <form id="EditForm" action="edit_My_Admins" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['Admin_id']; ?>">
                    <input type="submit" name="btn_edit" value="تعديل" class="edit-btn">
                </form>

               
                <form id="deleteForm" action="edit_My_Admins" method="post">
                    <input type="hidden" name="del_id" value="<?php echo $row['Admin_id']; ?>">
                    <input type="submit" name="btn_delete" value="حذف" class="delete-btn">
                
            </div>

        </td>
    </tr>
    <?php
}
$conn->close();
?>