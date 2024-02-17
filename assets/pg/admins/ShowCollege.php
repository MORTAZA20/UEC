<?php
session_start();
require_once("inc/conn.inc.php");

if (isset($_SESSION["admin_user"])) {
if ($_SESSION["admin_user"] != "Admin" 
    && $_SESSION["admin_user"] != "SubAdmin"
    && $_SESSION["admin_user"] != "department"
    && $_SESSION["admin_user"] != "college") {
    header("Location: login");
    exit();
}
}else{
    header("Location: login");
    exit();
}

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
        if ($_SESSION["admin_user"] == "college"){ 

        ?>
        
        <button class="btn-style" onclick="window.open('edit_colleges' , '_self');"><div class="Imgitem" style="background-image: url('E1');"></div>
        تعديل معلومات الكلية</button>

        <?php } ?>
        <h2 style='text-align: center;font-size: 32px; font-weight: lighter;'>معلومات القسم</h2>
            
        
                <div style='margin-top :50px;' class="path-bar">
                    <div class="url-path active-path">لوحة التحكم</div>
                    <div class="url-path slash">/</div>
                    <div class="url-path">الكليات</div>
                    <div class="url-path slash">/</div>
                    <div class="url-path">معلومات الكلية</div>
                </div>
            </div>
            <div class="shcont-prod">

                <div class="image-prod">
                    <?php
                   
                    if (isset($_SESSION["admin_user"])){

                    if ($_SESSION["admin_user"] == "college" ){
                        $Show_id = $_SESSION["college"];
                    }
                    else {
                        $Show_id = $_POST["Show_id"];
                    }
                }
                    
                $sql = "SELECT colleges.*, universities.university_name 
                FROM colleges 
                LEFT JOIN universities ON colleges.university_id = universities.university_id 
                WHERE college_id = $Show_id";
        

                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();

                    ?>
                    <img style="width: 150px; pointer-events: none;"  src=./assets/pg/admins/<?php echo $row['colleges_img_path']; ?>>
                </div>
                <div class="prodation">
                    <div class="sh-name">
                        <h2> الجامعة : <?php echo $row['university_name']; ?></h2>
                        <h2> الكلية : <?php echo $row['college_name']; ?></h2>
                        <h3> معدل القبول الصباحي : <?php echo $row['required_GPA']; ?></h3>
                    </div>
                </div>

            </div>
            <div class="cont-desc">

                <h3>نُبذة عن الكلية</h3>

            </div>
            <div class="desc">
                <p><?php echo $row['college_description']; ?></p>
            </div>
            
        </div>
    </div>
    
</body>

</html>