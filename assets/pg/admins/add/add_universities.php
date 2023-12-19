<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | أضافة الجامعات</title>
    <link rel="stylesheet" href="style"> <!-- قد تحتاج تغيير اسم الملف حسب اسم ملف الستايل الخاص بك -->
</head>
<body>

<?php  include '../inc/navbar.php';?>

    <div class="content">
    <?php  include '../inc/sidebar.php';?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>إضافة جامعة جديدة</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الجامعات</div>
                <div class="url-path slash">/</div>
                <div class="url-path">إضافة جامعة جديدة</div>
            </div>

            <?php
                include '../inc/conn.inc.php';

                if (isset($_POST["sub_form"])) {
                    $university_id = mysqli_real_escape_string($conn, $_POST["university_id"]);
                    $university_name = mysqli_real_escape_string($conn, $_POST["university_name"]);
                    $university_location = mysqli_real_escape_string($conn, $_POST["university_location"]);
                    $university_website = mysqli_real_escape_string($conn, $_POST["university_website"]);

                    $sqlTest = "SELECT university_id FROM universities WHERE university_id = '$university_id'";
                    $resultTest = $conn->query($sqlTest);

                    if ($resultTest->num_rows > 0) {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>عذرًا، معرف الجامعة موجود مسبقًا</div>";
                    } else {
                        if ($_FILES['universities_images']['type'] === 'image/png' || $_FILES['universities_images']['type'] === 'image/jpeg') {
                            {   
                                $universities_folder = '../universities_img' ;

                                if (!file_exists($universities_folder)) {
                                    mkdir($universities_folder, 0777, true);
                                    chmod($universities_folder, 0777);
                                }
                                $file_name = $_FILES["universities_images"]["name"];
                                $universities_images = $_FILES["universities_images"]["tmp_name"];
                                move_uploaded_file($universities_images, $universities_folder . '/' . $file_name);
                                $image_path = 'universities_img' . '/' . $file_name;
                            
                                $sql = "INSERT INTO universities (university_id, university_name, university_location, university_website, universities_img_path) 
                                        VALUES ('$university_id', '$university_name', '$university_location', '$university_website', '$image_path')";
                            
                            $result3 = $conn->query($sql);

                            if ($result3) {
                                echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم إضافة الجامعة بنجاح</div>";
                            } else {
                                echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>هناك خطأ: " . $conn->error . "</div>";
                            }
                        } 
                    }else{
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
                                <input type="text" name="university_id" id="" placeholder="معرف الجامعة" required>
                                <input type="text" style="margin: 0px 10px;" name="university_name" placeholder="اسم الجامعة" required>
                                <input type="text" name="university_location" id="" placeholder="موقع الجامعة" required>
                            </div>
                        </div>
                    </div>

                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="text" name="university_website" id="" placeholder="موقع الجامعة الالكتروني" required>
                    </div>

                    <div class="space"></div>
                    <div class="btn-row">
                        <input type="file" name="universities_images" class="file-btn" id="files" accept="image/png, image/jpeg" >
                        <input type="button" class="file-btn" value="اختيار شعار الجامعة" onclick="document.getElementById('files').click();">
                        <p>
                            <input type="submit" name="sub_form" value="حفظ البيانات" />
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
