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
                <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>أضافة المواد الدراسية</h2>
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
                $course_id = mysqli_real_escape_string($conn, $_POST["course_id"]);
                $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                $course_name = mysqli_real_escape_string($conn, $_POST["course_name"]);
                $course_stage = mysqli_real_escape_string($conn, $_POST["course_stage"]);
                $course_description = mysqli_real_escape_string($conn, $_POST["course_description"]);

              
                $sqlUP_courses= "UPDATE courses SET department_id='$department_id' ,course_name = '$course_name',course_stage='$course_stage' ,course_description='$course_description' WHERE course_id = '$course_id'";
                $result_UP_courses = $conn->query($sqlUP_courses);
                if ($result_UP_courses) {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم تعديل معلومات المادة الدراسية بنجاح</div>";
                } else {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>هنالك خطأ: " . $conn->error . "</div>";
                }
                }
            
                if (isset($_POST['btn_edit'])){
                    $Edit_course_id = $_POST['edit_id'];
                }
              
                $sql = "SELECT * FROM courses WHERE course_id =?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $Edit_course_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
            ?>
            <script src="jquery-3.6.0.min"></script>
            <script src="Get_ScriptFunction"></script>

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
                        <input type="hidden" name="course_id" placeholder="معرف المادة" 
                        value="<?php
                                 if (!isset($_POST['edit_id'])){echo "";}else{echo $Edit_course_id;}?>" required>
                        <input type="text" name="course_name" placeholder="اسم المادة"
                        value="<?php if (!isset($_POST['edit_id'])){echo "";}else{echo $row['course_name'];} ?>" required>
                        <select id="fruit" name="course_stage" class="fruit" required>
                            <option value="1">المرحلة الاولى</option>
                            <option value="2">المرحلة الثانية</option>
                            <option value="3">المرحلة الثالثة</option>
                            <option value="4">المرحلة الرابعة</option>
                        </select>

                    </div>


                    <textarea name="course_description" id="editor1" placeholder="النبذه عن المادة">
                        <?php if (!isset($_POST['edit_id'])){echo "";}else{echo $row['course_description'];}?>
                    </textarea>

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
    <script>
        setTimeout(function () {
            document.getElementById('success-message').style.display = 'none';
        }, 5000);
    </script>
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
</body>

</html>