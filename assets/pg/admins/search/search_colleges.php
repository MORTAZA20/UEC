
<?php

if (isset($_POST['search'])) {
        session_start();
        include '../inc/conn.inc.php';
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT colleges.*, universities.university_name FROM colleges
            LEFT JOIN universities ON colleges.university_id = universities.university_id WHERE college_name LIKE '%$search%' OR universities.university_name LIKE '$search'";
} else {
        $sql = "SELECT colleges.*, universities.university_name FROM colleges
            LEFT JOIN universities ON colleges.university_id = universities.university_id";
}

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
        ?>

        <tr>
        <div class="truncated-text">
                <td><?php echo $row["college_id"]; ?></td>
                <td><?php echo $row["university_name"]; ?></td>
                <td><?php echo $row["college_name"]; ?></td>
        </div>
                <td><img src="./assets/pg/admins/<?php echo $row["colleges_img_path"]; ?>">
                </td>
                <td class="truncated-text"><?php echo $row["required_GPA"]; ?></td>
                <td class="truncated-text"><?php echo $row["college_description"]; ?></td>

        
                <td data-title="التحكم" class="text-center">
                        <div class="control-buttons">
                                <form id="EditForm" action="edit_colleges" method="post">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['college_id'];?>">
                                        <input type="submit" name="btn_edit" value="تعديل" class="edit-btn">
                                </form>
                                <?php if (isset($_SESSION["admin_user"])) {
                                if ($_SESSION["admin_user"] == "Admin") {
                                ?>
                                <form id="deleteForm" action="delete_colleges" method="post" >
                                        <input type="hidden" name="del_id" value="<?php echo $row['college_id'];?>">
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
