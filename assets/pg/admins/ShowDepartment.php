<?php
session_start();
require_once("inc/conn.inc.php");

if (isset($_SESSION["admin_user"])) {
    if (
        $_SESSION["admin_user"] != "Admin"
        && $_SESSION["admin_user"] != "SubAdmin"
        && $_SESSION["admin_user"] != "department"
        && $_SESSION["admin_user"] != "college"
    ){
        header("Location: login");
        exit();
    }
}else {
    header("Location: login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بوصلة التعليم الجامعي |  معلومات القسم</title>
    <link rel="stylesheet" href="style">
</head>
<body>
    <?php include 'inc/navbar.php'; ?>
    <div class="content">
        <?php include 'inc/sidebar.php'; ?>
        <div class="content-bar">
            <div style='position:relative; margin-top: 15px; '>
                <?php
                if ($_SESSION["admin_user"] == "department") {
                ?>

                    <button class="btn-style" onclick="window.open('edit_inf_departments' , '_self');">
                        <div class="Imgitem" style="background-image: url('E1');"></div>
                        تعديل معلومات القسم
                    </button>

                <?php } ?>
                <h2 style='text-align: center;font-size: 32px; font-weight: 550;'>معلومات القسم</h2>


                <div style='margin-top :50px;' class="path-bar">
                    <div class="url-path active-path">لوحة التحكم</div>
                    <div class="url-path slash">/</div>
                    <div class="url-path">الاقسام</div>
                    <div class="url-path slash">/</div>
                    <div class="url-path">معلومات القسم</div>
                </div>
            </div>
            <div class="shcont-prod">

                <div class="image-prod">
                    <?php

                    if (isset($_SESSION["admin_user"])) {

                        if ($_SESSION["admin_user"] == "department") {
                            $Show_id = $_SESSION["department_id"];
                        } else {
                            $Show_id = $_POST["Show_id"];
                        }
                    }

                    $sql = "SELECT departments.*, colleges.college_name, universities.university_name 
                            FROM departments
                            LEFT JOIN colleges ON departments.college_id = colleges.college_id 
                            LEFT JOIN universities ON colleges.university_id = universities.university_id 
                            WHERE department_id = $Show_id";


                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    ?>
                    <img style="width: 150px; pointer-events: none;" src="./assets/pg/admins/<?php echo $row['departments_img_path']; ?>">
                </div>
                <div class="prodation">
                    <div class="sh-name">
                        <h1> الجامعة : <?php echo $row['university_name']; ?></h1>
                        <h2> الكلية : <?php echo $row['college_name']; ?></h2>
                        <h3> القسم : <?php echo $row['department_name']; ?></h3>
                        <h4> معدل القبول الصباحي : <?php echo $row['required_GPA']; ?></h4>
                        <h4> معدل القبول المسائي : <?php if($row["evening_GPA"]==50){echo "لا يوجد";}else{ echo $row['evening_GPA'];} ?></h4>
                        <h4> قسط القبول المسائي : <?php if($row["evening_study_fees"]==0){echo "لا يوجد";}else{ echo number_format($row['evening_study_fees']) . " دينار عراقي";} ?></h4>
                        <h4> معدل القبول الموازي : <?php if($row["parallel_GPA"]==50){echo "لا يوجد";}else{ echo $row['parallel_GPA'];} ?></h4>
                        <h4> قسط القبول الموازي : <?php if($row["parallel_study_fees"]==0){echo "لا يوجد";}else{ echo number_format($row['parallel_study_fees']). " دينار عراقي";} ?></h4>
                    </div>
                </div>
            </div>
            <div class="cont-desc">

                <h3>نُبذة عن القسم</h3>

            </div>
            <div class="desc">
                <p><?php echo $row['department_description']; ?></p>
            </div>
            <div class="cont-desc">
                <h3>رسالة القسم</h3>
            </div>
            <div class="message">
                <p><?php echo $row['scientific_department_message']; ?></p>
            </div>
        </div>
    </div>

</body>

</html>