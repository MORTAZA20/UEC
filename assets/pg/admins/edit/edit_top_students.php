
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
    <title>لوحة التحكم | تعديل معلومات الطلبة الاوائل</title>
    <link rel="stylesheet" href="style">
</head>

<body>

    <?php include '../inc/navbar.php'; ?>

    <div class="content">
        <?php include '../inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>تعديل معلومات الطلبة الاوائل</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الاقسام</div>
                <div class="url-path slash">/</div>
                <div class="url-path">تعديل معلومات الطلبة الاوائل</div>
            </div>
            <?php

            include '../inc/conn.inc.php';

            if (isset($_POST["sub_form"])) {

                //mysqli_real_escape_string للحماية من الهجمات
                $student_id = mysqli_real_escape_string($conn, $_POST["Edit_student_id"]);
                $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                $student_name = mysqli_real_escape_string($conn, $_POST["student_name"]);
                $Graduation_Year = mysqli_real_escape_string($conn, $_POST["Graduation_Year"]);
                $Cumulative_Rating = mysqli_real_escape_string($conn, $_POST["Cumulative_Rating"]);

                $sql = "UPDATE top_students SET department_id = ?, student_name = ?, Cumulative_Rating = ?, 
                Graduation_Year = ? WHERE student_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $department_id, $student_name, $Cumulative_Rating, $Graduation_Year, $student_id);
                $stmt->execute();

                    if ($stmt->affected_rows > 0) {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم تعديل معلومات الطالب بنجاح</div>";
                    } else {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>هنالك خطأ: " . $conn->error . "</div>";
                    }
                }

                if (isset($_POST['btn_edit'])){
                    $top_studentsId = $_POST['edit_id'];
                }
              
                $sql = "SELECT * FROM top_students WHERE student_id =?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $top_studentsId);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
    
            ?>
            <script src="jquery-3.6.0.min"></script>
            <script src="Get_ScriptFunction.js"></script>

            <div class="container-form">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="container" style="margin-bottom: 10px;">
                        <div class="row align-items-start">
                            <div class="col custom-column">
                                <select id="university_id" class="fruit" name="university_id" onchange="getColleges()"
                                    required>
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
                                <select id="college_id" class="fruit" name="college_id" onchange="getInf_departments()"
                                    required>

                                </select>

                                <select id="department_id" class="fruit" name="department_id" required>

                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="hidden" name="Edit_student_id" placeholder="معرف الطالب"
                        value="<?php
                                 if (!isset($_POST['edit_id'])){echo "";}else{echo $top_studentsId;}?>">
                        <input type="text" name="student_name" placeholder="اسم الطالب"  
                        value="<?php
                                 if (!isset($_POST['edit_id'])){echo "";}else{echo $row['student_name'];}?>" required>
                        <input type="text" name="Cumulative_Rating" placeholder="المعدل التراكمي"
                        value="<?php
                                 if (!isset($_POST['edit_id'])){echo "";}else{echo $row['Cumulative_Rating'];}?>" required>
                        <input type="date" name="Graduation_Year" placeholder="سنة التخرج" 
                        value="<?php
                                 if (!isset($_POST['edit_id'])){echo "";}else{echo $row['Graduation_Year'];}?>" required>
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
    <script>
        setTimeout(function () {
            document.getElementById('success-message').style.display = 'none';
        }, 5000);
    </script>

</body>

</html>