<?php
require_once("admins/inc/conn.inc.php");

$id = $_GET['id'];
$sql_colleges = "SELECT colleges.*, universities.university_name FROM colleges
                 LEFT JOIN universities ON colleges.university_id = universities.university_id WHERE colleges.college_id = '$id'";
$result_colleges = $conn->query($sql_colleges);
$row_colleges = $result_colleges->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بوصلة التعليم الجامعي | عرض الجامعات</title>
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
                <img src="./assets/pg/admins/<?php echo $row_colleges["colleges_img_path"]; ?>" alt="rtttt">
            </div>
            <div class="info">
                <h1><?php echo $row_colleges["university_name"]; ?></h1>
                <h2><?php echo $row_colleges["college_name"]; ?></h2>
                <p><?php echo $row_colleges["required_GPA"]; ?></p>

            </div>
        </section>
        <section class="Sh-des">
            <h2>نُبذة عن الكلية</h2>
            <p><?php echo $row_colleges["college_description"]; ?></p>
        </section>
        <br>
        <section>
            <div class="pagimation_">
                <h3>الاقسام</h3>
            </div>

            <div class="cards"> <?php

                                $sql5 = "SELECT d.*, c.college_name, u.university_name
                             FROM departments d
                             LEFT JOIN colleges c ON d.college_id = c.college_id
                             LEFT JOIN universities u ON c.university_id = u.university_id 
                             WHERE c.college_id = '$id'";

                                $result5 = $conn->query($sql5);
                                while ($row5 = $result5->fetch_assoc()) {
                                ?>
                    <div class="card Sh-card">
                        <img width="100%" class="object-fit-contain" src="assets/pg/admins/<?php echo $row5['departments_img_path']; ?>">
                        <div class="text-card">
                            <p><?php echo $row5["university_name"] . " - " .  $row5["college_name"] ?></p>
                            <h4 class="title"><?php echo $row5["department_name"]; ?></h4>
                            <form action="Show_Inf_department">
                                <button name="id" value="<?php echo $row5['department_id']; ?>">عرض القسم</button>
                            </form>
                        </div>
                    </div>
                <?php
                                } ?>
            </div>
        </section>
    </div>
    <?php include "Footer_Index.php"; ?>
    <script src="jquery-3.6.0.min"></script>
    <script src="./assets/js/Script.js"></script>
    <script src="./assets/js/swiper-bundle.min.js"></script>
</body>

</html>