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
    <title>لوحة التحكم | تعديل معلومات الكليات</title>
    <link rel="stylesheet" href="style">
</head>

<body>
    <?php include '../inc/navbar.php'; ?>

    <div class="content">
        <?php include '../inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>تعديل معلومات الكلية</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الكليات</div>
                <div class="url-path slash">/</div>
                <div class="url-path">تعديل الكلية</div>
            </div>

            <?php
            include '../inc/conn.inc.php';

            if (isset($_POST["sub_form"])) {

                $university_id = mysqli_real_escape_string($conn, $_POST["university_id"]);
                $college_id = mysqli_real_escape_string($conn, $_POST["Edit_college_id"]);
                $college_name = mysqli_real_escape_string($conn, $_POST["college_name"]);
                $required_GPA = mysqli_real_escape_string($conn, $_POST["required_GPA"]);
                $college_description = mysqli_real_escape_string($conn, $_POST["college_description"]);

                if ($_FILES['colleges_images']['type'] === 'image/png' || $_FILES['colleges_images']['type'] === 'image/jpeg') {
                        
                    $colleges_folder = '../colleges_img';
                    if (!file_exists($colleges_folder)) {
                        mkdir($colleges_folder, 0777, true);
                        chmod($colleges_folder, 0777);
                    }
                    ini_set('upload_max_filesize', '50M');
                    ini_set('post_max_size', '50M');
                    $file_name = $_FILES["colleges_images"]["name"];
                    $colleges_images = $_FILES["colleges_images"]["tmp_name"];
                    move_uploaded_file($colleges_images, $colleges_folder . '/' . $file_name);
                    $image_path = 'colleges_img' . '/' . $file_name;

                    $sql = "UPDATE colleges SET university_id = ?, college_name = ?, required_GPA = ?, 
                    college_description = ?, colleges_img_path = ? WHERE college_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssssss", $university_id, $college_name, $required_GPA, $college_description, $image_path, $college_id);
                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم تعديل بيانات الكلية بنجاح</div>";
                    } else {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>حدث خطأ أثناء تعديل بيانات الجامعة: " . $stmt->error . "</div>";
                    }
                } else {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>يرجى تحديد ملف صورة صحيح (PNG أو JPEG)</div>";
                }
            }


            if (isset($_POST['btn_edit'])) {
                $collegeId = $_POST['edit_id'];
            }
       
            $sql = "SELECT * FROM colleges WHERE college_id =?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $collegeId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();


            ?>
            <div class="container-form">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="container" style="margin-bottom: 10px;">
                        <div class="row align-items-start">
                            <div class="col custom-column">
                                <select class="fruit" name="university_id" required>
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
                            </div>
                        </div>
                    </div>

                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="hidden" name="Edit_college_id" placeholder="معرف الكلية" value="<?php 
                                 if (!isset($_POST['edit_id'])){echo "";}else{echo $collegeId;}?>"required>
                        <input type="text" name="college_name" placeholder="اسم الكلية" value="<?php 
                                 if (!isset($_POST['edit_id'])){echo "";}else{echo  $row['college_name'];}?>"required>
                        <input type="number" name="required_GPA"placeholder="المعدل" value="<?php 
                                 if (!isset($_POST['edit_id'])){echo "";}else{echo  $row['required_GPA'];}?>" required>
                    </div>

                    <div class="container-img">   
                            <img id="uploaded-image" src="assets/pg/admins/<?php echo $row["colleges_img_path"]; ?>" 
                            style="max-width: 80px;
                            max-height: 80px;
                            width: auto;
                            height: auto;
                            padding-left:20px;">
                    </div>
                    <p>الوصف</p>
                    <textarea name="college_description" id="editor1">
                        <?php 
                            if (!isset($_POST['edit_id'])){echo "";}else{echo  $row['college_description'];}
                        ?>
                    </textarea>
                    <div class="space"></div>
                    <div class="btn-row">
                    <input type="file" name="colleges_images" class="file-btn" id="upload-input" accept="image/*"
                            onchange="displayImage()">
                    <input type="button" class="file-btn" value="تغير شعار الكلية"
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