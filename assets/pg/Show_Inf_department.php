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
    <title>بوصلة التعليم الجامعي | عرض القسم</title>
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
                    معدل القبول المسائي : <?php if($row_department["evening_GPA"]==50){echo "لا يوجد";}else{echo $row_department["evening_GPA"];}  ?><br>
                    قسط القبول المسائي : <?php if($row_department["evening_study_fees"]==0){echo "لا يوجد";}else{ echo number_format($row_department["evening_study_fees"]) . " دينار عراقي";} ?>  <br>
                    معدل القبول الــمـوازي : <?php if($row_department["parallel_GPA"]==50){echo "لا يوجد";}else{echo $row_department["parallel_GPA"]; }?><br>
                    قسط القبول الــمـوازي : <?php if($row_department["parallel_study_fees"]==0){echo "لا يوجد";}else{echo number_format($row_department["parallel_study_fees"]). " دينار عراقي"; } ?></p>


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
                        <?php
                        if (!empty($row_top_students["top_students_img_path"])) {
                        ?>
                            <img width="100%" class="object-fit-contain" src=".\assets\pg\admins\<?php echo $row_top_students["top_students_img_path"]; ?>">
                        <?php
                        } else {
                        ?>
                            <img width="100%" class="object-fit-contain" src=".\assets\pg\admins\img\profile-avatar.png">
                        <?php
                        }
                        ?>
                        <div class="text-card" style="min-height: 0;">
                            <h4 class="title"><?php echo $row_top_students["student_name"]; ?></h4>
                            <p><?php echo $row_top_students["Cumulative_Rating"]; ?></p>
                            <p><?php echo $row_top_students["Graduation_Year"]; ?></p>

                        </div>
                    </div>
                <?php } ?>
            </div>
            <form action="Show_top_student">
                <button name="id" value="<?php echo $id  ?>">عرض المزيد</button>
            </form>
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
                            <hr>المرحلة<?php if($i ==1){echo " الاولى";}elseif($i ==2){echo " الثانية";}elseif($i ==3){echo " الثالثة";}elseif($i ==4){echo " الرابعة";}elseif($i ==5){echo " الخامسة";}  ?>
                        </h3>
                        <ul class='Sh-ul'>
                            <?php
                            mysqli_data_seek($result_courses, 0);
                            while ($row_courses = $result_courses->fetch_assoc()) {
                                if ($row_courses["course_stage"] == $i) {
                            ?>
                                    <li onclick="window.open('Show_course?id=<?= $row_courses['course_id']; ?>', '_self');"><?= $row_courses['course_name']; ?></li>
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
        <section class="Sh-student-projects">
            <div class="pagimation_">
                <h3>مشاريع الطلبة</h3>
                <div class="btn-grup">
                    <div class="swiper-btn-prev-student-projects"><i class="fas fa-chevron-right"></i></div>
                    <div class="swiper-btn-next-student-projects"><i class="fas fa-chevron-left"></i></div>
                </div>
            </div>

            <div class="swiper-student-projects swiper-best-sellers">
                <div class="swiper-wrapper">
                    <?php
                    $sql_student_projects = "SELECT student_projects.*, departments.department_name 
                 FROM student_projects
                 LEFT JOIN departments ON student_projects.department_id = departments.department_id WHERE student_projects.department_id='$id'";
                    $result_student_projects = $conn->query($sql_student_projects);
                    while ($row_student_projects = $result_student_projects->fetch_assoc()) {
                    ?>
                        <div class="card swiper-slide">
                            <img width="100%" class="object-fit-contain" src="assets/pg/admins/<?php echo $row_student_projects['student_projects_img_path']; ?>">
                            <div class="text-card">
                                <p><?php echo $row_student_projects["student_name"]; ?></p>
                                <h4 class="title"><?php echo $row_student_projects["project_name"]; ?></h4>
                                <form action="Show_student_projects">
                                    <button name="id" value="<?php echo $row_student_projects['project_id']; ?>">عرض المشروع</button>
                                </form>
                            </div>
                        </div>
                    <?php
                    } ?>
                </div>
            </div>
        </section>
        <section class="Sh-des">
            <h2>فرص العمل المستقبلية</h2>
            <?php
            $sql_career_opportunities = "SELECT * FROM career_opportunities WHERE department_id ='$id'";
            $result_career_opportunities = $conn->query($sql_career_opportunities);
            while ($row_career_opportunities = $result_career_opportunities->fetch_assoc()) {
            ?>
                <h3>العنوان الوظيفي: <?php echo $row_career_opportunities["job_title"]; ?></h3>
                <h4> مقدار الراتب: <?php echo $row_career_opportunities["salary_range"]; ?> دينار عراقي</h4>
                <p><?php echo $row_career_opportunities["job_description"]; ?></p>
            <?php } ?>

        </section>
    </div>

    <script>
        window.onload = function() {
            new Swiper('.swiper-student-projects', {
                speed: 400,
                spaceBetween: 10,
                slidesPerView: 'auto',
                navigation: {
                    nextEl: '.swiper-btn-next-student-projects',
                    prevEl: '.swiper-btn-prev-student-projects',
                },
            });
        }
    </script>
    <?php include "Footer_Index.php"; ?>
    <script src="jquery-3.6.0.min"></script>
    <script src="./assets/js/Script.js"></script>
    <script src="./assets/js/swiper-bundle.min.js"></script>
</body>

</html>