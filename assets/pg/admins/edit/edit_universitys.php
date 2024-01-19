<?php
session_start();

if ($_SESSION["admin_user"] != "Admin") {
    header("Location:login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | تعديل الجامعات</title>
    <link rel="stylesheet" href="style">
</head>

<body>
    <?php include '../inc/navbar.php'; ?>

    <div class="content">
        <?php include '../inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>تعديل الجامعات</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الجامعات</div>
                <div class="url-path slash">/</div>
                <div class="url-path">تعديل الجامعات</div>
            </div>

            <?php
            include '../inc/conn.inc.php';
            $row = array();

            if (isset($_POST['btn_edit'])){
                $universityId = $_POST['edit_id'];
                 $sql = "SELECT * FROM universities WHERE university_id =?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $universityId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            }
          

            if (isset($_POST["sub_form"])) {
                $university_id = mysqli_real_escape_string($conn, $_POST["Edit_Universitie_id"]);
                $university_name = mysqli_real_escape_string($conn, $_POST["university_name"]);
                $university_location = mysqli_real_escape_string($conn, $_POST["university_location"]);
                $university_website = mysqli_real_escape_string($conn, $_POST["university_website"]);


                $sql = "SELECT * FROM universities WHERE university_id =?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $university_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if (!empty($_FILES["universities_images"]["name"])) {
                    // if(isset($row['universities_img_path']) ) {
                        unlink("../". $row['universities_img_path']);
                    // }

                    
                    $universities_folder = '../universities_img';
                    $file_name = $_FILES["universities_images"]["name"];
                    $universities_images = $_FILES["universities_images"]["tmp_name"];
                    move_uploaded_file($universities_images, $universities_folder . '/' . $file_name);
                    $image_path = 'universities_img' . '/' . $file_name;

                    $sql = "UPDATE universities SET university_name = ?, university_location = ?, 
                            university_website = ?, universities_img_path = ? WHERE university_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssssi", $university_name, $university_location, $university_website, $image_path, $university_id);
           
                } else {
                    $image_path = $row['universities_img_path'];
                    $sql = "UPDATE universities SET university_name = ?, university_location = ?, 
                            university_website = ?, universities_img_path = ? WHERE university_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssssi", $university_name, $university_location, $university_website, $image_path, $university_id);
                    }

                $stmt->execute();
                

                if (1) {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم تحديث بيانات الجامعة بنجاح</div>";
                } else {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>حدث خطأ أثناء تحديث بيانات الجامعة: " . $stmt->error . "</div>";
                }
            }
            ?>

            <div class="container-form">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="container" style="margin-bottom: 10px;">
                        <div class="row align-items-start">
                            <div class="col custom-column">
                                <input type="hidden" name="Edit_Universitie_id" value="<?php 
                                 if (!isset($_POST['edit_id'])){echo "";}else{echo $universityId;}?>">
                                <input type="text" name="university_name" placeholder="اسم الجامعة"
                                    value="<?php if (!isset($_POST['edit_id'])){echo "";}else{ echo $row['university_name'];} ?>">
                                <input type="text" style="margin: 0px 10px;" name="university_location" id="row-2"
                                    placeholder="موقع الجامعة" value="<?php if (!isset($_POST['edit_id'])){echo "";}else{echo $row['university_location'];} ?>">
                                <input type="text" name="university_website" id="" placeholder="موقع الجامعة الالكتروني"
                                    value="<?php if (!isset($_POST['edit_id'])){echo "";}else{echo $row['university_website'];} ?>">
                                
                                </div>
                                <div class="container-img">   
                                <img id="uploaded-image" src="<?php if(!isset($_POST['edit_id'])){echo "";}else echo "assets/pg/admins/" . $row["universities_img_path"]; ?>" 
                                style="max-width: 80px;
                                max-height: 80px;
                                width: auto;
                                height: auto;
                                padding-left:20px;">
                                </div>
                            </div>
                        </div>

                        <div class="space"></div>
                        <div class="btn-row">
                        <input type="file" name="universities_images" class="file-btn" id="upload-input" accept="image/*"
                            onchange="displayImage()">
                        <input type="button" class="file-btn" value="تغير شعار الجامعة"
                            onclick="document.getElementById('upload-input').click();">
                        <p>
                            <input type="submit" name="sub_form" value="حفظ التغييرات" />
                        </p>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <script src="displayImage"></script>
    <script>
        setTimeout(function () {
            document.getElementById('success-message').style.display = 'none';
        }, 5000);
    </script>

</body>


</html>