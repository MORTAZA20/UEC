<?php


if (isset($_POST['search'])) {
    include '../inc/conn.inc.php';
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    $sql = "SELECT courses.*, departments.department_name FROM courses
                LEFT JOIN departments ON courses.department_id = departments.department_id WHERE course_name LIKE '%$search%' OR departments.department_name LIKE '$search'";

} else {
    $sql = "SELECT courses.*, departments.department_name 
            FROM courses
            LEFT JOIN departments ON courses.department_id = departments.department_id";


}

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    echo '<tr>
                <td><span class="badge">' . $row["course_id"] . '</span></td>
                <td>' . $row["department_name"] . '</td>
                <td>' . $row["course_name"] . '</td>
                <td>' . $row["course_stage"] . '</td>
                <td>' . $row["course_description"] . '</td>
                <td data-title="التحكم" class="text-center">
                
                    <a href="edit_courses.php?Edit_courses_id=' . $row["course_id"] . '" style="padding: 3px 10px;
                    font-weight: 500;
                    color: #fff;
                    border-radius: 5px;
                    background-color: #95a5a6;
                    text-decoration: none;">تعديل</a>
    
                    <a href="#" onclick="submitForm(\'' . $row["course_id"] . '\');" 
                                style="padding: 3px 10px;
                                color: #fff;
                                font-weight: 500;
                                border-radius: 5px;
                                background-color: rgb(223, 20, 10);
                                text-decoration: none;">حذف</a>
                    <form id="deleteForm" action="delete_courses" method="post" style="display: none;">
                        <input type="hidden" name="del_id" id="del_id_input">
                    </form>
                </td>
            </tr>';
}
$conn->close();
?>