<?php
              
    if (isset($_POST['search'])) {
        include '../inc/conn.inc.php';
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT top_students.*, departments.department_name FROM top_students
                LEFT JOIN departments ON top_students.department_id = departments.department_id WHERE student_name LIKE '%$search%' OR  departments.department_name LIKE '$search'";
    }else{
        $sql = "SELECT top_students.*, departments.department_name FROM top_students
                LEFT JOIN departments ON top_students.department_id = departments.department_id";  
    }           
       $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
?>
       <tr>
                    <td><span class="badge"><?php echo $row["student_id"] ?></span></td>
                    <td><?php echo $row["department_name"] ?></td>
                    <td><?php echo $row["student_name"] ?></td>
                    <td><?php echo $row["Cumulative_Rating"] ?></td>
                    <td><?php echo $row["Graduation_Year"] ?></td>
                                
                    <td data-title="التحكم" class="text-center">      
                <div class="control-buttons">
                    <form id="EditForm" action="edit_top_students" method="post">
                            <input type="hidden" name="edit_id" value="<?php echo $row['student_id'];?>">
                            <input type="submit" name="btn_edit" value="تعديل" class="edit-btn">
                    </form>
                    <form id="deleteForm" action="delete_top_students" method="post" >
                            <input type="hidden" name="del_id" value="<?php echo $row['student_id'];?>">
                            <input type="submit" name="btn_delete" value="حذف" class="delete-btn">
                    </form>
                </div>
                    </td>
            </tr>
<?php 
}
$conn->close();
?>