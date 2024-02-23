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
            <li class="nav-item active">الاقسام
                <ul class="menu-dep">
                    <li>الجامعات</li>
                    <li>الكليات</li>
                    <li>الاقسام العلمية</li>
                </ul>
            </li>
        </ul>
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search">
        </div>
        <div class="nav-item">
            ماذا عنا
        </div>
    </nav>
    <div class="control">

        <section class="">

        </section>
        <section>
            <div class="pagimation_">
                <h3>كل الجامعات</h3>
                <div class="btn-grup">
                    <div class="swiper-btn-prev"><i class="fas fa-chevron-right"></i></div>
                    <div class="swiper-btn-next"><i class="fas fa-chevron-left"></i></div>
                </div>
            </div>
            <div class="swiper swiper-best-sellers">
                <div class="swiper-wrapper">
                    <?php
                    require_once("assets/pg/admins/inc/conn.inc.php");
                    $sql = "SELECT * FROM universities";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="card swiper-slide">
                            <img width="100%" class="object-fit-contain" src="assets/pg/admins/<?php echo $row['universities_img_path']; ?>" loading="lazy">
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
                <h3>كل الكليات</h3>
                <div class="btn-grup">
                    <div class="swiper-btn-prev"><i class="fas fa-chevron-right"></i></div>
                    <div class="swiper-btn-next"><i class="fas fa-chevron-left"></i></div>
                </div>
            </div>
            <div class="swiper swiper-best-sellers">
                <div class="swiper-wrapper">
                    <?php
                    require_once("assets/pg/admins/inc/conn.inc.php");
                    $sql = "SELECT * FROM universities";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="card swiper-slide">
                            <img width="100%" class="object-fit-contain" src="assets/pg/admins/<?php echo $row['universities_img_path']; ?>" loading="lazy">
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
                <h3>كل الاقسام</h3>
                <div class="btn-grup">
                    <div class="swiper-btn-prev"><i class="fas fa-chevron-right"></i></div>
                    <div class="swiper-btn-next"><i class="fas fa-chevron-left"></i></div>
                </div>
            </div>
            <div class="swiper swiper-best-sellers">
                <div class="swiper-wrapper">
                    <?php
                    require_once("assets/pg/admins/inc/conn.inc.php");
                    $sql = "SELECT * FROM universities";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="card swiper-slide">
                            <img width="100%" class="object-fit-contain" src="assets/pg/admins/<?php echo $row['universities_img_path']; ?>" loading="lazy">
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        new Swiper('.swiper', {
            speed: 400,
            spaceBetween: 10,
            slidesPerView: '5',
            navigation: {
                nextEl: '.swiper-btn-next',
                prevEl: '.swiper-btn-prev',
            },
        });
    </script>
</body>

</html>