<?php
session_start();
if (isset($_SESSION["admin_user"])) {
    if (
        $_SESSION["admin_user"] != "Admin"
        && $_SESSION["admin_user"] != "SubAdmin"
        && $_SESSION["admin_user"] != "department"
    ) {


        header("Location: login");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | تعديل معلومات الاقسام</title>
    <link rel="stylesheet" href="style">
</head>

<body>
    <?php include '../inc/navbar.php'; ?>

    <div class="content">
        <?php include '../inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: 550;'>تعديل معلومات القسم</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الاقسام</div>
                <div class="url-path slash">/</div>
                <div class="url-path">تعديل معلومات القسم</div>
            </div>
            <?php

            include '../inc/conn.inc.php';

            if (isset($_POST['btn_edit'])) {
                $Edit_id = $_POST['edit_id'];
            }
            if ($_SESSION["admin_user"] == "department") {
                $Edit_id = $_SESSION["department_id"];
            }


            $sql = "SELECT d.*, c.college_id, c.university_id,c.college_name, u.university_name
                FROM departments d
                JOIN colleges c ON d.college_id = c.college_id
                JOIN universities u ON c.university_id = u.university_id
                WHERE d.department_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $Edit_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if (isset($_POST["sub_form"])) {

                //mysqli_real_escape_string للحماية من الهجمات
                $college_id = mysqli_real_escape_string($conn, $_POST["college_id"]);
                $department_id = mysqli_real_escape_string($conn, $_POST["Edit_department_id"]);
                $department_name = mysqli_real_escape_string($conn, $_POST["department_name"]);
                $department_description = mysqli_real_escape_string($conn, $_POST["department_description"]);
                $department_description  = str_replace(array("\r\n", "\\r\\n"), '', $department_description);
                $scientific_department_message = mysqli_real_escape_string($conn, $_POST["scientific_department_message"]);
                $scientific_department_message  = str_replace(array("\r\n", "\\r\\n"), '', $scientific_department_message);
                $required_GPA = mysqli_real_escape_string($conn, $_POST["required_GPA"]);
                $evening_GPA = mysqli_real_escape_string($conn, $_POST["evening_GPA"]);
                $evening_study_fees = mysqli_real_escape_string($conn, $_POST["evening_study_fees"]);
                $parallel_GPA = mysqli_real_escape_string($conn, $_POST["parallel_GPA"]);
                $parallel_study_fees = mysqli_real_escape_string($conn, $_POST["parallel_study_fees"]);



                $sql = "SELECT * FROM departments WHERE department_id =?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $department_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if (
                    empty($_FILES["departments_images"]["name"])
                    && $row['college_id'] == $college_id
                    && $row['department_name'] == $department_name
                    && $row['department_description'] == $department_description
                    && $row['scientific_department_message'] == $scientific_department_message
                    && $row['evening_GPA'] == $evening_GPA
                    && $row['required_GPA'] == $required_GPA
                    && $row['evening_study_fees'] == $evening_study_fees
                    && $row['parallel_GPA'] == $parallel_GPA
                    && $row['parallel_study_fees'] == $parallel_study_fees
                ) {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>لم يتم تحديث بيانات القسم </div>";
                } else {
                    if (!empty($_FILES["departments_images"]["name"])) {
                        unlink("../" . $row['departments_img_path']);

                        $departments_folder = '../departments_img';
                        $departments_images = $_FILES["departments_images"]["tmp_name"];
                        $file_name = $_FILES["departments_images"]["name"];
                        move_uploaded_file($departments_images, $departments_folder . '/' . $file_name);
                        $image_path = 'departments_img' . '/' . $file_name;
                    } else {
                        $image_path = $row['departments_img_path'];
                    }
                    $sql = "UPDATE departments SET college_id = ?, department_name = ?, department_description = ?, 
                    scientific_department_message = ?, required_GPA = ?, evening_GPA = ?, evening_study_fees = ?, 
                    parallel_GPA = ?, parallel_study_fees = ?, departments_img_path = ? WHERE department_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param(
                        "ssssssssssi",
                        $college_id,
                        $department_name,
                        $department_description,
                        $scientific_department_message,
                        $required_GPA,
                        $evening_GPA,
                        $evening_study_fees,
                        $parallel_GPA,
                        $parallel_study_fees,
                        $image_path,
                        $department_id
                    );

                    $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم تعديل معلومات القسم بنجاح</div>";
                    } else {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>هنالك خطأ: " . $conn->error . "</div>";
                    }
                }
            }
            $conn->close();
            ?>
            <script src="jquery-3.6.0.min"></script>
            <script src="Get_ScriptFunction"></script>
            <div class="container-form">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="custom-column" style="margin-bottom: 10px;">
                        <select id="university_id" class="fruit" name="university_id" onchange="getColleges()">
                            <?php
                            include '../inc/conn.inc.php';
                            $sql = "SELECT university_id, university_name FROM universities";
                            $result = $conn->query($sql);
                            while ($rec = $result->fetch_assoc()) {
                            ?>
                                <option value="<?php if (!isset($_POST['edit_id'])) {
                                                    echo "";
                                                } else {
                                                    echo $rec['university_id'];
                                                } ?>" <?php
                                                        if (isset($_POST['edit_id'])) {
                                                            if ($rec['university_id'] == $row['university_id']) {
                                                                echo  "selected";
                                                            }
                                                        }
                                                        ?>>
                                    <?php if (!isset($_POST['edit_id'])) {
                                        echo "";
                                    } else {
                                        echo $rec['university_name'];
                                    } ?></option>

                            <?php
                            }
                            $conn->close();
                            ?>
                        </select>
                        <select id="college_id" class="fruit" name="college_id">
                            <option value="<?php if (!isset($_POST['edit_id']) && !isset($_SESSION["admin_user"])) {
                                                echo "";
                                            } else {
                                                echo $row['college_id'];
                                            } ?>">
                                <?php if (!isset($_POST['edit_id'])) {
                                    echo "";
                                } else {
                                    echo $row['college_name'];
                                } ?>
                            </option>
                            <?php
                            if ($_SESSION["admin_user"] == "department") {
                                echo "<option value='" . $row['college_id'] . "' selected></option>";
                            } ?>
                        </select>

                        <input type="hidden" name="Edit_department_id" placeholder="معرف القسم" value="<?php if (!isset($_POST['edit_id']) && !isset($_SESSION["admin_user"])) {
                                                                                                            echo "";
                                                                                                        } else {
                                                                                                            echo  $Edit_id;
                                                                                                        } ?>">
                    </div>

                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="text" name="department_name" id="" placeholder="اسم القسم" value="<?php if (!isset($_POST['edit_id']) && !isset($_SESSION["admin_user"])) {
                                                                                                            echo "";
                                                                                                        } else {
                                                                                                            echo $row['department_name'];
                                                                                                        } ?>" required>

                        <input type="text" name="evening_GPA" placeholder="معدل القبول المسائي" value="<?php if (!isset($_POST['edit_id']) && !isset($_SESSION["admin_user"])) {
                                                                                                            echo "";
                                                                                                        } else {
                                                                                                            echo $row['evening_GPA'];
                                                                                                        } ?>" required pattern="^(?:[5-9]\d|\d{2})(?:\.\d+)?$" title="الرجاء إدخال قيمة صحيحة بين 50 و 100">
                        <input type="text" name="parallel_GPA" placeholder="معدل القبول الموازي" value="<?php if (!isset($_POST['edit_id']) && !isset($_SESSION["admin_user"])) {
                                                                                                            echo "";
                                                                                                        } else {
                                                                                                            echo $row['parallel_GPA'];
                                                                                                        } ?>" required pattern="^(?:[5-9]\d|\d{2})(?:\.\d+)?$" title="الرجاء إدخال قيمة صحيحة بين 50 و 100">
                    </div>

                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="text" name="required_GPA" id="" placeholder="معدل القبول الصباحي" value="<?php if (!isset($_POST['edit_id']) && !isset($_SESSION["admin_user"])) {
                                                                                                                    echo "";
                                                                                                                } else {
                                                                                                                    echo $row['required_GPA'];
                                                                                                                } ?>" required pattern="^(?:[5-9]\d|\d{2})(?:\.\d+)?$" title="الرجاء إدخال قيمة صحيحة بين 50 و 100">
                        <input type="number" name="evening_study_fees" placeholder="القسط السنوي(المسائي)" value="<?php if (!isset($_POST['edit_id']) && !isset($_SESSION["admin_user"])) {
                                                                                                                        echo "";
                                                                                                                    } else {
                                                                                                                        echo $row['evening_study_fees'];
                                                                                                                    } ?>" required>

                        <input type="number" name="parallel_study_fees" placeholder="القسط السنوي(الموازي)" value="<?php if (!isset($_POST['edit_id']) && !isset($_SESSION["admin_user"])) {
                                                                                                                        echo "";
                                                                                                                    } else {
                                                                                                                        echo $row['parallel_study_fees'];
                                                                                                                    } ?>" required>
                    </div>

                    <br>
                    <p>نبذة القسم</p>
                    <textarea name="department_description" id="editor" placeholder="نبذه عن القسم">
                        <?php if (!isset($_POST['edit_id']) && !isset($_SESSION["admin_user"])) {
                            echo "";
                        } else {
                            echo $row['department_description'];
                        } ?></textarea>

                    <p>رسالة القسم</p>
                    <textarea name="scientific_department_message" id="editor1" placeholder="رسالة القسم">
                        <?php if (!isset($_POST['edit_id']) && !isset($_SESSION["admin_user"])) {
                            echo "";
                        } else {
                            echo $row['scientific_department_message'];
                        } ?></textarea>
                    <script src=".\assets\pg\admins\ckeditor\js\index.js"></script>
                    <script>
                        ClassicEditor
                            .create(document.querySelector('#editor'), {
                                language: 'ar',
                                uiLanguage: 'ar'
                            })
                            .catch(error => {
                                console.error(error);
                            });
                            ClassicEditor
                            .create(document.querySelector('#editor1'), {
                                language: 'ar',
                                uiLanguage: 'ar'
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    </script>
                    <div class="container-img">
                        <img id="uploaded-image" src="assets/pg/admins/<?php echo $row["departments_img_path"]; ?>" style="max-width: 80px;
                            max-height: 80px;
                            width: auto;
                            height: auto;
                            padding-left:20px;">
                    </div>
                    <div class="space"></div>
                    <div class="btn-row">

                        <input type="file" name="departments_images" class="file-btn" id="upload-input" accept="image/*" onchange="displayImage()">
                        <input type="button" class="file-btn" value="اختيار شعار القسم" onclick="document.getElementById('upload-input').click();">
                        <p>
                            <input type="submit" name="sub_form" value="حـفـظ الـبـيـانـات" />
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if ($_SESSION["admin_user"] == "department") { ?>
        <style>
            #university_id,
            #college_id {
                display: none;
            }
        </style>
    <?php } ?>
    <script src="displayImage"></script>
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
            <?php
            if ($_SESSION["admin_user"] == "department") { ?>
                window.location.href = 'ShowDepartment';
            <?php } else { ?>
                window.location.href = 'inf_departments';
            <?php
            }
            ?>
        }, 4000);
    </script>
</body>

</html>