<?php
session_start();
if (isset($_SESSION["admin_user"])) {
if ($_SESSION["admin_user"] != "Admin" && $_SESSION["admin_user"] != "SubAdmin") {
    header("Location: login");
    exit();
}
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | تعديل المشاريع</title>
    <link rel="stylesheet" href="style">
</head>

<body>

    <?php include '../inc/navbar.php'; ?>

    <div class="content">
        <?php include '../inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>تعديل معلومات مشاريع الطلبة</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الاقسام</div>
                <div class="url-path slash">/</div>
                <div class="url-path">تعديل معلومات مشاريع الطلبة</div>
            </div>
            <?php

            include '../inc/conn.inc.php';

            if (isset($_POST["sub_form"])) {

                //mysqli_real_escape_string للحماية من الهجمات
                $Edit_project_id = mysqli_real_escape_string($conn, $_POST["project_id"]);
                $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                $student_name = mysqli_real_escape_string($conn, $_POST["student_name"]);
                $project_name = mysqli_real_escape_string($conn, $_POST["project_name"]);
                $project_supervisor = mysqli_real_escape_string($conn, $_POST["project_supervisor"]);
                $project_description = mysqli_real_escape_string($conn, $_POST["project_description"]);


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


                   $sqlUP_student_projects = "UPDATE student_projects SET department_id = '$department_id',student_name = '$student_name',project_name='$project_name',
                   project_supervisor='$project_supervisor',student_projects_img_path='$image_path',project_description='$project_description'
                   WHERE project_id = '$Edit_project_id'";
                    $result_sqlUP_student_projects = $conn->query($sqlUP_student_projects);

                    if ($result_sqlUP_student_projects) {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم تعديل معلومات المشروع بنجاح</div>";
                    } else {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>هنالك خطأ: " . $conn->error . "</div>";
                    }
                }
            }
            if (isset($_POST['btn_edit'])) {
                $project_id = $_POST['edit_id'];

                $sql = "SELECT * FROM student_projects WHERE project_id =?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $project_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
            }

            ?>
            <script src="jquery-3.6.0.min"></script>
            <script src="Get_ScriptFunction.js"></script>
            <div class="container-form">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="container" style="margin-bottom: 10px;">
                        <div class="row align-items-start">
                            <div class="col custom-column">
                                <select id="university_id" class="fruit" name="university_id" onchange="getColleges()"
                                    required>
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
                                <select id="college_id" class="fruit" name="college_id" onchange="getInf_departments()"
                                    required>

                                </select>

                                <select id="department_id" class="fruit" name="department_id" required>

                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="hidden" name="project_id" placeholder="معرف المشروع" value="<?php
                        if (!isset($_POST['edit_id'])) {
                            echo "";
                        } else {
                            echo $project_id;
                        }
                        ?>" required>
                        <input type="text" style="margin: 0px 10px;" name="project_name" placeholder="اسم المشروع"
                            value="<?php
                            if (!isset($_POST['edit_id'])) {
                                echo "";
                            } else {
                                echo $row['project_name'];
                            }
                            ?>" required>
                    </div>

                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="text" name="student_name" placeholder="صاحب المشروع" value="<?php
                        if (!isset($_POST['edit_id'])) {
                            echo "";
                        } else {
                            echo $row['student_name'];
                        }
                        ?>" required>
                        <input type="text" name="project_supervisor" placeholder="المشرف على المشروع" value="<?php
                        if (!isset($_POST['edit_id'])) {
                            echo "";
                        } else {
                            echo $row['project_supervisor'];
                        }
                        ?>" required>
                    </div>
                    <p>نبذه عن المشروع</p>
                    <textarea name="project_description" id="editor1" placeholder="الوصف">
                    <?php
                    if (!isset($_POST['edit_id'])) {
                        echo "";
                    } else {
                        echo $row['project_description'];
                    }
                    ?>
                    </textarea>

                    <div class="container-img">
                        <img id="uploaded-image" src="assets/pg/admins/<?php echo $row["student_projects_img_path"]; ?>"
                            style="max-width: 100px;
                        max-height: 100px;
                        width: auto;
                        height: auto;
                        padding-left:20px;">
                    </div>
                    <div class="space"></div>
                    <div class="btn-row">
                        <input type="file" name="student_projects_images" class="file-btn" id="upload-input"
                            accept="image/*" onchange="displayImage()">
                        <input type="button" class="file-btn" value="اختيار صورة للمشروع "
                            onclick="document.getElementById('upload-input').click();">
                        <p>
                            <input type="submit" name="sub_form" value="حـفـظ الـبـيـانـات" />
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="displayImage"></script>
    <script src="../../../../../ecomweb1/assets/pg/admins/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1');
        CKEDITOR.editorConfig = function (config) {
            config.language = 'ar';
            config.uiColor = '#f7b42c';
            config.height = 300;
            config.toolbarCanCollapse = true;
            config.contentsCss = 'margin-bottom: 15px;';
        };

    </script>
    <script>
        setTimeout(function () {
            document.getElementById('success-message').style.display = 'none';
        }, 5000);
    </script>

</body>

</html>