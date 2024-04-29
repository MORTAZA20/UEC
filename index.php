<?php
require_once("assets/pg/admins/inc/conn.inc.php");
$sql_settings = "SELECT * FROM settings WHERE id = 1";
$result_sql_settings = $conn->query($sql_settings);

$row_sql_settings = $result_sql_settings->fetch_assoc();
if ($row_sql_settings['Off_And_On'] == 0) {
    header("Location: message");
}
?>
<!DOCTYPE html>
<html>

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
    <script src="tailwind"></script>

    <style>
        .sliders-ads {
            text-align: center;
            font-size: 18px;
            height: 450px;
            background: #111822;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sliders-ads img {
            display: block;
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
            visibility: hidden;
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
            visibility: hidden;
        }

        .sliders-ads div[class^="swiper-button"] {
            color: #23a0a9;
            width: 40px;
            height: 40px;
        }
    </style>
</head>

<body>

    <?php include "assets/pg/Navbar_Index.php"; ?>

    <div class="cont-sliders-ads">
        <div class="swiper sliders-ads">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="flex w-screen h-full relative">
                        <img class="h-full left-0 absolute bottom-0" src="imgs/1.png" />

                        <div class="h-full w-screen py-4 px-16 text-right absolute bottom-0 right-0 bg-gradient-to-t from-black to-transparent sm:bg-gradient-to-r sm:from-transparent sm:to-black" style="direction: rtl;">
                            <h1 class="text-3xl mt-6 text-white font-bold drop-shadow-md">التنميه المستدامه (التعليم المستدام)</h1>
                            <p class="my-4 text-white drop-shadow-md sm:max-w-[450px] max-h-48 text-wrap">
                                يمثل مفهومًا حيويا يهدف إلى تطوير الوعي والمعرفة والمهارات
                                والقيم والسلوكيات لدى الأفراد، بما يمكنهم من المشاركة الفعالة
                                في حل المشكلات البيئية المعاصرة والتحديات الاجتماعية
                                والاقتصادية. بطريقة تضمن الحفاظ على موارد الأرض للأجيال
                                القادمة.
                            </p>
                            <button onclick="window.open('sustainability', '_self');" class="border-solid text-teal-500 text-3xl hover:text-white border border-teal-500 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-4">معرفة المزيد</button>
                            <!-- <div class="absolute bottom-0 right-0 z-10 bg-gradient-to-t from-black to-transparent"></div> -->
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="flex w-screen h-full relative">
                        <img class="h-full left-0 absolute bottom-0" src="imgs/3.jpeg" />

                        <div class="h-full w-screen py-4 px-16 text-right absolute bottom-0 right-0 bg-gradient-to-t from-black to-transparent" style="direction: rtl;">
                            <h1 class="text-3xl mt-6 text-white font-bold drop-shadow-md">التعليم المستدام</h1>
                            <p class="my-4 text-white drop-shadow-md" style="max-width: 350px;">
                                يمثل مفهومًا حيويا يهدف إلى تطوير الوعي والمعرفة والمهارات
                                والقيم والسلوكيات لدى الأفراد، بما يمكنهم من المشاركة الفعالة
                                في حل المشكلات البيئية المعاصرة والتحديات الاجتماعية
                                والاقتصادية. بطريقة تضمن الحفاظ على موارد الأرض للأجيال
                                القادمة.
                            </p>
                            <button class="border-solid text-teal-500 text-3xl hover:text-white border border-teal-500 hover:bg-teal-500 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-4">معرفة المزيد</button>
                            <!-- <div class="absolute bottom-0 right-0 z-10 bg-gradient-to-t from-black to-transparent"></div> -->
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="flex w-screen h-full">
                        <img class="h-full left-0 absolute bottom-0" src="imgs/2.jpeg" />
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="flex w-screen h-full">
                        <img class="h-full left-0 absolute bottom-0" src="imgs/3.jpeg" />
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="flex w-screen h-full">
                        <img class="h-full left-0 absolute bottom-0" src="imgs/4.jpg" />
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="flex w-screen h-full">
                        <img class="h-full left-0 absolute bottom-0" src="imgs/8.png" />
                    </div>
                </div>
            </div>

            <div class="swiper-button-next h-14 w-14"></div>
            <div class="swiper-button-prev h-14 w-14"></div>
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
                    delay: 7000,
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
                <h3>الجامعات المقترحة</h3>
                <div class="btn-grup">
                    <div class="swiper-btn-prev-universities"><i class="fas fa-chevron-right"></i></div>
                    <div class="swiper-btn-next-universities"><i class="fas fa-chevron-left"></i></div>
                </div>
            </div>
            <div class="swiper-universities swiper-best-sellers">
                <div class="swiper-wrapper">
                    <?php

                    $sql = "(SELECT * FROM universities WHERE university_name = 'جامعة البصرة')
                                UNION ALL
                                (SELECT * FROM universities WHERE university_name != 'جامعة البصرة' ORDER BY RAND() LIMIT 19)";
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

                    $sql4 = "(SELECT c.*, u.university_name
                                FROM colleges c
                                LEFT JOIN universities u ON c.university_id = u.university_id 
                                WHERE c.college_name = 'كلية التربية للعلوم الصرفة')
                                UNION ALL
                                (SELECT c.*, u.university_name
                                FROM colleges c
                                LEFT JOIN universities u ON c.university_id = u.university_id 
                                WHERE c.college_name != 'كلية التربية للعلوم الصرفة' ORDER BY RAND() LIMIT 19)";
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

        window.addEventListener('beforeinstallprompt', (e) => {
            // Prevent Chrome 67 and earlier from automatically showing the prompt
            e.preventDefault();
            // Prompt can be shown programmatically later if needed.
        });
    </script>

    <script src="./assets/js/swiper-bundle.min.js"></script>
</body>

</html>