<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | أضافة الوظائف</title>
    <link rel="stylesheet" href="style">
</head>
<body>

<?php  include '../inc/navbar.php';?>

    <div class="content">
    <?php  include '../inc/sidebar.php';?>

        <div class="content-bar">
                <div style='position:relative; margin-top: 15px;'>
                    <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>أضافة الوظائف</h2>
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
                    $opportunity_id   = mysqli_real_escape_string($conn, $_POST["opportunity_id"]);
                    $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                    $job_title = mysqli_real_escape_string($conn, $_POST["job_title"]);
                    $salary_range = mysqli_real_escape_string($conn, $_POST["salary_range"]);
                    $job_description = mysqli_real_escape_string($conn, $_POST["job_description"]);

                   
                   
                    $sqlTest = "SELECT opportunity_id  FROM career_opportunities WHERE opportunity_id  = '$opportunity_id'";
                    $resultTest = $conn->query($sqlTest);
    
                    if ($resultTest->num_rows > 0) {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>عذرًا، معرف  الوظيفة موجود مسبقًا</div>";
                    } else {
                        $sql = "INSERT INTO career_opportunities (opportunity_id  , department_id , job_title, salary_range, job_description) 
                                    VALUES ('$opportunity_id', '$department_id', '$job_title', '$salary_range','$job_description')";

                        $result3 = $conn->query($sql);
                        if ($result3) {
                            echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم إضافة الوظيفة بنجاح</div>";
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
                        <input type="text" name="opportunity_id" id="" placeholder="معرف الوظيفة" required>
                        <input type="text" style="margin: 0px 10px;" name="job_title" id="" placeholder="العنوان الوظيفي" required>
                        <input type="text" name="salary_range" id="" placeholder="مقدار الراتب" required>
                    </div>
              
                
                    <p>نبذه عن المشروع</p>
                    <textarea name="job_description" id="editor1" placeholder="الوصف"></textarea>
                    
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
    <script src="index.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1');
        CKEDITOR.editorConfig = function( config ){
           config.language = 'ar';
           config.uiColor = '#f7b42c';
           config.height = 300;
           config.toolbarCanCollapse = true;
           config.contentsCss = 'margin-bottom: 15px;';
        };

    </script>
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 5000);
    </script>

</body>
</html>
