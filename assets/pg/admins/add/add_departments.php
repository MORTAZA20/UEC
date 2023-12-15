<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | أضافة معلومات الاقسام</title>
    <link rel="stylesheet" href="style">
</head>

<body>

    <?php include '../inc/navbar.php'; ?>

    <div class="content">
        <?php include '../inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>أضافة قسم جديد</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الاقسام</div>
                <div class="url-path slash">/</div>
                <div class="url-path">أضافة معلومات القسم</div>
            </div>
            <?php

            include '../inc/conn.inc.php';

            if (isset($_POST["sub_form"])) {

                //mysqli_real_escape_string للحماية من الهجمات
                $college_id = mysqli_real_escape_string($conn, $_POST["college_id"]);
                $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                $department_name = mysqli_real_escape_string($conn, $_POST["department_name"]);
                $department_description = mysqli_real_escape_string($conn, $_POST["department_description"]);
                $scientific_department_message = mysqli_real_escape_string($conn, $_POST["scientific_department_message"]);
                $required_GPA = mysqli_real_escape_string($conn, $_POST["required_GPA"]);
                $evening_GPA = mysqli_real_escape_string($conn, $_POST["evening_GPA"]);
                $evening_study_fees = mysqli_real_escape_string($conn, $_POST["evening_study_fees"]);
                $parallel_GPA = mysqli_real_escape_string($conn, $_POST["parallel_GPA"]);
                $parallel_study_fees = mysqli_real_escape_string($conn, $_POST["parallel_study_fees"]);

                $sqlTest = "SELECT department_id FROM departments WHERE department_id = '$department_id'";
                $resultTest = $conn->query($sqlTest);

                if ($resultTest->num_rows > 0) {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>عذرًا، معرف القسم موجود مسبقًا</div>";
                } else {
                    if ($_FILES['departments_images']['type'] == 'image/png' || $_FILES['departments_images']['type'] == 'image/jpeg') {


                        $departments_folder = 'departments_img';

                        if (!file_exists($departments_folder)) {
                            mkdir($departments_folder, 0777, true);
                            chmod($departments_folder, 0777);
                        }
                        $departments_images = $_FILES["departments_images"]["tmp_name"];
                        $file_name = $_FILES["departments_images"]["name"];
                        move_uploaded_file($departments_images, $departments_folder . '/' . $file_name);
                        $image_path = $departments_folder . '/' . $file_name;
                        $sql = "INSERT INTO departments (college_id , department_id , department_name, department_description, scientific_department_message, required_GPA , evening_GPA, evening_study_fees, parallel_GPA, parallel_study_fees,departments_img_path) 
                                    VALUES ('$college_id', '$department_id', '$department_name', '$department_description', '$scientific_department_message', '$required_GPA',  '$evening_GPA', '$evening_study_fees' , '$parallel_GPA', '$parallel_study_fees','$image_path')";
                        $result3 = $conn->query($sql);

                        if ($result3) {
                            echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم إضافة معلومات القسم بنجاح</div>";
                        } else {
                            echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>هنالك خطأ: " . $conn->error . "</div>";
                        }
                    } else {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>يرجى تحديد ملف صورة صحيح (PNG أو JPEG)</div>";
                    }
                }

            }
            $conn->close();
            ?>

            <div class="container-form">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="container" style="margin-bottom: 10px;">
                        <div class="row align-items-start">
                            <div class="col custom-column">
                                <select id="fruit" name="college_id" required>
                                    <?php
                                    include '../inc/conn.inc.php';
                                    $sql = "SELECT college_id, college_name FROM colleges";
                                    $result = $conn->query($sql);
                                    while ($rec = $result->fetch_assoc()) {
                                        echo "<option value='" . $rec['college_id'] . "'>" . $rec['college_name'] . "</option>";
                                    }
                                    $conn->close();
                                    ?>
                                </select>
                                <input type="text" style="margin: 0px 10px;" name="department_id" id="row-2"
                                    placeholder="معرف القسم" required>
                                <input type="text" name="department_name" id="" placeholder="اسم القسم" required>
                            </div>
                        </div>
                    </div>

                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="number" name="required_GPA" id="" placeholder="معدل القبول الصباحي" required>
                        <input type="number" style="margin: 0px 10px;" name="evening_GPA" id=""
                            placeholder="معدل القبول المسائي" required>
                        <input type="number" id="" name="evening_study_fees" placeholder="القسط السنوي(المسائي)"
                            required>
                    </div>

                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="number" name="parallel_GPA" id="" placeholder="معدل القبول الموازي" required>
                        <input type="number" style="margin: 0px 10px;" name="parallel_study_fees"
                            placeholder="القسط السنوي(الموازي)" required>
                    </div>
                  
                    <p>الوصف</p>
                    <textarea name="department_description" id="editor1" placeholder="النبذه عن القسم"></textarea>
                    <p>رسالة القسم</p>
                    <textarea name="scientific_department_message" id="editor2"
                            placeholder="رسالة القسم"></textarea>
                 
                    <div class="space"></div>
                    <div class="btn-row">
                        <input type="file" name="departments_images" class="file-btn" id="files"
                            accept="image/png, image/jpeg">
                        <input type="button" class="file-btn" value="اختيار شعار القسم"
                            onclick="document.getElementById('files').click();">
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