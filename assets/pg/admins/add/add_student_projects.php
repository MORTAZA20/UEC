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
    <title>لوحة التحكم | أضافة المشاريع</title>
    <link rel="stylesheet" href="style">
</head>

<body>

    <?php include '../inc/navbar.php'; ?>

    <div class="content">
        <?php include '../inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: 550;'>أضافة مشاريع الطلبة</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الاقسام</div>
                <div class="url-path slash">/</div>
                <div class="url-path">أضافة مشاريع الطلبة</div>
            </div>
            <?php

            include '../inc/conn.inc.php';

            if (isset($_POST["sub_form"])) {

                //mysqli_real_escape_string للحماية من الهجمات
                $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                $student_name = mysqli_real_escape_string($conn, $_POST["student_name"]);
                $project_name = mysqli_real_escape_string($conn, $_POST["project_name"]);
                $project_supervisor = mysqli_real_escape_string($conn, $_POST["project_supervisor"]);
                $project_description = mysqli_real_escape_string($conn, $_POST["project_description"]);
                $project_description  = str_replace(array("\r\n", "\\r\\n"), '', $project_description);





                    if ($_FILES['student_projects_images']['type'] == 'image/png' || $_FILES['student_projects_images']['type'] == 'image/jpeg') {


                        $student_projects_folder = '../student_projects_img';

                        if (!file_exists($student_projects_folder)) {
                            mkdir($student_projects_folder, 0777, true);
                            chmod($student_projects_folder, 0777);
                        }
                        $student_projects_images = $_FILES["student_projects_images"]["tmp_name"];
                        $file_name = $_FILES["student_projects_images"]["name"];
                        move_uploaded_file($student_projects_images, $student_projects_folder . '/' . $file_name);
                        $image_path = 'student_projects_img' . '/' . $file_name;
                        $sql = "INSERT INTO student_projects (department_id , student_name, project_name, project_supervisor,project_description,student_projects_img_path) 
                                    VALUES ('$department_id', '$student_name', '$project_name', '$project_supervisor','$project_description','$image_path')";
                        $result3 = $conn->query($sql);
                        if ($result3) {
                            echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم إضافة المشروع بنجاح</div>";
                        } else {
                            echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>هنالك خطأ: " . $conn->error . "</div>";
                        }
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
                        <input type="text" style="margin: 0px 10px;" name="project_name" placeholder="اسم المشروع" required>
                        <input type="text" name="student_name" placeholder="صاحب المشروع" required>
                        <input type="text" name="project_supervisor" placeholder="المشرف على المشروع" required>
                   </div>

                       
                    <p>نبذه عن المشروع</p>
                    <textarea name="project_description" id="editor" placeholder="نبذه عن المشروع"></textarea>
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
                    <div class="container-img">

                        <img id="uploaded-image" src="#" style="max-width: 100px;
                            max-height: 100px;
                            width: auto;
                            height: auto;
                            padding-left:20px;">
                    </div>
                    <div class="space"></div>
                    <div class="btn-row">
                        <input type="file" name="student_projects_images" class="file-btn" id="upload-input" accept="image/*" onchange="displayImage()">
                        <input type="button" class="file-btn" value="اختيار صورة للمشروع " onclick="document.getElementById('upload-input').click();">
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
    <script src="displayImage"></script>
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 4000);
    </script>

</body>

</html>