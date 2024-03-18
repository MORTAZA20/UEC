<?php
require_once("admins/inc/conn.inc.php");

$id = $_GET['id'];
$sql_student_projects = "SELECT student_projects.*, departments.department_name 
                 FROM student_projects
                 LEFT JOIN departments ON student_projects.department_id = departments.department_id 
                 WHERE project_id='$id'";
$result_student_projects = $conn->query($sql_student_projects);
$row_student_projects = $result_student_projects->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>بوصلة التعليم الجامعي | المشروع</title>
    <link rel="icon" href="LOGO" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="./assets/css/swiper-bundle.min.css">
    <link href="./assets/fontawesome-free-6.5.1-web/css/fontawesome.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/brands.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/styleIndex.css">

</head>

<body>
    <?php include "Navbar_Index.php"; ?>
    <div class="control">
        <section class="Show-SE">
            <div class="Img-logo">
                <img src="./assets/pg/admins/<?php echo $row_student_projects["student_projects_img_path"]; ?>" alt="rtttt">
            </div>
            <div class="info">
                <h1><?php echo $row_student_projects["department_name"]; ?></h1>
                <h2>اسم المشروع : <?php echo $row_student_projects["project_name"]; ?></h2>
                <h3>صاحب المشروع : <?php echo $row_student_projects["student_name"]; ?></h3>
                <h3>مشرف المشروع : <?php echo $row_student_projects["project_supervisor"]; ?></ا>

            </div>
        </section>
        <section class="Sh-des">
            <h2>نُبذة عن المشروع</h2>
            <p><?php echo $row_student_projects["project_description"]; ?></p>
        </section>
    </div>
    <?php include "Footer_Index.php"; ?>
    <script src="jquery-3.6.0.min"></script>
    <script src="./assets/js/Script.js"></script>
    <script src="./assets/js/swiper-bundle.min.js"></script>
</body>

</html>