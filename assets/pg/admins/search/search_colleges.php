<?php

if (isset($_POST['search'])) {
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
    echo '<tr>
            <td><span class="badge">' . $row["college_id"] . '</span></td>
            <td>' . $row["university_name"] . '</td>
            <td>' . $row["college_name"] . '</td>
            <td><img src="assets/pg/admins/' . $row["colleges_img_path"] . '" 
                        style=" max-width:80px;
                        max-height: 80px;
                        width: auto;
                        height: auto;"></td>
            <td>' . $row["required_GPA"] . '</td>
            <td>' . $row["college_description"] . '</td>
            <td data-title="التحكم" class="text-center">
                                
                <a href="#" onclick="submitForm2(\'' . $row["college_id"] . '\');"
                        style="padding: 3px 10px;
                        font-weight: 500;
                        color: #fff;
                        border-radius: 5px;
                        background-color: #95a5a6;
                        text-decoration: none;">تعديل</a>
                <form id="EditForm" action="edit_colleges" method="post" style="display: none;">
                    <input type="hidden" name="edit_id" id="edit_id_input">
                </form>  
                <a href="#" onclick="submitForm(\'' . $row["college_id"] . '\');" 
                        style="padding: 3px 10px;
                        color: #fff;
                        font-weight: 500;
                        border-radius: 5px;
                        background-color: rgb(223, 20, 10);
                        text-decoration: none;">حذف</a>
                <form id="deleteForm" action="delete_colleges" method="post" style="display: none;">
                        <input type="hidden" name="del_id" id="del_id_input">
                </form>
            </td>
        </tr>';
}
$conn->close();
?>