<?php
require_once("../inc/conn.inc.php");
session_start();
if (isset($_SESSION["admin_user"])) {
    if (
        $_SESSION["admin_user"] != "Admin" && $_SESSION["admin_user"] != "SubAdmin"
        && $_SESSION["admin_user"] != "department"
    ) {
        header("Location: login");
        exit();
    }
} else {
    header("Location: login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | أضافة الطلبة الاوائل</title>
    <link href="./assets/fontawesome-free-6.5.1-web/css/fontawesome.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/brands.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="style">
</head>

<body>

    <?php include '../inc/navbar.php'; ?>

    <div class="content">
        <?php include '../inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: 550;'>أضافة الطلبة الاوائل</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الاقسام</div>
                <div class="url-path slash">/</div>
                <div class="url-path">أضافة الطلبة الاوائل</div>
            </div>
            <?php

            include '../inc/conn.inc.php';

            if (isset($_POST["sub_form"])) {

                //mysqli_real_escape_string للحماية من الهجمات
                $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                $student_name = mysqli_real_escape_string($conn, $_POST["student_name"]);
                $Graduation_Year = mysqli_real_escape_string($conn, $_POST["Graduation_Year"]);
                $Cumulative_Rating = mysqli_real_escape_string($conn, $_POST["Cumulative_Rating"]);





                    if ($_FILES['top_students_images']['type'] == 'image/png' || $_FILES['top_students_images']['type'] == 'image/jpeg') {
                        $top_students_folder = '../top_students_img';
                        if (!file_exists($top_students_folder)) {
                            mkdir($top_students_folder, 0777, true);
                            chmod($top_students_folder, 0777);
                        }
                        $top_students_images = $_FILES["top_students_images"]["tmp_name"];
                        $file_name = $_FILES["top_students_images"]["name"];
                        move_uploaded_file($top_students_images, $top_students_folder . '/' . $file_name);
                        $image_path = 'top_students_img' . '/' . $file_name;
                        $sql = "INSERT INTO top_students (department_id , student_name, Graduation_Year, Cumulative_Rating,top_students_img_path) 
                                                        VALUES ('$department_id', '$student_name', '$Graduation_Year', '$Cumulative_Rating','$image_path')";
                    } else {
                        $sql = "INSERT INTO top_students ( department_id , student_name, Graduation_Year, Cumulative_Rating) 
                                    VALUES ('$department_id', '$student_name', '$Graduation_Year', '$Cumulative_Rating')";
                    }

                    $result3 = $conn->query($sql);
                    if ($result3) {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم إضافة معلومات الطالب بنجاح</div>";
                    } else {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>هنالك خطأ: " . $conn->error . "</div>";
                    }
                }
            

            ?>
            <script src="jquery-3.6.0.min"></script>
            <script src="Get_ScriptFunction.js"></script>

            <div class="container-form">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="container" style="margin-bottom: 10px;">
                        <div class="row align-items-start">
                            <div class="col custom-column">
                                <select id="university_id" class="fruit" name="university_id" onchange="getColleges()">
                                    <?php
                                    include '../inc/conn.inc.php';
                                    $sql = "SELECT university_id, university_name FROM universities";
                                    $result = $conn->query($sql);
                                    while ($rec = $result->fetch_assoc()) {
                                        echo "<option value='" . $rec['university_id'] . "'>" . $rec['university_name'] . "</option>";
                                    }
                                    $conn->close();
                                    ?>
                                </select>
                                <select id="college_id" class="fruit" name="college_id" onchange="getInf_departments()">

                                </select>

                                <select id="department_id" class="fruit" name="department_id" required>
                                    <?php
                                    if ($_SESSION["admin_user"] == "department") {
                                        echo "<option value='" . $_SESSION["department_id"] . "'></option>";
                                    } ?>

                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="text" name="student_name" placeholder="اسم الطالب" required>
                        <input type="text" name="Cumulative_Rating" placeholder="المعدل التراكمي" required pattern="^(?:[5-9]\d|\d{2})(?:\.\d+)?$" title="الرجاء إدخال قيمة صحيحة بين 50 و 100">
                        <input type="date" name="Graduation_Year" placeholder="سنة التخرج" required>
                    </div>

                    <div class="container-img">
                        <img id="uploaded-image" src="#" style="max-width: 100px;
                            max-height: 100px;
                            width: auto;
                            height: auto;
                            padding-left:20px;">
                    </div>
                    <div class="space"></div>
                    <div class="btn-row">
                        <input type="file" name="top_students_images" class="file-btn" id="upload-input" accept="image/*" onchange="displayImage()">
                        <input type="button" class="file-btn" value="اختيار صورة للطالب " onclick="document.getElementById('upload-input').click();">
                        <p>
                            <input type="submit" name="sub_form" value="حـفـظ الـبـيـانـات" />
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="displayImage"></script>
    <?php if ($_SESSION["admin_user"] == "department") { ?>
        <style>
            #university_id,
            #college_id,
            #department_id {
                display: none;
            }
        </style>
    <?php } ?>


    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 4000);
    </script>

</body>

</html>