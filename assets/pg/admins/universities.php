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
                    $sql = "SELECT * FROM universities";
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
                                    <a href="edit_universitys?Edit_Universitie_id=' . $row["university_id"] . '" 
                                       style="padding: 3px 10px;
                                              font-weight: 500;
                                              color: #fff;
                                              border-radius: 5px;
                                              background-color: #95a5a6;
                                              text-decoration: none;">تعديل</a>
                                              
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
    </script>
</body>

</html>