<?php
require_once("inc/conn.inc.php");
session_start();

if (!$_SESSION["admin_user"]) {
    header("Location: admin");
    exit();
}

include 'inc/navbar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | الجامعات</title>
    <link rel="stylesheet" href="style">
</head>

<body>
    <div class="content">
        <?php include 'inc/sidebar.php'; ?>
        <div class="content-bar">
            <div style='position:relative; margin-top: 15px; '>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>الجامعات</h2>
            </div>
            <button class="btn-style" onclick="window.open('add_universities' , '_self');">إضافة جامعة جديدة</button>
            <?php include 'Search.php' ?>
             <form action="" method="post">
                        <div class="group">
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                                <g>
                                    <path
                                        d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                                    </path>
                                </g>
                            </svg>

                            <input name="search" placeholder="ادخل اسم الجامعة" type="search" class="input-placeholder">
                            <input name="Input_Serach" type="submit" class="button" value="بـحـث">
                    </div>
                </form>
        
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الجامعات</div>
            </div>

            <table class="table teble-bordered" role="table">
                <thead>
                    <tr>
                        <th width="10%">معرف الجامعة</th>
                        <th width="20%">شعار الجامعة</th>
                        <th class="text-right" width="15%">اسم الجامعة</th>
                        <th class="text-right" width="15%">موقع الجامعة</th>
                        <th class="text-right" width="20%">موقع الجامعة الإلكتروني</th>
                        <th class="text-right" width="30%">التحكم</th>
                    </tr>
                </thead>
                <tbody>
                   
        <?php

        if (isset($_POST['Input_Serach'])) {
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
        </tbody>
        </table>
    </div>
    </div>

    <script>
        function submitForm(delId) {
            document.getElementById('del_id_input').value = delId;
            document.getElementById('deleteForm').submit();
        }
        function submitForm2(editId) {
            document.getElementById('edit_id_input').value = editId;
            document.getElementById('EditForm').submit();
        }
    </script>
</body>

</html>