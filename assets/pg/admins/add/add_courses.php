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
    <title>لوحة التحكم | أضافة المواد الدراسية </title>
    <link rel="stylesheet" href="style">
</head>

<body>

    <?php include '../inc/navbar.php'; ?>

    <div class="content">
        <?php include '../inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: 550;'>أضافة المواد الدراسية</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الاقسام</div>
                <div class="url-path slash">/</div>
                <div class="url-path">أضافة المواد الدراسية</div>
            </div>
            <?php

            include '../inc/conn.inc.php';

            if (isset($_POST["sub_form"])) {

                //mysqli_real_escape_string للحماية من الهجمات
                $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                $course_name = mysqli_real_escape_string($conn, $_POST["course_name"]);
                $course_stage = mysqli_real_escape_string($conn, $_POST["course_stage"]);
                $course_description = mysqli_real_escape_string($conn, $_POST["course_description"]);
                $course_description  = str_replace(array("\r\n", "\\r\\n"), '', $course_description);

                    $sql = "INSERT INTO courses ( department_id , course_name, course_stage, course_description) 
                                VALUES ('$department_id', '$course_name', '$course_stage', '$course_description')";

                    $result3 = $conn->query($sql);
                    if ($result3) {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم إضافة معلومات المادة الدراسية بنجاح</div>";
                    } else {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>هنالك خطأ: " . $conn->error . "</div>";
                    }
                }
            ?>
            <script src="jquery-3.6.0.min"></script>
            <script src="Get_ScriptFunction"></script>

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
                                        echo "<option value='" . $_SESSION["department_id"] . "' selected></option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="text" name="course_name" placeholder="اسم المادة" required>
                        <select id="fruit" name="course_stage" class="fruit" required>
                            <option value="1">المرحلة الاولى</option>
                            <option value="2">المرحلة الثانية</option>
                            <option value="3">المرحلة الثالثة</option>
                            <option value="4">المرحلة الرابعة</option>
                        </select>

                    </div>

                    <br>
                    <p>وصف المادة الدراسية</p>

                    <script src=".\assets\pg\admins\ckeditor\js\index.js"></script>
                    <textarea name="course_description" id="editor" placeholder="وصف المادة الدراسية"></textarea>
                    <script>
                        ClassicEditor
                            .create(document.querySelector('#editor'), {
                                language: 'ar',
                                uiLanguage: 'ar'
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    </script>

                    <div class="space"></div>
                    <div class="btn-row">
                        <p>
                            <input type="submit" name="sub_form" value="حـفـظ الـبـيـانـات" />
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
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