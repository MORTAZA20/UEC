<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | الادمنية</title>
    <link rel="stylesheet" href="style">
</head>
<body>

<?php  include 'inc/navbar.php';?>

    <div class="content">
    <?php  include 'inc/sidebar.php';?>
        <div class="content-bar">
            <div style='position:relative; margin-top: 15px; '> <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>الادمنية</div>
            <button class="btn-style" onclick="window.open('add_admin' , '_self');">إضافة أدمن جديد</button>
            <div    class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الادمنية</div>
            </div>

            <table class="table teble-bordered" role="table">
                <thead>
                    <tr>
                        <th width="2%">#</th>
                        <th width="20%">معرف القسم</th>
                        <th class="text-right" width="20%">إسم المستخدم</th>
                        <th class="text-right" width="40%">كلمة المرور</th>
                        <th class="text-right" width="30%">التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'inc/conn.inc.php';

                    $sql = "SELECT * FROM login_credentials";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td><span class="badge">' . $row["id"] . '</span></td>
                                <td>' . $row["department_id"] . '</td>
                                <td>' . $row["AdminUserName"] . '</td>
                                <td>' . $row["AdminPassword"] . '</td>
                                <td data-title="التحكم" class="text-center">
                                
                                    <a href="assets/pg/admins/edit_university.php?Edit_login_credentials_id='. $row["id"] .'" style="padding: 3px 10px;
                                    font-weight: 500;
                                    color: #fff;
                                    border-radius: 5px;
                                    background-color: #95a5a6;
                                    text-decoration: none;">تعديل</a>
                    
                                    <a href="del_login_credentials?del_id='. $row["id"] .'"
                                    style="padding: 3px 10px;
                                    color: #fff;
                                    font-weight: 500;
                                    border-radius: 5px;
                                    background-color: rgb(223, 20, 10);
                                    text-decoration: none;">حذف</a>
                                    
                                </td>
                            </tr>';
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
   
</body>
</html>