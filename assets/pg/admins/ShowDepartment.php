<?php
session_start();
require_once("inc/conn.inc.php");



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>بوصلة التعليم الجامعي | لوحة التحكم</title>

    <link rel="stylesheet" href="style">
</head>

<body>

    <?php include 'inc/navbar.php'; ?>

    <div class="content">
        <?php include 'inc/sidebar.php'; ?>

        <div class="content-bar">
        <div style='position:relative; margin-top: 15px; '>
            
        <?php 
        if ($_SESSION["admin_user"] == "department"){ 

            ?>
        
<<<<<<< HEAD
        <button class="btn-style" onclick="window.open('edit_inf_departments' , '_self');"><div class="Imgitem" style="background-image: url('E1');"></div>
        تعديل معلومات القسم</button>
=======
        <button class="btn-style" onclick="window.open('edit_inf_departments' , '_self');">تعديل معلومات القسم</button>
>>>>>>> 6a535679d7b76ac0f95c22a795a77624e343050d
        <?php } ?>
        <h2 style='text-align: center;font-size: 32px; font-weight: lighter;'>معلومات القسم</h2>
            
        
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
                   
                    if (isset($_SESSION["admin_user"])){

                    if ($_SESSION["admin_user"] == "department" ){
                        $Show_id = $_SESSION["department_id"];
                    }
                    else {
                        $Show_id = $_POST["Show_id"];
                    }
                }
                    
                    $sql = "SELECT departments.*, colleges.college_name FROM departments
                            LEFT JOIN colleges ON departments.college_id = colleges.college_id WHERE department_id = $Show_id";

                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    ?>
                    <img style="width: 150px;"  src=./assets/pg/admins/<?php echo $row['departments_img_path']; ?>>
                </div>
                <div class="prodation">
                    <div class="sh-name">
                        <h2> الكلية : <?php echo $row['college_name']; ?></h2>
                        <h2> القسم : <?php echo $row['department_name']; ?></h2>
                        <h4> معدل القبول الصباحي : <?php echo $row['required_GPA']; ?></h4>
                        <h4> معدل القبول المسائي : <?php echo $row['evening_GPA']; ?></h4>
                        <h4> قسط القبول المسائي : <?php echo $row['evening_study_fees']; ?></h4>
                        <h4> معدل القبول الموازي : <?php echo $row['parallel_GPA']; ?></h4>
                        <h4> قسط القبول الموازي : <?php echo $row['parallel_study_fees']; ?></h4>
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