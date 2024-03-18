<?php
require_once("admins/inc/conn.inc.php");

$id = $_GET['id'];
$sql_courses = "SELECT courses.*, departments.department_name 
    FROM courses
    LEFT JOIN departments ON courses.department_id = departments.department_id 
    WHERE course_id ='$id'";

$result_courses = $conn->query($sql_courses);
$row_courses = $result_courses->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>بوصلة التعليم الجامعي | المواد الدراسية</title>
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
                <img width="100%" class="object-fit-contain" src="assets/pg/admins/img/logo0.png">
            </div>
            <div class="info">
                <h1><?php echo $row_courses["department_name"]; ?></h1>
                <h2><?php echo $row_courses["course_name"]; ?></h2>

                <p>المرحلة
                    <?php
                    if ($row_courses["course_stage"] == 1) {
                        echo "الاولى";
                    } elseif ($row_courses["course_stage"] == 2) {
                        echo "الثانية";
                    } elseif ($row_courses["course_stage"] == 3) {
                        echo "الثالثة";
                    } elseif ($row_courses["course_stage"] == 4) {
                        echo "الرابعة";
                    } elseif ($row_courses["course_stage"] == 5) {
                        echo "الخامسة";
                    }
                    ?>
                </p>
            </div>
        </section>
        <section class="Sh-des">
            <h2>نُبذة عن المادة الدراسية</h2>
            <p><?php echo $row_courses["course_description"]; ?></p>
        </section>
        <br>
    </div>
    <?php include "Footer_Index.php"; ?>
    <script src="jquery-3.6.0.min"></script>
    <script src="./assets/js/Script.js"></script>
    <script src="./assets/js/swiper-bundle.min.js"></script>
</body>

</html>