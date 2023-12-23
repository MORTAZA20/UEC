<?php
  
    if (isset($_POST['search'])) {  
        include '../inc/conn.inc.php';
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT career_opportunities.*, departments.department_name 
        FROM career_opportunities
        LEFT JOIN departments ON career_opportunities.department_id = departments.department_id WHERE job_title LIKE '%$search%' OR departments.department_name LIKE '$search'";

    } else {
        $sql = "SELECT career_opportunities.*, departments.department_name 
            FROM career_opportunities
            LEFT JOIN departments ON career_opportunities.department_id = departments.department_id";

    }
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td><span class="badge">' . $row["opportunity_id"] . '</span></td>
                <td>' . $row["department_name"] . '</td>
                <td>' . $row["job_title"] . '</td>
                <td>' . $row["salary_range"] . '</td>
                <td>' . $row["job_description"] . '</td>
                <td data-title="التحكم" class="text-center">
                
                    <a href="edit_courses.php?Edit_courses_id=' . $row["opportunity_id"] . '" style="padding: 3px 10px;
                    font-weight: 500;
                    color: #fff;
                    border-radius: 5px;
                    background-color: #95a5a6;
                    text-decoration: none;">تـعـديـل</a>
    
                    <a href="#" onclick="submitForm(\'' . $row["opportunity_id"] . '\');" 
                                style="padding: 3px 10px;
                                color: #fff;
                                font-weight: 500;
                                border-radius: 5px;
                                background-color: rgb(223, 20, 10);
                                text-decoration: none;">حذف</a>
                    <form id="deleteForm" action="delete_career_opportunities" method="post" style="display: none;">
                        <input type="hidden" name="del_id" id="del_id_input">
                    </form>
                </td>
            </tr>';
    }
    $conn->close();
    ?>