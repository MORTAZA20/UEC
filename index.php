<?php
require_once("assets/pg/admins/inc/conn.inc.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>بوصلة التعليم الجامعي | الرئيسية</title>
    <link rel="stylesheet" href="./assets/css/swiper-bundle.min.css">
    <link href="./assets/fontawesome-free-6.5.1-web/css/fontawesome.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/brands.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet" />
    <link rel="icon" href="LOGO" type="image/png" sizes="16x16">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="assets/css/styleIndex.css">
</head>

<body>
    <div class="header">
        <i class="fa-solid fa-xmark"></i>
        <p>07839985872</p>
    </div>
    <?php include "assets/pg/Navbar_Index.php"; ?>

    <div id="Modal">
        <div class="add-to">
            <span class="close-download">&times;</span>
            <p style="text-align: center; font-size: 24px; font-weight: bold; color: #23a0a9;">
                هل تريد تنزيل الموقع على شكل تطبيق؟
            </p>
            <p style="text-align: center; font-size: 18px; color: #333; margin-top: 10px;">
                <button class="add-to-btn">نعم تنزيل</button>
            </p>
        </div>
    </div>
    <script>
        var Modal = document.getElementById("Modal");
        var Close = Modal.getElementsByClassName("close-download")[0];
        Close.onclick = function() {
            Modal.style.display = "none";
        }
    </script>

    <script type="text/javascript">
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js').then(function(registration) {
                    // Registration was successful
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    // registration failed :(
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }

        let deferredPrompt;
        var div = document.querySelector('.add-to');
        var Modal = document.getElementById("Modal");
        var button = document.querySelector('.add-to-btn');
        div.style.display = 'none';

        window.addEventListener('beforeinstallprompt', (e) => {
            // Prevent Chrome 67 and earlier from automatically showing the prompt
            e.preventDefault();
            // Stash the event so it can be triggered later.
            deferredPrompt = e;
            div.style.display = 'block';
            button.addEventListener('click', (e) => {
                // hide our user interface that shows our A2HS button
                div.style.display = 'none';
                Modal.style.display = 'none';

                // Show the prompt
                deferredPrompt.prompt();
                // Wait for the user to respond to the prompt
                deferredPrompt.userChoice
                    .then((choiceResult) => {
                        if (choiceResult.outcome === 'accepted') {
                            console.log('User accepted the A2HS prompt');
                        } else {
                            console.log('User dismissed the A2HS prompt');
                        }
                        deferredPrompt = null;
                    });
            });
        });
    </script>


    <div class="control">
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
                            <img width="100%" class="object-fit-contain" src="./assets/pg/admins/<?php echo $row['universities_img_path']; ?>">
                            <div class="text-card">
                                <h4 class="title"><?php echo $row["university_name"]; ?></h4>
                                <p><?php echo $row["university_location"]; ?></p>
                                <form action="Show_Inf_university">
                                    <button name="id" value="<?php echo $row['university_id']; ?>">عرض الجامعة</button>
                                </form>
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
                            <img width="100%" class="object-fit-contain" src="./assets/pg/admins/<?php echo $row4['colleges_img_path']; ?>">
                            <div class="text-card">
                                <p><?php echo $row4["university_name"]; ?></p>
                                <h4 class="title"><?php echo $row4["college_name"]; ?></h4>
                                <form action="Show_Inf_college">
                                    <button name="id" value="<?php echo $row4['college_id']; ?>">عرض الكلية</button>
                                </form>
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
                    LEFT JOIN universities u ON c.university_id = u.university_id ORDER BY RAND() LIMIT 20";
                    $result5 = $conn->query($sql5);
                    while ($row5 = $result5->fetch_assoc()) {
                    ?>
                        <div class="card swiper-slide">
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
            </div>
        </section>
    </div>
    <?php include "assets/pg/Footer_Index.php"; ?>
    <script src="jquery-3.6.0.min"></script>

    <script src="assets/js/Script.js"></script>

    <script>
        window.onload = function() {

            new Swiper('.swiper-universities', {

                speed: 400,
                spaceBetween: 10,
                slidesPerView: 'auto',
                navigation: {
                    nextEl: '.swiper-btn-next-universities',
                    prevEl: '.swiper-btn-prev-universities',
                },
            });
            new Swiper('.swiper-colleges', {
                speed: 400,
                spaceBetween: 10,
                slidesPerView: 'auto',
                navigation: {
                    nextEl: '.swiper-btn-next-colleges',
                    prevEl: '.swiper-btn-prev-colleges',
                },
            });
            new Swiper('.swiper-departments', {

                speed: 400,
                spaceBetween: 10,
                slidesPerView: 'auto',
                navigation: {
                    nextEl: '.swiper-btn-next-departments',
                    prevEl: '.swiper-btn-prev-departments',
                },
            });

        };
    </script>
    <script src="./assets/js/swiper-bundle.min.js"></script>
</body>

</html>