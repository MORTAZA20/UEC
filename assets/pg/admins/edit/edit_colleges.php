<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | تعديل الكليات</title>
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
                <div class="url-path">الكليات</div>
                <div class="url-path slash">/</div>
                <div class="url-path">تعديل الكلية</div>
            </div>

            <?php
            include '../inc/conn.inc.php';

            if (isset($_POST["sub_form"])) {

                $university_id = mysqli_real_escape_string($conn, $_POST["Edit_Universitie_id"]);
                $university_name = mysqli_real_escape_string($conn, $_POST["university_name"]);
                $university_location = mysqli_real_escape_string($conn, $_POST["university_location"]);
                $university_website = mysqli_real_escape_string($conn, $_POST["university_website"]);

                if ($_FILES['universities_images']['type'] == 'image/png' || $_FILES['universities_images']['type'] == 'image/jpeg') {
                    $universities_folder = '../universities_img';
                    if (!file_exists($universities_folder)) {
                        mkdir($universities_folder, 0777, true);
                        chmod($universities_folder, 0777);
                    }

                    $file_name = $_FILES["universities_images"]["name"];
                    $universities_images = $_FILES["universities_images"]["tmp_name"];
                    move_uploaded_file($universities_images, $universities_folder . '/' . $file_name);
                    $image_path = 'universities_img' . '/' . $file_name;

                    $sql = "UPDATE universities SET university_name = ?, university_location = ?, 
                    university_website = ?, universities_img_path = ? WHERE university_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssss", $university_name, $university_location, $university_website, $image_path, $university_id);
                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم تحديث بيانات الجامعة بنجاح</div>";
                    } else {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>حدث خطأ أثناء تحديث بيانات الجامعة: " . $stmt->error . "</div>";
                    }
                } else {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>يرجى تحديد ملف صورة صحيح (PNG أو JPEG)</div>";
                }
            }


            if (isset($_POST['edit_id'])) {
                $collegeId = $_POST['edit_id'];
            }
            // Get data from database for edit form
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
                                <select id="fruit" name="university_id" required>
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

                        <input type="hidden" name="Edit_college_id">
                        <input type="text" style="margin: 0px 10px;" name="college_name" id="row-2"
                            placeholder="اسم الكلية"  value="<?php if (!isset($_POST['edit_id'])){echo "";}else{ echo $row['college_name'];} ?>" required>
                        <input type="number" name="required_GPA" id="" placeholder="المعدل" value="<?php if (!isset($_POST['edit_id'])){echo "";}else{ echo $row['required_GPA'];} ?>" required>
                    </div>
                    <div class="container-img">
                            
                            <img src="assets/pg/admins/<?php echo $row["colleges_img_path"]; ?>" 
                            style="max-width: 80px;
                            max-height: 80px;
                            width: auto;
                            height: auto;
                            padding-left:20px;">
                    </div>

                    <p>الوصف</p>
                    <textarea name="editor1" id="editor1"><?php if (!isset($_POST['edit_id'])){echo "";}else{ echo $row['college_description'];} ?></textarea>
                    <div class="space"></div>
                    <div class="btn-row">
                        <input type="file" name="colleges_images" class="file-btn" id="files"
                            accept="image/png, image/jpeg">
                        <input type="button" class="file-btn" value="اختيار شعار الكلية"
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