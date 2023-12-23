<?php

    if (isset($_POST['search'])) {
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
echo '<tr>
            <td><span class="badge">' . $row["department_id"] . '</span></td>
            <td>' . $row["college_name"] . '</td>
            <td>' . $row["department_name"] . '</td>
            <td>' . $row["required_GPA"] . '</td>
            <td>' . $row["evening_GPA"] . '</td>
            <td>' . $row["parallel_GPA"] . '</td>
            <td data-title="التحكم" class="text-center">
                                
                <a href="edit_departments?Edit_departments_id=' . $row["department_id"] . '" 
                    style="padding: 3px 10px;
                    font-weight: 500;
                    color: #fff;
                    border-radius: 5px;
                    background-color: #95a5a6;
                    text-decoration: none;">تعديل</a>
                    
                <a href="#" onclick="submitForm(\'' . $row["department_id"] . '\');" 
                    style="padding: 3px 10px;
                    color: #fff;
                    font-weight: 500;
                    border-radius: 5px;
                    background-color: rgb(223, 20, 10);
                    text-decoration: none;">حذف</a>
                <form id="deleteForm" action="delete_inf_departments" method="post" style="display: none;">
                    <input type="hidden" name="del_id" id="del_id_input">
                </form>
            </td>
        </tr>';
        }
$conn->close();
?>