<?php
session_start();
if (isset($_SESSION["admin_user"])) {
    if (
        $_SESSION["admin_user"] != "Admin"
        && $_SESSION["admin_user"] != "SubAdmin"
        && $_SESSION["admin_user"] != "department"
        && $_SESSION["admin_user"] != "college"
    ) {
        header("Location: login");
        exit();
    }
} else {
    header("Location: login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | الدعم والمساعدة</title>
    <link rel="stylesheet" href="style">
</head>

<body>
    <?php include 'inc/navbar.php'; ?>

    <div class="content">
        <?php include 'inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: 550;'>الدعم والمساعدة</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الدعم والمساعدة</div>
            </div>
            <?php

            if (isset($_POST["sub_form"])) {
                $about = $_POST["about"];
                $email = $_POST["email"];
                $msg   = $_POST["msg"];
                $Name  = $_POST["Name"];

                require_once "mail.php";

                $mail->setFrom("$email", "$Name");
                $mail->addAddress('qqwwertyui488@gmail.com');
                $mail->Subject = "$about";

                $mailBody = "<html><body style='font-family: Arial, sans-serif; text-align: right;'>";
                $mailBody .= "<h2 style='color: #333; text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px;'>الدعم والمساعدة</h2>";
                $mailBody .= "<p style='font-size: 22px; color: #333;'><strong>الاسم: </strong> <span style='color: #333;'>$Name</span></p>";
                $mailBody .= "<p style='font-size: 22px; color: #333;'><strong><span style='font-size: 18px; color: #333;'>$email</span> : البريد الإلكتروني</strong> </p>";
                $mailBody .= "<p style='font-size: 22px; color: #333;'><strong>عنوان الرسالة: </strong> <span style='color: #333;'>$about</span></p>";
                $mailBody .= "<p style='font-size: 22px; color: #333;'><strong> : الرسالة</strong></p>";
                $mailBody .= "<strong style='font-size: 22px; color: #333;'>$msg</strong>";
                $mailBody .= "</body></html>";

                $mail->Body = $mailBody;


                if (!empty($_FILES["file"]["name"])) {
                    move_uploaded_file($_FILES["file"]["tmp_name"], $_FILES["file"]["name"]);
                    $mail->addAttachment($_FILES["file"]["name"]);
                } else {
                    $mail->send();
                }



                if (!$mail->send()) {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>لم يتم ارسال الرساله هنالك خطأ</div>";
                } else {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم ارسال الرساله بنجاح</div>";
                    if (!empty($_FILES["file"]["name"])) {
                        unlink($_FILES["file"]["name"]);
                    }
                }
            }


            ?>


            <div class="container-form">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="custom-column" style="margin-bottom: 10px;">
                        <input type="text" name="Name" placeholder="أسم المرسل" style=" margin-bottom: 10px ;" required>
                        <input type="text" name="about" placeholder="عنوان الرسالة" style=" margin-bottom: 10px ;" required>
                        <input type="text" name="email" placeholder="حساب  Gmail" style=" margin-bottom: 10px ;" required>
                    </div>
                    <p>الرسالة</p>
                    <textarea name="msg" id="editor"></textarea>
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
                    <div class="container-img">
                        <img id="uploaded-image" src="#" style="max-width: 100px;
                                max-height: 100px;
                                width: auto;
                                height: auto;
                                padding-left:20px;">
                    </div>
                    <div class="space"></div>
                    <div class="btn-row">
                        <input type="file" name="file" class="file-btn" id="upload-input" accept="image/*" onchange="displayImage()">
                        <input type="button" class="file-btn" value="صورة المشكلة" onclick="document.getElementById('upload-input').click();">

                        <p>
                            <input class="seve" type="submit" name="sub_form" value="أرســال الأيــمــيــل" />
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="displayImage"></script>
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 5000);
    </script>

</body>

</html>