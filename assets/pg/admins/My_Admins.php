<?php
require_once("inc/conn.inc.php");
session_start();
if (isset($_SESSION["admin_user"])) {
    if ($_SESSION["admin_user"] != "Admin") {
        header("Location: login");
        exit();
    }
} else {
    header("Location: login");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | المشرفين</title>
    <link href="./assets/fontawesome-free-6.5.1-web/css/fontawesome.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/brands.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="style">
</head>

<body>

    <?php include 'inc/navbar.php'; ?>

    <div class="content">
        <?php include 'inc/sidebar.php'; ?>
        <div class="content-bar">
            <div style='position:relative; margin-top: 15px; '>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: 550;'>المشرفين
            </div>
            <button class="btn-style" onclick="window.open('add_admin' , '_self');">
                <div class="Imgitem" style="background-image: url('A1');"></div>
                إضافة مشرف جديد
            </button>

            <div class="group">
                <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                    <g>
                        <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                        </path>
                    </g>
                </svg>

                <input id="search" name="search" placeholder="ادخل اسم المستخدم او المعرف" type="search" class="input-placeholder">
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">المشرفين</div>
            </div>

            <table class="table teble-bordered" id="table-data" role="table">
                <thead>
                    <tr>
                        <th class="text-right" width="10%">اسم الكلية</th>
                        <th class="text-right" width="10%">اسم القسم</th>
                        <th class="text-right" width="10%">إسم المستخدم</th>
                        <th class="text-right" width="10%">تاريخ التسجيل </th>
                        <th class="text-right" width="10%">وقت التسجيل </th>
                        <th class="text-right" width="10%">النوع</th>

                        <th class="text-right" width="25%">التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include "search/search_My_Admins.php"; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="jquery-3.6.0.min"></script>
    <script>
        $(document).ready(function() {
            $("#search").on("input", function() {
                var searchValue = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "../university-education-compass/assets/pg/admins/search/search_My_Admins.php",
                    data: {
                        search: searchValue
                    },
                    success: function(data) {
                        $("tbody").html(data);
                    }
                });
            });
        });
    </script>

</body>

</html>