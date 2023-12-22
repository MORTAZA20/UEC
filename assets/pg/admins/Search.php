<?php
require_once("inc/conn.inc.php");

if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT * FROM universities WHERE university_name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM universities";
}

$result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                                <td><span class="badge">' . $row["university_id"] . '</span></td>
                                <td><img src="assets/pg/admins/' . $row["universities_img_path"] . '" 
                                style=" max-width: 80px;
                                max-height: 80px;
                                width: auto;
                                height: auto;
                              
                                padding-left:20px;"></td>
                                <td>' . $row["university_name"] . '</td>
                                <td>' . $row["university_location"] . '</td>
                                <td>' . $row["university_website"] . '</td>
                                <td data-title="التحكم" class="text-center">
                                    <a href="#" onclick="submitForm2(\'' . $row["university_id"] . '\');" 
                                       style="padding: 3px 10px;
                                              font-weight: 500;
                                              color: #fff;
                                              border-radius: 5px;
                                              background-color: #95a5a6;
                                              text-decoration: none;">تعديل</a>
                                    <form id="EditForm" action="edit_universitys" method="post" style="display: none;">
                                            <input type="hidden" name="edit_id" id="edit_id_input">
                                    </form>  
                                              <a href="#" onclick="submitForm(\'' . $row["university_id"] . '\');" 
                                              style="padding: 3px 10px;
                                              color: #fff;
                                              font-weight: 500;
                                              border-radius: 5px;
                                              background-color: rgb(223, 20, 10);
                                              text-decoration: none;">حذف</a>
                                    <form id="deleteForm" action="delete_universities" method="post" style="display: none;">
                                        <input type="hidden" name="del_id" id="del_id_input">
                                    </form>
                                </td>
                            </tr>';
    }

    $conn->close();
    ?>
