<?php

if (isset($_POST['search'])) {
    session_start();
    include "../inc/conn.inc.php";
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT * FROM universities WHERE university_name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM universities";
}

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
?>
    <tr>
                <td class="truncated-text"><?php echo $row["university_id"]?></td>
                <td><img style="pointer-events: none;" src="./assets/pg/admins/<?php echo $row["universities_img_path"]?>" 
                ></td>
        
        <div class="truncated-text">
                <td><?php echo $row["university_name"]?></td>
                <td><?php echo $row["university_location"]?></td>
                <td><?php echo $row["university_website"]?></td>
        </div>
                <td data-title="التحكم" class="text-center">
                        <div class="control-buttons">
                                <form id="EditForm" action="edit_universitys" method="post">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['university_id'];?>">
                                        <input type="submit" name="btn_edit" value="تعديل" class="edit-btn">
                                </form>
                                
                                <?php if (isset($_SESSION["admin_user"])) {
                                if ($_SESSION["admin_user"] == "Admin") {
                                ?>
                                <form id="deleteForm" action="delete_universities" method="post" >
                                        <input type="hidden" name="del_id" value="<?php echo $row['university_id'];?>">
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
