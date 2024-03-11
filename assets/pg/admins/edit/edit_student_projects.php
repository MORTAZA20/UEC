<?php
session_start();
if (isset($_SESSION["admin_user"])) {
if ($_SESSION["admin_user"] != "Admin" 
&& $_SESSION["admin_user"] != "SubAdmin"
&& $_SESSION["admin_user"] != "department") {
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
            if (isset($_POST['btn_edit'])) {
                $edit_id = $_POST['edit_id'];

                $sql = "SELECT sp.*, d.*, c.*, u.*
                FROM student_projects sp
                JOIN departments d ON sp.department_id = d.department_id
                JOIN colleges c ON d.college_id = c.college_id
                JOIN universities u ON c.university_id = u.university_id
                WHERE sp.project_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $edit_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
            }
            if (isset($_POST["sub_form"])) {

                //mysqli_real_escape_string للحماية من الهجمات
                $Edit_project_id = mysqli_real_escape_string($conn, $_POST["project_id"]);
                $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                $student_name = mysqli_real_escape_string($conn, $_POST["student_name"]);
                $project_name = mysqli_real_escape_string($conn, $_POST["project_name"]);
                $project_supervisor = mysqli_real_escape_string($conn, $_POST["project_supervisor"]);
                $project_description = mysqli_real_escape_string($conn, $_POST["project_description"]);
                $project_description  = str_replace(array("\r\n", "\\r\\n"), '', $project_description);


                $sql = "SELECT * FROM student_projects WHERE project_id =?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $Edit_project_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if (empty($_FILES["student_projects_images"]["name"]) 
                && $row['department_id'] == $department_id 
                && $row['student_name'] == $student_name
                && $row['project_name'] == $project_name
                && $row['project_supervisor'] == $project_supervisor
                && $row['project_description'] == $project_description) {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>لم يتم تحديث بيانات المشروع </div>";
                }else{
                
                if (!empty($_FILES["student_projects_images"]["name"])) {
                        unlink("../". $row['student_projects_img_path']);

                    $student_projects_folder = '../student_projects_img';
                    $student_projects_images = $_FILES["student_projects_images"]["tmp_name"];
                    $file_name = $_FILES["student_projects_images"]["name"];
                    move_uploaded_file($student_projects_images, $student_projects_folder . '/' . $file_name);
                    $image_path = 'student_projects_img' . '/' . $file_name;

                }else{
                    $image_path = $row['student_projects_img_path'];
                }
                   $sqlUP = "UPDATE student_projects SET department_id = ?,student_name = ?,project_name=?,
                   project_supervisor= ? , student_projects_img_path= ? ,project_description=?
                   WHERE project_id = ?";

                   $stmt = $conn->prepare($sqlUP);
                   $stmt->bind_param("ssssssi", $department_id, $student_name, $project_name, $project_supervisor, $image_path, $project_description, $Edit_project_id);
                   $stmt->execute();

                    if ($stmt->affected_rows > 0){
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم تعديل معلومات المشروع بنجاح</div>";
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
                                        ?>
                                            <option value="<?php if (!isset($_POST['edit_id'])) {
                                        echo "";
                                        }else{ echo $rec['university_id'] ;}?>" 
                                            <?php 
                                               if (isset($_POST['edit_id'])) {
                                                if ($rec['university_id'] == $row['university_id']) { echo  "selected" ; } 
                                            } 
                                            ?>>
                                            <?php if (!isset($_POST['edit_id'])) {
                                        echo "";
                                        }else{  echo $rec['university_name'] ;} ?></option>
                                                
                                                
                                            <?php 
                                            }
                                        $conn->close();
                                        ?>
                                </select>
                                <select id="college_id" class="fruit" name="college_id" onchange="getInf_departments()" >
                        <option value="<?php if (!isset($_POST['edit_id'])) {
                            echo "";
                        }else{ echo $row['college_id'] ;}?>"> 
                        <?php if (!isset($_POST['edit_id'])) {
                            echo "";
                        }else{ echo $row['college_name'] ;} ?>
                        </option>
                        </select>
                        <select id="department_id" class="fruit" name="department_id">
                        <option value="<?php if (!isset($_POST['edit_id'])) {
                            echo "";
                        }else{ echo $row['department_id'] ;}?>"> 
                        <?php if (!isset($_POST['edit_id'])) {
                            echo "";
                        }else{ echo $row['department_name'] ;} ?>
                        </option>
                        <?php 
                            if($_SESSION["admin_user"] == "department"){
                                echo "<option value='" . $_SESSION["department_id"] . "'></option>"; 
                            }?>
                        </select>
                            </div>
                        </div>
                    </div>



                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="hidden" name="project_id" placeholder="معرف المشروع" value="<?php
                        if (!isset($_POST['edit_id'])) {
                            echo "";
                        } else {
                            echo $edit_id;
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
    <?php if($_SESSION["admin_user"] == "department"){?>
        <style>
            #university_id,#college_id,#department_id{
               display : none;
            }
        </style>
    <?php } ?>
    <script src="displayImage"></script>
    <script src="../../../../../university-education-compass/assets/pg/admins/ckeditor/ckeditor.js"></script>
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
            window.location.href = 'student_projects';
        }, 4000);
    </script>

</body>

</html>