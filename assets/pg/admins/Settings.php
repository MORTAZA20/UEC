<?php

session_start();
if (isset($_SESSION["admin_user"])) {
    if ($_SESSION["admin_user"] != "Admin") {
    header("Location:login");
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
    <title>لوحة التحكم |اعدادات الموقع</title>
    <link rel="stylesheet" href="style">
</head>

<body>
    <?php include 'inc/navbar.php'; ?>

    <div class="content">
        <?php include 'inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>اعدادات الموقع</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">اعدادات الموقع</div>
             
            </div>
            <?php
            include 'inc/conn.inc.php';
            if (isset($_POST["sub_form"])) {
                $Off_And_On = mysqli_real_escape_string($conn, $_POST["Off_And_On"]);
                
                $id = 1;
                $sql = "UPDATE settings SET Off_And_On= ? WHERE id= ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si" , $Off_And_On ,$id);
                $stmt->execute();

                $result = $stmt->execute();

                if ($result) {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم تغير اعدادات الموقع بنجاح</div>";
                } else {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>هناك خطأ: " . $conn->error . "</div>";
                }

                $stmt->close();
            
            $conn->close();
            }
            ?>

            <div class="container-form">
                <form action="" method="post">
                    
                <select class="fruit" name="Off_And_On" style=" margin-bottom: 10px ;" required>
                    <option value="1" selected>تفعيل</option>
                    <option value="0">تعطيل</option>   
                </select>
                    
                    <p>
                        <input class="seve" type="submit" name="sub_form" value="حـفـظ اعدادات الموقع" />
                    </p>
                </form>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 4000);
    </script>
</body>

</html>