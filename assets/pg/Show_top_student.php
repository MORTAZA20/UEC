<?php
require_once("admins/inc/conn.inc.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>بوصلة التعليم الجامعي | الطلبة الاوائل</title>
    <link rel="icon" href="LOGO" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="./assets/css/swiper-bundle.min.css">
    <link href="./assets/fontawesome-free-6.5.1-web/css/fontawesome.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/brands.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/styleIndex.css">
</head>

<body>

    <?php include "Navbar_Index.php"; ?>
 <header>
        <h1>
            الطلبة الاوائل
        </h1>
        <p>
            مجموعة من الطلبة المتفوقين
        </p>

    </header>
    <div class="control">

        <section class="top-students">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql_top_students = "SELECT top_students.*, departments.department_name FROM top_students
                                            LEFT JOIN departments ON top_students.department_id = departments.department_id WHERE top_students.department_id = '$id'";
            } else {
                $sql_top_students = "SELECT top_students.*, departments.department_name FROM top_students
                                        LEFT JOIN departments ON top_students.department_id = departments.department_id";
            }

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
                    <div class="text-card" style="min-height: 0;text-align: center; ">
                        <h4 class="title"><?php echo $row_top_students["student_name"]; ?></h4>
                        <p><?php echo $row_top_students["Cumulative_Rating"]; ?></p>
                        <p><?php echo $row_top_students["Graduation_Year"]; ?></p>

                    </div>
                </div>
            <?php } ?>

        </section>
    </div>

    <?php include "Footer_Index.php"; ?>
    <script src="jquery-3.6.0.min"></script>

    <script src="assets/js/Script.js"></script>

    <script>
        window.onload = function() {
            function initSwipers(slidesPerView) {
                new Swiper('.swiper-universities', {
                    loop: false,
                    speed: 400,
                    spaceBetween: 10,
                    slidesPerView: slidesPerView,
                    navigation: {
                        nextEl: '.swiper-btn-next-universities',
                        prevEl: '.swiper-btn-prev-universities',
                    },
                });
                new Swiper('.swiper-colleges', {
                    loop: false,
                    speed: 400,
                    spaceBetween: 10,
                    slidesPerView: slidesPerView,
                    navigation: {
                        nextEl: '.swiper-btn-next-colleges',
                        prevEl: '.swiper-btn-prev-colleges',
                    },
                });
                new Swiper('.swiper-departments', {
                    loop: false,
                    speed: 400,
                    spaceBetween: 10,
                    slidesPerView: slidesPerView,
                    navigation: {
                        nextEl: '.swiper-btn-next-departments',
                        prevEl: '.swiper-btn-prev-departments',
                    },
                });
            }

            function handleResize() {
                var screenWidth = window.innerWidth;
                var slidesPerView = (screenWidth <= 1024) ? '3' : '5';

                if (typeof swiperUniversities !== 'undefined') {
                    swiperUniversities.destroy();
                    swiperColleges.destroy();
                    swiperDepartments.destroy();
                }

                initSwipers(slidesPerView);
            }

            var slidesPerView = (window.innerWidth <= 1024) ? '3' : '5';
            initSwipers(slidesPerView);

            window.onresize = function() {
                handleResize();
            };
        };
    </script>
    <script src="./assets/js/swiper-bundle.min.js"></script>
</body>

</html>