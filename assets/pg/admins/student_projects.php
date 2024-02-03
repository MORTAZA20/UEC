<?php
require_once("inc/conn.inc.php");
session_start();
if (isset($_SESSION["admin_user"])) {
if ($_SESSION["admin_user"] != "Admin" && $_SESSION["admin_user"] != "SubAdmin"
&& $_SESSION["admin_user"] != "department") {
    header("Location: login");
    exit();
}
}else{
    header("Location: login");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | معلومات مشاريع الطلاب </title>
    <link rel="stylesheet" href="style">
</head>

<body>

    <?php include 'inc/navbar.php'; ?>
    <div class="content">

        <?php include 'inc/sidebar.php'; ?>
        <div class="content-bar">
            <div style='position:relative; margin-top: 15px; '>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>
                    مشاريع الطلاب
                </h2>
            </div>

            <button class="btn-style" onclick="window.open('add_student_projects' , '_self');"><div class="Imgitem" style="background-image: url('A1');"></div>
            أضافة مشروع جديد</button>


            <div class="group">
                <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                    <g>
                        <path
                            d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                        </path>
                    </g>
                </svg>

                <input id="search" name="search" placeholder="ادخل اسم المشروع او القسم" type="search"
                    class="input-placeholder" onkeyup="search()">
            </div>


            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الاقسام</div>
                <div class="url-path slash">/</div>
                <div class="url-path">معلومات مشاريع الطلاب</div>
            </div>

            <table class="table teble-bordered" id="table-data" role="table">
                <thead>
                    <tr>
                        <th class="text-right" width="10%">معرف المشروع</th>
                        <th class="text-right" width="10%">القسم</th>
                        <th class="text-right" width="10%">اسم المشروع</th>
                        <th class="text-right" width="10%">صاحب المشروع</th>
                        <th class="text-right" width="15%">المشرف على المشروع</th>
                        <th class="text-right" width="10%">صورة المشروع</th>
                        <th class="text-right" width="15%">نبذه عن المشروع</th>
                        <th class="text-right" width="20%">التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include "search/search_student_projects.php"; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="jquery-3.6.0.min"></script>
    <script>
        $(document).ready(function () {
            $("#search").on("input", function () {
                var searchValue = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "../university-education-compass/assets/pg/admins/search/search_student_projects.php",
                    data: { search: searchValue },
                    success: function (data) {
                        $("#table-data tbody").html(data);
                    }
                });
            });
        });
    </script>


    <script>
        function submitForm(delId) {
            document.getElementById('del_id_input').value = delId;
            document.getElementById('deleteForm').submit();
        }
    </script>
</body>

</html>