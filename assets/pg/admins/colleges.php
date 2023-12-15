<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | الكليات </title>
    <link rel="stylesheet" href="style">
</head>
<body>

<?php    include 'inc/navbar.php';?>
    <div class="content">

     <?php    include 'inc/sidebar.php'; ?>
        <div class="content-bar">
            <div style='position:relative; margin-top: 15px; '> <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>الكليات</div>
            <button class="btn-style" onclick="window.open('add_colleges' , '_self');">أضافة كلية جديدة</button>
            <div    class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الكليات</div>
            </div>

            <table class="table teble-bordered" role="table">
                <thead>
                    <tr>
                        <th width="10%">معرف الكلية</th>
                        <th class="text-right" width="10%">الجامعة</th>
                        <th class="text-right" width="15%">اسم الكلية</th>
                        <th class="text-right" width="15%">شعار الكلية</th>
                        <th class="text-right" width="10%">معدل القبول</th>
                        <th class="text-right" width="10%">النبذة</th>
                        <th class="text-right" width="30%">التحكم</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include 'inc/conn.inc.php';

                    $sql = "SELECT colleges.*, universities.university_name 
                            FROM colleges
                            LEFT JOIN universities ON colleges.university_id = universities.university_id";

                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td><span class="badge">' . $row["college_id"] . '</span></td>
                                <td>' . $row["university_name"] . '</td>
                                <td>' . $row["college_name"] . '</td>
                                <td><img src="' . $row["colleges_img_path"] . '" style="width:100px; height:100px;"></td>
                                <td>' . $row["required_GPA"] . '</td>
                                <td>' . $row["college_description"] . '</td>
                                <td data-title="التحكم" class="text-center">
                                
                                    <a href="assets/pg/admins/edit_colleges.php?Edit_colleges_id='. $row["college_id"] .'" style="padding: 3px 10px;
                                    font-weight: 500;
                                    color: #fff;
                                    border-radius: 5px;
                                    background-color: #95a5a6;
                                    text-decoration: none;">تعديل</a>
                    
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
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function submitForm(delId) {
        document.getElementById('del_id_input').value = delId;
        document.getElementById('deleteForm').submit();
    }
    </script>
</body>
</html>
