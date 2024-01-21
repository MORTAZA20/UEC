
<?php
session_start();
if (isset($_SESSION["admin_user"])) {
if ($_SESSION["admin_user"] != "Admin" && $_SESSION["admin_user"] != "SubAdmin") {
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
<title>لوحة التحكم | تعديل الوظائف</title>
<link rel="stylesheet" href="style">
</head>

<body>

<?php include '../inc/navbar.php'; ?>

<div class="content">
    <?php include '../inc/sidebar.php'; ?>

    <div class="content-bar">
        <div style='position:relative; margin-top: 15px;'>
            <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>أضافة الوظائف</h2>
        </div>
        <div class="path-bar">
            <div class="url-path active-path">لوحة التحكم</div>
            <div class="url-path slash">/</div>
            <div class="url-path">الاقسام</div>
            <div class="url-path slash">/</div>
            <div class="url-path">تعديل معومات الوظائف</div>
        </div>
        <?php

        include '../inc/conn.inc.php';
        if (isset($_POST['btn_edit'])) {
            $edit_id = $_POST['edit_id']; 
            $sql = "SELECT cop.*, d.*, c.*, u.*
                FROM career_opportunities cop
                JOIN departments d ON cop.department_id = d.department_id
                JOIN colleges c ON d.college_id = c.college_id
                JOIN universities u ON c.university_id = u.university_id
                WHERE cop.opportunity_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $edit_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
        }
        if (isset($_POST["sub_form"])) {

            //mysqli_real_escape_string للحماية من الهجمات
            $opportunity_id = mysqli_real_escape_string($conn, $_POST["opportunity_id"]);
            $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
            $job_title = mysqli_real_escape_string($conn, $_POST["job_title"]);
            $salary_range = mysqli_real_escape_string($conn, $_POST["salary_range"]);
            $job_description = mysqli_real_escape_string($conn, $_POST["job_description"]);

            
                $sql = "SELECT * FROM career_opportunities WHERE opportunity_id =?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $opportunity_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if ($row['department_id'] == $department_id   
                &&  $row['job_title'] == $job_title
                &&  $row['salary_range'] == $salary_range
                &&  $row['job_description'] == $job_description) {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>لم يتم تحديث بيانات الوظيفة </div>";
                }else{
                    $sqlUP = "UPDATE career_opportunities SET department_id= ?, job_title= ?,salary_range= ?,job_description= ? WHERE opportunity_id= ?";
                    $stmt = $conn->prepare($sqlUP);
                    $stmt->bind_param("ssssi", $department_id, $job_title, $salary_range, $job_description, $opportunity_id);
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم تعديل الوظيفة بنجاح</div>";
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
                        }else{ echo $rec['university_id'] ;}?>" 
                                <?php 
                                   if (isset($_POST['edit_id'])) {
                                    if ($rec['university_id'] == $row['university_id']) { echo  "selected" ; } 
                                } 
                                ?>>
                                <?php if (!isset($_POST['edit_id'])) {
                            echo "";
                        }else{  echo $rec['university_name'] ;} ?></option>
                                    
                                    
                                <?php 
                                }
                            $conn->close();
                            ?>
                        </select>

                        <select id="college_id" class="fruit" name="college_id" onchange="getInf_departments()" required>
                        <option value="<?php if (!isset($_POST['edit_id'])) {
                            echo "";
                        }else{ echo $row['college_id'] ;}?>"> 
                        <?php if (!isset($_POST['edit_id'])) {
                            echo "";
                        }else{ echo $row['college_name'] ;} ?>
                        </option>
                        </select>
                        <select id="department_id" class="fruit" name="department_id" required>
                        <option value="<?php if (!isset($_POST['edit_id'])) {
                            echo "";
                        }else{ echo $row['department_id'] ;}?>"> 
                        <?php if (!isset($_POST['edit_id'])) {
                            echo "";
                        }else{ echo $row['department_name'] ;} ?>
                        </option>
                        </select>
                        </div>
                    </div>
                </div>

                <div class="custom-column" style="margin-bottom: 10px;">
                    <input type="hidden" name="opportunity_id" placeholder="معرف الوظيفة" value="<?php 
                                 if (!isset($_POST['edit_id'])){echo "";}else{echo $edit_id;}?>"required>
                    <input type="text" name="job_title" placeholder="العنوان الوظيفي" value="<?php 
                                 if (!isset($_POST['edit_id'])){echo "";}else{echo $row['job_title'];}?>"required>
                    <input type="text" name="salary_range" placeholder="مقدار الراتب" value="<?php 
                                 if (!isset($_POST['edit_id'])){echo "";}else{echo $row['salary_range'];}?>"required>
                </div>


                <p>نبذه عن المشروع</p>
                <textarea name="job_description" id="editor1" placeholder="الوصف"><?php 
                                 if (!isset($_POST['edit_id'])){echo "";}else{echo $row['job_description'];}?></textarea>

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
<script>
    setTimeout(function () {
        document.getElementById('success-message').style.display = 'none';
        window.location.href = 'career_opportunities';    
     }, 5000);

</script>

</body>

</html>