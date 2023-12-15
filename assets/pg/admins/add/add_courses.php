<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | أضافة المواد الدراسية </title>
    <link rel="stylesheet" href="style">
</head>
<body>

<?php  include '../inc/navbar.php';?>

    <div class="content">
    <?php  include '../inc/sidebar.php';?>

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
                    $course_id  = mysqli_real_escape_string($conn, $_POST["course_id"]);
                    $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                    $course_name = mysqli_real_escape_string($conn, $_POST["course_name"]);
                    $course_stage = mysqli_real_escape_string($conn, $_POST["course_stage"]);
                    $course_description = mysqli_real_escape_string($conn, $_POST["course_description"]);
                    
                   
                   
                    $sqlTest = "SELECT course_id FROM courses WHERE course_id = '$course_id'";
                    $resultTest = $conn->query($sqlTest);
    
                    if ($resultTest->num_rows > 0) {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>عذرًا، معرف المادة الدراسية موجود مسبقًا</div>";
                    } else {
                        $sql = "INSERT INTO courses (course_id , department_id , course_name, course_stage, course_description) 
                                    VALUES ('$course_id', '$department_id', '$course_name', '$course_stage', '$course_description')";

                        $result3 = $conn->query($sql);
                        if ($result3) {
                            echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم إضافة معلومات المادة الدراسية بنجاح</div>";
                        } else {
                            echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>هنالك خطأ: " . $conn->error . "</div>";
                        }
                    }
                }
                
            ?>

            <div class="container-form">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="container" style="margin-bottom: 10px;">
                        <div class="row align-items-start">
                            <div class="col custom-column">
                            <select id="fruit" name="department_id" required>
                            <?php
                            include '../inc/conn.inc.php';
                            $sql = "SELECT department_id, department_name FROM departments";
                            $result = $conn->query($sql);
                            while ($rec = $result->fetch_assoc()) {
                                echo "<option value='" . $rec['department_id'] . "'>" . $rec['department_name'] . "</option>";
                            }
                            $conn->close();
                            ?>
                            </select>
                            </div>
                        </div>
                    </div>
                
                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="text" name="course_id" id="" placeholder="معرف المادة" required>
                        <input type="text" style="margin: 0px 10px;" name="course_name" id="" placeholder="اسم المادة" required>
                        <select id="fruit" name="course_stage" required>
                            <option value="">اختر المادة</option>
                            <option value="1">المرحلة الاولى</option>
                            <option value="2">المرحلة الثانية</option>
                            <option value="3">المرحلة الثالثة</option>
                            <option value="4">المرحلة الرابعة</option>
                        </select>

                    </div>


                    <textarea name="course_description" id="course_description" placeholder="النبذه عن المادة"></textarea>
                   
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
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 5000);
    </script>

</body>
</html>
