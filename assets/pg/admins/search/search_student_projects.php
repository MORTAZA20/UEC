<?php

    if (isset($_POST['search'])) {  
        include '../inc/conn.inc.php';
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT student_projects.*, departments.department_name 
        FROM student_projects
        LEFT JOIN departments ON student_projects.department_id = departments.department_id WHERE project_name LIKE '%$search%' OR departments.department_name LIKE '$search' ";
    } else {
        $sql = "SELECT student_projects.*, departments.department_name 
            FROM student_projects
            LEFT JOIN departments ON student_projects.department_id = departments.department_id";
    }

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
                <td><span class="badge"><?php echo $row["project_id"] ?></span></td>
                <td><?php echo $row["department_name"] ?></td>
                <td><?php echo $row["project_name"] ?></td>
                <td><?php echo $row["student_name"] ?></td>
                <td><?php echo $row["project_supervisor"] ?></td>
                <td><?php echo $row["project_description"] ?></td>
                <td data-title="التحكم" class="text-center">
                
                <div class="control-buttons">
                    <form id="EditForm" action="edit_student_projects" method="post">
                            <input type="hidden" name="edit_id" value="<?php echo $row['project_id'];?>">
                            <input type="submit" name="btn_edit" value="تعديل" class="edit-btn">
                    </form>
                    <?php if ($_SESSION["admin_user"] == "Admin") {?>
                    <form id="deleteForm" action="delete_student_projects" method="post" >
                            <input type="hidden" name="del_id" value="<?php echo $row['project_id'];?>">
                            <input type="submit" name="btn_delete" value="حذف" class="delete-btn">
                    </form><?php }?>

                </div>
                </td>
            </tr>';
   
   <?php
        }
    $conn->close();
    ?>