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
    <title>لوحة التحكم | تعديل المواد الدراسية </title>
    <link href="./assets/fontawesome-free-6.5.1-web/css/fontawesome.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/brands.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="style">
</head>

<body>

    <?php include '../inc/navbar.php'; ?>

    <div class="content">
        <?php include '../inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: 550;'>تعديل المواد الدراسية</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الاقسام</div>
                <div class="url-path slash">/</div>
                <div class="url-path">تعديل المواد الدراسية</div>
            </div>
            <?php

            include '../inc/conn.inc.php';

            if (isset($_POST['btn_edit'])) {
                $edit_id = $_POST['edit_id'];

                $sql = "SELECT co.*, d.*, c.*, u.*
                FROM courses co
                JOIN departments d ON co.department_id = d.department_id
                JOIN colleges c ON d.college_id = c.college_id
                JOIN universities u ON c.university_id = u.university_id
                WHERE co.course_id = ?";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $edit_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
            }
            if (isset($_POST["sub_form"])) {

                //mysqli_real_escape_string للحماية من الهجمات
                $course_id = mysqli_real_escape_string($conn, $_POST["course_id"]);
                $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                $course_name = mysqli_real_escape_string($conn, $_POST["course_name"]);
                $course_stage = mysqli_real_escape_string($conn, $_POST["course_stage"]);
                $course_description = mysqli_real_escape_string($conn, $_POST["course_description"]);
                $course_description  = str_replace(array("\r\n", "\\r\\n"), '', $course_description);



                $sql = "SELECT * FROM courses WHERE course_id =?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $course_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if (
                    $row['department_id'] == $department_id
                    &&  $row['course_name'] == $course_name
                    &&  $row['course_stage'] == $course_stage
                    &&  $row['course_description'] == $course_description
                ) {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>لم يتم تحديث بيانات المادة </div>";
                } else {
                    $sqlUP_courses = "UPDATE courses SET department_id= ? ,course_name = ?,course_stage= ?,course_description= ? WHERE course_id = ?";
                    $stmt = $conn->prepare($sqlUP_courses);
                    $stmt->bind_param("ssssi", $department_id, $course_name, $course_stage, $course_description, $course_id);
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم تعديل معلومات المادة الدراسية بنجاح</div>";
                    } else {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>هنالك خطأ: " . $conn->error . "</div>";
                    }
                }
            }
            ?>
            <script src="jquery-3.6.0.min"></script>
            <script src="Get_ScriptFunction"></script>

            <div class="container-form">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="container" style="margin-bottom: 10px;">
                        <div class="row align-items-start">
                            <div class="col custom-column">
                                <select id="university_id" class="fruit" name="university_id" onchange="getColleges()" required>
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
                                <select id="college_id" class="fruit" name="college_id" onchange="getInf_departments()" required>
                                    <option value="<?php if (!isset($_POST['edit_id']) || !isset($_SESSION["admin_user"])) {
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
                                </select>
                                <select id="department_id" class="fruit" name="department_id" required>
                                    <option value="<?php if (!isset($_POST['edit_id']) || !isset($_SESSION["admin_user"])) {
                                                        echo "";
                                                    } else {
                                                        echo $row['department_id'];
                                                    } ?>">
                                        <?php if (!isset($_POST['edit_id']) || !isset($_SESSION["admin_user"])) {
                                            echo "";
                                        } else {
                                            echo $row['department_name'];
                                        } ?>
                                        <?php
                                        if ($_SESSION["admin_user"] == "department") {
                                            echo "<option value='" . $_SESSION["department_id"] . "' selected></option>";
                                        } ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="hidden" name="course_id" placeholder="معرف المادة" value="<?php
                                                                                                if (!isset($_POST['edit_id'])) {
                                                                                                    echo "";
                                                                                                } else {
                                                                                                    echo $edit_id;
                                                                                                } ?>" required>
                        <input type="text" name="course_name" placeholder="اسم المادة" value="<?php if (!isset($_POST['edit_id']) || !isset($_SESSION["admin_user"])) {
                                                                                                    echo "";
                                                                                                } else {
                                                                                                    echo $row['course_name'];
                                                                                                } ?>" required>
                        <select id="fruit" name="course_stage" class="fruit" required>
                            <option value="1" <?php if ($row['course_stage'] == 1) echo "selected"; ?>>المرحلة الاولى</option>
                            <option value="2" <?php if ($row['course_stage'] == 2) echo "selected"; ?>>المرحلة الثانية</option>
                            <option value="3" <?php if ($row['course_stage'] == 3) echo "selected"; ?>>المرحلة الثالثة</option>
                            <option value="4" <?php if ($row['course_stage'] == 4) echo "selected"; ?>>المرحلة الرابعة</option>
                            <option value="5" <?php if ($row['course_stage'] == 5) echo "selected"; ?>>المرحلة الخامسة</option>
                            <option value="6" <?php if ($row['course_stage'] == 6) echo "selected"; ?>>المرحلة السادسة</option>
                        </select>

                    </div>

                    <p>نبذه عن المادة</p>
                    <textarea name="course_description" id="editor" placeholder="النبذه عن المادة">
                        <?php if (!isset($_POST['edit_id'])) {
                            echo "";
                        } else {
                            echo $row['course_description'];
                        } ?>
                    </textarea>
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
                    </script>
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
    <?php if ($_SESSION["admin_user"] == "department") { ?>
        <style>
            #university_id,
            #college_id,
            #department_id {
                display: none;
            }
        </style>
    <?php } ?>
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
            window.location.href = 'courses';
        }, 4000);
    </script>

</body>

</html>