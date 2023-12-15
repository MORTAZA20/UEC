<?php

require_once("inc/conn.inc.php");

session_start();

if (isset($_SESSION["admin_user"])) {
    header("Location: home");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بوصلة التعليم الجامعي |  تسجيل الدخول</title>
    <link rel="stylesheet" href="style">
</head>
<body style="background-color: #333; color: white; background-image: url('bg11'); background-size: cover; background-repeat: no-repeat;">
    <div class="login-box">
        <div class="login-title">تسجيل الدخول</div>
        <?php

        if (isset($_POST["sub_log"])) {
            $user_login = htmlspecialchars($_POST["user_log"]);
            $pass_login = htmlspecialchars($_POST["pass_log"]);

            $sql = "SELECT * FROM login_credentials WHERE id='1'";
            $result = $conn->query($sql);

            $row = $result->fetch_assoc();

            $admin_user = $row["AdminUserName"];
            $admin_pass = $row["AdminPassword"];

            if (empty($user_login) || empty($pass_login)) {
                echo "<div style='color: red; font-size: 18px; font-weight: 500; text-align: center;'>المرجوا ملئ الفراغات</div>";
            }
            else {
                if ($user_login !== $admin_user || $pass_login !== $admin_pass) {
                    echo "<div style='color: red; font-size: 18px; font-weight: 500; text-align: center;'>المعلومات التي ادخلت غير صحيحة</div>";
                }
                else {
                    $_SESSION["admin_user"] = $user_login;
                    header("Location: home");
                }
            }
        }
        
        ?>

        <div class="login-form">
            <form action="" method="post">
                <input type="text" name="user_log" placeholder="إسم المستخدم" required>
                <input type="password" name="pass_log"  placeholder="كلمة المرور" required>
                <input type="submit" name="sub_log" value="دخول">
            </form>
        </div>
    </div>
</body>
</html>