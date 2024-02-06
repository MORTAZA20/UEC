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
            $sql = "SELECT Off_And_On FROM settings WHERE id = 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $Off_And_On_value = $row["Off_And_On"];
                $isChecked = $Off_And_On_value == 1 ? "checked" : "";
            }


            if (isset($_POST["sub_form"])) {
                $Off_And_On = isset($_POST["Off_And_On"]) && $_POST["Off_And_On"] === "on" ? 1 : 0;
                
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

            <div class="container-form" style="display: flex; justify-content: center;align-items: center;">
                <form action="" method="post">
                    <div class="toggleButton">
                        <input name="Off_And_On" class="toggleButton__checkbox" type="checkbox" id="toggle_1" <?php echo $isChecked ?>>
                        <label class="toggleButton__body" for="toggle_1"></label>
                    </div>
                    <p>
                        <input style="margin: 15px;" class="seve" type="submit" name="sub_form" value="حـفـظ اعدادات الموقع" />
                    </p>
                </form>
            </div>

        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('.container-form form');
        const toggleCheckbox = document.querySelector('.toggleButton__checkbox');

        form.addEventListener('submit', function (event) {
            const valueToSend = toggleCheckbox.checked ? 1 : 0;
            document.querySelector('input[name="Off_And_On"]').checked = toggleCheckbox.checked;
        });
    });
</script>

    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 4000);
    </script>
</body>

</html>