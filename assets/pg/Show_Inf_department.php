<?php
require_once("admins/inc/conn.inc.php");

$id = $_GET['id'];
$sql_department = "SELECT d.*, c.college_name, u.university_name
                             FROM departments d
                             LEFT JOIN colleges c ON d.college_id = c.college_id
                             LEFT JOIN universities u ON c.university_id = u.university_id 
                             WHERE d.department_id = '$id'";
$result_department = $conn->query($sql_department);
$row_department = $result_department->fetch_assoc();

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
                <img src="./assets/pg/admins/<?php echo $row_department["departments_img_path"]; ?>" alt="rtttt">
            </div>
            <div class="info">
                <h1><?php echo $row_department["university_name"]; ?></h1>
                <h2><?php echo $row_department["college_name"]; ?></h2>
                <h2><?php echo $row_department["department_name"]; ?></h2>
                <p class="p-dep"> معدل القبول الصباحي : <?php echo $row_department["required_GPA"]; ?><br>
                    معدل القبول المسائي : <?php echo $row_department["evening_GPA"]; ?><br>
                    قسط القبول المسائي : <?php echo $row_department["evening_study_fees"]; ?><br>
                    معدل القبول الــمـوازي : <?php echo $row_department["evening_GPA"]; ?><br>
                    قسط القبول الــمـوازي : <?php echo $row_department["evening_study_fees"]; ?></p>


            </div>
        </section>
        <section class="Sh-des">
            <h2>نُبذة عن القسم</h2>
            <p><?php echo $row_department["department_description"]; ?></p>
        </section>
        <section class="Sh-des">
            <h2>رسالة القسم</h2>
            <p><?php echo $row_department["scientific_department_message"]; ?></p>
        </section>

        <section class="Se-top-students">
            <h2>الطلبة الاوائل</h2>
            <div class="top-students">
                <?php

                $sql_top_students = "SELECT top_students.*, departments.department_name 
                FROM top_students
                LEFT JOIN departments ON top_students.department_id = departments.department_id 
                WHERE top_students.department_id = '$id'
                ORDER BY RAND()
                LIMIT 3";

                $result_top_students = $conn->query($sql_top_students);
                while ($row_top_students = $result_top_students->fetch_assoc()) {
                ?>
                    <div class="card Sh-card">
                        <img width="100%" class="object-fit-contain" src=".\assets\pg\admins\img\profile-avatar.png">
                        <div class="text-card" style="min-height: 0;">
                            <h4 class="title"><?php echo $row_top_students["student_name"]; ?></h4>
                            <p><?php echo $row_top_students["Cumulative_Rating"]; ?></p>
                            <p><?php echo $row_top_students["Graduation_Year"]; ?></p>

                        </div>
                    </div>
                <?php } ?>
            </div>
            <button>عرض المزيد</button>
        </section>
        <section class="Sh-course">
            <?php
            $sql_courses = "SELECT * FROM courses WHERE department_id = '$id'";
            $result_courses = $conn->query($sql_courses);
            ?>
            <h2>المواد الدراسية</h2>
            <div class="Sh-course-Div">
                <?php
                for ($i = 1; $i <= 5; $i++) {
                ?>
                    <div>
                        <h3>
                            <hr>المرحلة ال<?= $i ?>
                        </h3>
                        <ul class='Sh-ul'>
                            <?php
                            mysqli_data_seek($result_courses, 0);
                            while ($row_courses = $result_courses->fetch_assoc()) {
                                if ($row_courses["course_stage"] == $i) {
                            ?>
                                    <li><?= $row_courses["course_name"]; ?></li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                <?php
                }
                ?>
            </div>


        </section>
        <br>
        <section>
            <div class="pagimation_">
                <h3>مشاريع الطلبة</h3>
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