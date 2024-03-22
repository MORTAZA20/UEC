<?php
session_start();
require_once("inc/conn.inc.php");

if (isset($_SESSION["admin_user"])) {
    if (
        $_SESSION["admin_user"] != "Admin"
        && $_SESSION["admin_user"] != "SubAdmin"
        && $_SESSION["admin_user"] != "department"
        && $_SESSION["admin_user"] != "college"
    ) {
        header("Location: login");
        exit();
    }
} else {
    header("Location: login");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>بوصلة التعليم الجامعي | عرض معلومات المادة </title>
    <link href="./assets/fontawesome-free-6.5.1-web/css/fontawesome.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/brands.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="style">
</head>

<body>

    <?php include 'inc/navbar.php'; ?>

    <div class="content">
        <?php include 'inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px; '>

                <h2 style='text-align: center;font-size: 32px; font-weight: 550;'>معلومات المادة الدراسية</h2>
                <div class="path-bar">
                    <div class="url-path active-path">لوحة التحكم</div>
                    <div class="url-path slash">/</div>
                    <div class="url-path">الاقسام</div>
                    <div class="url-path slash">/</div>
                    <div class="url-path">معلومات المادة الدراسية</div>
                </div>
            </div>
            <div class="shcont-prod">

                <div class="image-prod">
                    <?php

                    if (isset($_SESSION["admin_user"])) {
                        if (isset($_POST["Show_id"])) {
                            $Show_id = $_POST["Show_id"];
                            $sql = "SELECT courses.*, departments.department_name 
                            FROM courses
                            LEFT JOIN departments ON courses.department_id = departments.department_id
                            WHERE course_id = '$Show_id'";

                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                    ?>
                            <img style="width: 150px; pointer-events: none;" src=".\imgs\5.jpeg">
                </div>
                <div class="prodation">
                    <div class="sh-name">
                        <h2> القسم : <?php echo $row['department_name']; ?></h2>
                        <h2> اسم المادة : <?php echo $row['course_name']; ?></h2>
                        <h3> المرحلة : <?php if($row['course_stage']==1){echo "الاولى";}elseif($row['course_stage']==2){echo "الثانية";}elseif($row['course_stage']==3){echo "الثالثة";}elseif($row['course_stage']==4){echo "الرابعة";}elseif($row['course_stage']==5){echo "الخامسة";}elseif($row['course_stage']==6){echo "السادسة";} ?></h3>
                    </div>
                </div>

            </div>
            <div class="cont-desc">

                <h3>نُبذة عن المادة</h3>

            </div>
            <div class="desc">
                <p><?php echo $row['course_description']; ?></p>
            </div>

        </div>
    </div>
<?php    }
                    }
?>
</body>

</html>