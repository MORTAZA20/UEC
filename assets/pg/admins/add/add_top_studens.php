<?php
require_once("../inc/conn.inc.php");
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
    <title>لوحة التحكم | أضافة الطلبة الاوائل</title>
    <link rel="stylesheet" href="style">
</head>

<body>

    <?php include '../inc/navbar.php'; ?>

    <div class="content">
        <?php include '../inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>أضافة الطلبة الاوائل</h2>
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
                $student_id = mysqli_real_escape_string($conn, $_POST["student_id"]);
                $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                $student_name = mysqli_real_escape_string($conn, $_POST["student_name"]);
                $Graduation_Year = mysqli_real_escape_string($conn, $_POST["Graduation_Year"]);
                $Cumulative_Rating = mysqli_real_escape_string($conn, $_POST["Cumulative_Rating"]);



                $sqlTest = "SELECT student_id  FROM top_students WHERE student_id  = '$student_id'";
                $resultTest = $conn->query($sqlTest);

                if ($resultTest->num_rows > 0) {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>عذرًا، معرف المادة الدراسية موجود مسبقًا</div>";
                } else {
                    $sql = "INSERT INTO top_students (student_id  , department_id , student_name, Graduation_Year, Cumulative_Rating) 
                                    VALUES ('$student_id ', '$department_id', '$student_name', '$Graduation_Year', '$Cumulative_Rating')";

                    $result3 = $conn->query($sql);
                    if ($result3) {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم إضافة معلومات الطالب بنجاح</div>";
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
                                   if($_SESSION["admin_user"] == "department"){
                                        echo "<option value='" . $_SESSION["department_id"] . "'></option>"; 
                                    }?>                                
  
                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="text" name="student_id" placeholder="معرف الطالب" required>
                        <input type="text" name="student_name" placeholder="اسم الطالب" required>
                    </div>
                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="text" name="Cumulative_Rating" placeholder="المعدل التراكمي" required>
                        <input type="date" name="Graduation_Year" placeholder="سنة التخرج" required>
                    </div>

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
    <?php if($_SESSION["admin_user"] == "department"){?>
        <style>
            #university_id,#college_id,#department_id{
               display : none;
            }
        </style>
    <?php } ?>

   
    <script>
        setTimeout(function () {
            document.getElementById('success-message').style.display = 'none';
        }, 4000);
    </script>

</body>

</html>