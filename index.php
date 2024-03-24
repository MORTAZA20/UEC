<?php
require_once("assets/pg/admins/inc/conn.inc.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>بوصلة التعليم الجامعي | الرئيسية</title>
    <link rel="stylesheet" href="./assets/css/swiper-bundle.min.css">
    <link href="./assets/fontawesome-free-6.5.1-web/css/fontawesome.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/brands.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet" />
    <link rel="icon" href="LOGO" type="image/png" sizes="16x16">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="assets/css/styleIndex.css"> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .sliders-ads {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sliders-ads img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .autoplay-progress {
            position: absolute;
            right: 16px;
            bottom: 16px;
            z-index: 10;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--swiper-theme-color);
        }

        .autoplay-progress svg {
            --progress: 0;
            position: absolute;
            left: 0;
            top: 0px;
            z-index: 10;
            width: 100%;
            height: 100%;
            stroke-width: 4px;
            stroke: var(--swiper-theme-color);
            fill: none;
            stroke-dashoffset: calc(125.6 * (1 - var(--progress)));
            stroke-dasharray: 125.6;
            transform: rotate(-90deg);
        }
    </style>
</head>

<body>

    <?php include "assets/pg/Navbar_Index.php"; ?>

    <div class="container1">
        <div class="popup" id="installPopup">
            <h1>هل تريد تثبيت تطبيق بوصلة التعليم الجامعي؟</h1>
            <button id="yesButton">تثبيت</button>
            <button id="noButton">الغاء</button>
        </div>
    </div>

    <div class="cont-sliders-ads">
        <div class="swiper sliders-ads">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="imgs\8.png"/>
                </div>
                <div class="swiper-slide">
                    <img src='imgs/7.png' />
                </div>
                <div class="swiper-slide">
                    <img src='imgs/m1.png' />
                </div>
                <div class="swiper-slide">
                    <img src='imgs/slider_ads1.jpg' />
                </div>
                <div class="swiper-slide">
                    <img src='imgs/slider_ads2.jpg' />
                </div>
                <div class="swiper-slide">
                    <img src='imgs/121.png' />
                </div>
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
            <div class="autoplay-progress">
                <svg viewBox="0 0 48 48">
                    <circle cx="24" cy="24" r="20"></circle>
                </svg>
                <span></span>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const progressCircle = document.querySelector(".autoplay-progress svg");
            const progressContent = document.querySelector(".autoplay-progress span");

            const swiper = new Swiper(".sliders-ads", {
                centeredSlides: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                on: {
                    autoplayTimeLeft(s, time, progress) {
                        progressCircle.style.setProperty("--progress", 1 - progress);
                        progressContent.textContent = `${Math.ceil(time / 1000)}s`;
                    },
                },
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
    <script>
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
        var div = document.querySelector('.popup');

        // Check for dismissal flag in local storage on page load
        const isPopupDismissed = localStorage.getItem("popupDismissed");
        if (isPopupDismissed) {
            div.style.display = 'none'; // Hide popup if dismissed previously
        } else {
            div.style.display = 'block'; // Show popup initially
        }

        // معالج الحدث للزر "نعم"
        document.getElementById('yesButton').addEventListener('click', function() {
            if (deferredPrompt) {
                // hide our user interface that shows our A2HS button
                div.style.display = 'none';
                // Show the prompt
                deferredPrompt.prompt();
                // Wait for the user to respond to the prompt
                deferredPrompt.userChoice
                    .then((choiceResult) => {
                        if (choiceResult.outcome === 'accepted') {
                            div.style.display = 'none';
                            localStorage.setItem("popupDismissed", true);
                            console.log('User accepted the A2HS prompt');
                        } else {
                            console.log('User dismissed the A2HS prompt');
                        }
                        deferredPrompt = null;
                    });
            }
        });

        // معالج الحدث للزر "لا"
        document.getElementById('noButton').addEventListener('click', function() {
            // Hide the popup and store dismissal flag in local storage
            div.style.display = 'none';
            localStorage.setItem("popupDismissed", true);
        });

        window.addEventListener('beforeinstallprompt', (e) => {
            // Prevent Chrome 67 and earlier from automatically showing the prompt
            e.preventDefault();
            // Stash the event so it can be triggered later.
            deferredPrompt = e;
        });
    </script>
    <script src="./assets/js/swiper-bundle.min.js"></script>
</body>

</html>