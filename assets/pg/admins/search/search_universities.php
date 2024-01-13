<?php
if (isset($_POST['search'])) {
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
                <td><span class="badge"><?php echo $row["university_id"]?></span></td>
                <td><img src="assets/pg/admins/<?php echo $row["universities_img_path"]?>" 
                style=" max-width: 80px;
                max-height: 80px;
                width: auto;
                height: auto;
                              
                padding-left:20px;"></td>
                <td><?php echo $row["university_name"]?></td>
                <td><?php echo $row["university_location"]?></td>
                <td><?php echo $row["university_website"]?></td>
                <td data-title="التحكم" class="text-center">
                        <div class="control-buttons">
                                <form id="EditForm" action="edit_universitys" method="post">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['university_id'];?>">
                                        <input type="submit" name="btn_edit" value="تعديل" class="edit-btn">
                                </form>
                                <form id="deleteForm" action="delete_universities" method="post" >
                                        <input type="hidden" name="del_id" value="<?php echo $row['university_id'];?>">
                                        <input type="submit" name="btn_delete" value="حذف" class="delete-btn">
                                </form>
                        </div>
                </td>
            </tr>
<?php
}
$conn->close();

?>
