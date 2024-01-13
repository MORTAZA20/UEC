<?php
if (isset($_POST['search'])) {
    include '../inc/conn.inc.php';
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT * FROM login_credentials WHERE AdminUserName LIKE '%$search%' OR id LIKE '$search' ";
    $result = $conn->query($sql);
} else {
    $sql = "SELECT * FROM login_credentials";
    $result = $conn->query($sql);
}
while ($row = $result->fetch_assoc()) {
?>
    <tr>
        <td><span class="badge"><?php echo $row["id"] ?></span></td>
        <td><?php echo $row["department_id"] ?></td>
        <td><?php echo $row["AdminUserName"] ?></td>
        <td><?php echo $row["AdminPassword"] ?></td>
        <td data-title="التحكم" class="text-center">

            <div class="control-buttons">
                <form id="EditForm" action="edit_My_Admins" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="btn_edit" value="تعديل" class="edit-btn">
                </form>
                <form id="deleteForm" action="delete_My_Admins" method="post">
                    <input type="hidden" name="del_id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="btn_delete" value="حذف" class="delete-btn">
                </form>
            </div>

        </td>
    </tr>
    <?php
}
$conn->close();
?>