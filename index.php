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
    <link rel="stylesheet" href="assets/css/styleIndex.css">
</head>

<body>
    <div class="header">
        <i class="fa-solid fa-xmark"></i>
        <p>07839985872</p>
    </div>
    <?php include "assets/pg/Navbar_Index.php";?>
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
                            <img width="100%" class="object-fit-contain" src="assets/pg/admins/<?php echo $row['universities_img_path']; ?>">
                            <div class="text-card">
                                <h4 class="title"><?php echo $row["university_name"]; ?></h4>
                                <p><?php echo $row["university_location"]; ?></p>
                                <button onclick="window.open('Show_Inf_university?id=<?php echo $row['university_id']; ?>', '_self');">عرض الجامعة</button>
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
                                <button onclick="window.open('Show_Inf_college?id=<?php echo $row4['college_id']; ?>', '_self');">عرض الكلية</button>
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
                                <button onclick="window.open('Show_Inf_department?id=<?php echo $row5['department_id']; ?>', '_self');">عرض القسم</button>
                            </div>
                        </div>
                    <?php
                    } ?>
                </div>
            </div>
        </section>
    </div>
    <?php include "assets/pg/Footer_Index.php";?>
    <script src="jquery-3.6.0.min"></script>
    <script>
        $(document).ready(function() {
            $("#search-box").on("input", function() {
                var searchValue = $(this).val().trim(); 
                if (searchValue === "") {
                    $("#search-results").empty();
                    $(".search-results").hide(); 
                    return;
                }
                $.ajax({
                    type: "POST",
                    url: "assets/pg/SearchHome.php",
                    data: {
                        search: searchValue
                    },
                    success: function(data) {
                        if (data.trim() !== "") {
                            $(".search-results").html(data);
                            $(".search-results").show();
                        } else {
                            $(".search-results").html("<div>لا توجد نتائج.</div>");
                            $(".search-results").show();
                        }
                    }
                });
            });

            $(document).on("click", ".search-results div", function() {
                var resultText = $(this).text();
                $("#search-box").val(resultText);
                $(".search-results").hide();
            });

            $(document).on("click", function(event) {
                if (!$(event.target).closest('.search-from').length) {
                    $(".search-results").hide();
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("search-results").style.display = "none";
        });

        function showResults() {
            document.getElementById("search-results").style.display = "block";
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const xMark = document.querySelector(".fa-xmark");
            const header = document.querySelector(".header");

            xMark.addEventListener("click", function() {
                header.classList.toggle("hide");
            });
        });
    </script>
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