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

    <title>بوصلة التعليم الجامعي | عرض المشروع </title>
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

                <h2 style='text-align: center;font-size: 32px; font-weight: 550;'>معلومات المشروع</h2>
                <div class="path-bar">
                    <div class="url-path active-path">لوحة التحكم</div>
                    <div class="url-path slash">/</div>
                    <div class="url-path">الاقسام</div>
                    <div class="url-path slash">/</div>
                    <div class="url-path">معلومات المشروع</div>
                </div>
            </div>
            <div class="shcont-prod">

                <div class="image-prod">
                    <?php

                    if (isset($_SESSION["admin_user"])) {
                        if (isset($_POST["Show_id"])) {
                            $Show_id = $_POST["Show_id"];
                            $sql = "SELECT student_projects.*, departments.department_name 
                            FROM student_projects
                            LEFT JOIN departments ON student_projects.department_id = departments.department_id 
                            WHERE project_id = '$Show_id'";

                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                    ?>
                            <img style="width: 150px; pointer-events: none;" src="./assets/pg/admins/<?php echo $row['student_projects_img_path']; ?>">
                </div>
                <div class="prodation">
                    <div class="sh-name">
                        <h2> القسم : <?php echo $row['department_name']; ?></h2>
                        <h2> اسم المشروع : <?php echo $row['project_name']; ?></h2>
                        <h3>صاحب المشروع : <?php echo $row['student_name']; ?></h3>
                        <h3>المشرف على المشروع : <?php echo $row['project_supervisor']; ?></h3>
                    </div>
                </div>

            </div>
            <div class="cont-desc">

                <h3>نُبذة عن المشروع</h3>

            </div>
            <div class="desc">
                <p><?php echo $row['project_description']; ?></p>
            </div>

        </div>
    </div>
<?php    }
                    }
?>
</body>

</html>