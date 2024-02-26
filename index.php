<?php
require_once("assets/pg/admins/inc/conn.inc.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>بوصلة التعليم الجامعي | الرئيسية</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/0b13675ea3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styleIndex.css">
</head>

<body>
    <div class="header">

        <i class="fa-solid fa-xmark"></i>
        <p>07839985872</p>
    </div>
    <nav class="navbar">

        <img src="LOGO" alt="شعار بوصلة التعليم الجامعي">
        <ul class="nav-menu">

            <li class="nav-item">الرئيسية</li>

            <li class="nav-item active">الجامعات
                <ul class="menu-dep-universities">
                    <?php
                    $sql = "SELECT * FROM universities";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <li><?php echo $row["university_name"]; ?></li>
                    <?php } ?>
                </ul>
            </li>

            <li class="nav-item active">الكليات
                <ul class="menu-dep-colleges">
                    <?php
                    $sql2 = "SELECT  c.*, u.university_name
                    FROM colleges c
                    LEFT JOIN universities u ON c.university_id = u.university_id ";

                    $result2 = $conn->query($sql2);
                    while ($row2 = $result2->fetch_assoc()) {
                    ?>
                        <li><?php echo $row2["university_name"] . " - " .  $row2["college_name"] ?></li>
                    <?php } ?>
                </ul>
            </li>

            <li class="nav-item active">الاقسام العلمية
                <ul class="menu-dep-departments">
                    <?php
                    $sql3 = "SELECT d.*, c.college_name, u.university_name
                    FROM departments d
                    LEFT JOIN colleges c ON d.college_id = c.college_id
                    LEFT JOIN universities u ON c.university_id = u.university_id";

                    $result3 = $conn->query($sql3);
                    while ($row3 = $result3->fetch_assoc()) {
                    ?>
                        <li><?php echo $row3["university_name"] . " - " .  $row3["college_name"] . " - " .  $row3["department_name"] ?></li>
                    <?php } ?>
                </ul>
            </li>
        </ul>
        </li>

        <form action="" class="search-from">
            <input type="search" placeholder="عن ماذا تبحث؟" id="search-box">
            <label for="search-box" class="fas fa-search"></label>
        </form>


        <div class="nav-item">
            <i class="fa-solid fa-circle-info"></i>
        </div>
    </nav>
    <div class="control">

        <section class="">

        </section>
        <section>
            <div class="pagimation_">
                <h3>الجامعات المتقرحة</h3>
                <div class="btn-grup">
                    <div class="swiper-btn-prev-universities"><i class="fas fa-chevron-right"></i></div>
                    <div class="swiper-btn-next-universities"><i class="fas fa-chevron-left"></i></div>
                </div>
            </div>
            <div class="swiper-universities swiper-best-sellers">
                <div class="swiper-wrapper">
                    <?php

                    $sql = "SELECT * FROM universities ORDER BY RAND() LIMIT 20";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="card swiper-slide">
                            <img width="100%" class="object-fit-contain" src="assets/pg/admins/<?php echo $row['universities_img_path']; ?>">
                            <div class="text-card">
                                <h4 class="title"><?php echo $row["university_name"]; ?></h4>
                                <p><?php echo $row["university_location"]; ?></p>
                                <button>عرض الجامعة</button>
                            </div>
                        </div>
                    <?php
                    } ?>
                </div>
            </div>
        </section>
        <section>
            <div class="pagimation_">
                <h3>الكليات المقترحة</h3>
                <div class="btn-grup">
                    <div class="swiper-btn-prev-colleges"><i class="fas fa-chevron-right"></i></div>
                    <div class="swiper-btn-next-colleges"><i class="fas fa-chevron-left"></i></div>
                </div>
            </div>
            <div class="swiper-colleges swiper-best-sellers">
                <div class="swiper-wrapper">
                    <?php

                    $sql4 = "SELECT  c.*, u.university_name
                    FROM colleges c
                    LEFT JOIN universities u ON c.university_id = u.university_id ORDER BY RAND() LIMIT 20";
                    $result4 = $conn->query($sql4);
                    while ($row4 = $result4->fetch_assoc()) {
                    ?>
                        <div class="card swiper-slide">
                            <img width="100%" class="object-fit-contain" src="assets/pg/admins/<?php echo $row4['colleges_img_path']; ?>">
                            <div class="text-card">
                                <p><?php echo $row4["university_name"]; ?></p>
                                <h4 class="title"><?php echo $row4["college_name"]; ?></h4>
                                <button>عرض الكلية</button>
                            </div>

                        </div>
                    <?php
                    } ?>
                </div>
            </div>
        </section>
        <section>
            <div class="pagimation_">
                <h3>الاقسام المقترحة</h3>
                <div class="btn-grup">
                    <div class="swiper-btn-prev-departments"><i class="fas fa-chevron-right"></i></div>
                    <div class="swiper-btn-next-departments"><i class="fas fa-chevron-left"></i></div>
                </div>
            </div>
            <div class="swiper-departments swiper-best-sellers">
                <div class="swiper-wrapper">
                    <?php

                    $sql5 = "SELECT d.*, c.college_name, u.university_name
                    FROM departments d
                    LEFT JOIN colleges c ON d.college_id = c.college_id
                    LEFT JOIN universities u ON c.university_id = u.university_id ";
                    $result5 = $conn->query($sql5);
                    while ($row5 = $result5->fetch_assoc()) {
                    ?>
                        <div class="card swiper-slide">
                            <img width="100%" class="object-fit-contain" src="assets/pg/admins/<?php echo $row5['departments_img_path']; ?>">
                            <div class="text-card">
                                <p><?php echo $row5["university_name"] . " - " .  $row5["college_name"] ?></p>
                                <h4 class="title"><?php echo $row5["department_name"]; ?></h4>

                                <button>عرض القسم</button>
                            </div>

                        </div>
                    <?php
                    } ?>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        new Swiper('.swiper-universities', {
            speed: 400,
            spaceBetween: 10,
            slidesPerView: '5',
            navigation: {
                nextEl: '.swiper-btn-next-universities',
                prevEl: '.swiper-btn-prev-universities',
            },
        });
        new Swiper('.swiper-colleges', {
            speed: 400,
            spaceBetween: 10,
            slidesPerView: '5',
            navigation: {
                nextEl: '.swiper-btn-next-colleges',
                prevEl: '.swiper-btn-prev-colleges',
            },
        });
        new Swiper('.swiper-departments', {
            speed: 400,
            spaceBetween: 10,
            slidesPerView: '5',
            navigation: {
                nextEl: '.swiper-btn-next-departments',
                prevEl: '.swiper-btn-prev-departments',
            },
        });
    </script>
</body>

</html>