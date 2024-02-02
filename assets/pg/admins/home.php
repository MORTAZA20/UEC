<?php

require_once("inc/conn.inc.php");

session_start();
if (isset($_SESSION["admin_user"])) {
if ($_SESSION["admin_user"] != "Admin" && $_SESSION["admin_user"] != "SubAdmin") {
    header("Location: login");
    exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بوصلة التعليم الجامعي | لوحة التحكم</title>
    <link rel="stylesheet" href="style">
</head>
<body>

<?php    include 'inc/navbar.php'; ?>

    <div class="content">
    <?php    include 'inc/sidebar.php'; ?>


        <div class="content-bar">
            <div style='position:relative; margin-top: 15px; '>
              <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>الصفحة الرئيسية</h2>
            </div>

            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الصفحة الرئيسية</div>
            </div>

            <div class="panel-bar">
                <div>عدد الجامعات <div>
                <?php
                    include 'inc/conn.inc.php';

                    $sql ="SELECT * FROM universities";
                    $result = $conn->query ($sql);
                    echo $result->num_rows;
                    $conn->close();
                    ?>
                    </div>
                </div>
                <div>عدد الكليات<div>
                <?php
                    include 'inc/conn.inc.php';

                    $sql ="SELECT * FROM colleges";
                    $result = $conn->query ($sql);
                    echo $result->num_rows;
                    $conn->close();
                    ?>
                </div></div>
                <div>عدد الاقسام<div>      
                    <?php
                    include 'inc/conn.inc.php';

                    $sql ="SELECT * FROM departments";
                    $result = $conn->query ($sql);
                    echo $result->num_rows;
                    $conn->close();
                    ?></div></div>
                <div >عدد الادمنية<div>    
                    <?php
                    include 'inc/conn.inc.php';

                    $sql ="SELECT * FROM inf_login";
                    $result = $conn->query ($sql);
                    echo $result->num_rows;
                    $conn->close();
                    ?></div></div>
            </div>
            
            <div class="Latest-orders">احدث الاضافات</div>

            <table class="table teble-bordered" role="table">
            <thead>
                    <tr>
                        <th width="10%">معرف القسم</th>
                        <th class="text-right" width="10%">الكلية</th>
                        <th class="text-right" width="10%">القسم</th>
                        <th class="text-right" width="10%">شعار القسم</th>
                        <th class="text-right" width="30%">التحكم</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</body>
</html>