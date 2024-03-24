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
    <title>لوحة التحكم | أضافة الوظائف</title>
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
                <h2 style='margin-right:20px; font-size: 32px; font-weight: 550;'>أضافة الوظائف</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الاقسام</div>
                <div class="url-path slash">/</div>
                <div class="url-path">أضافة الوظائف</div>
            </div>
            <?php

            include '../inc/conn.inc.php';

            if (isset($_POST["sub_form"])) {

                //mysqli_real_escape_string للحماية من الهجمات
                $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                $job_title = mysqli_real_escape_string($conn, $_POST["job_title"]);
                $salary_range = mysqli_real_escape_string($conn, $_POST["salary_range"]);
                $job_description = mysqli_real_escape_string($conn, $_POST["job_description"]);
                $job_description  = str_replace(array("\r\n", "\\r\\n"), '', $job_description);



                    $sql = "INSERT INTO career_opportunities (department_id , job_title, salary_range, job_description) 
                                VALUES ('$department_id', '$job_title', '$salary_range','$job_description')";

                    $result3 = $conn->query($sql);
                    if ($result3) {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم إضافة الوظيفة بنجاح</div>";
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
                        <input type="text" name="job_title" placeholder="العنوان الوظيفي" required>
                        <input type="text" name="salary_range" placeholder="مقدار الراتب" required>
                    </div>

                    <br>
                    <p>نبذه عن الوظيفة</p>
                    <textarea name="job_description" id="editor" placeholder="الوصف"></textarea>
                    <script src=".\assets\pg\admins\ckeditor\js\index.js"></script>
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