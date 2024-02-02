<?php
require_once("inc/conn.inc.php");
if (isset($_POST["sub_log"])) {
    $user_login = htmlspecialchars($_POST["user_log"]);
    $pass_login = htmlspecialchars($_POST["pass_log"]);


    $timeTarget = 0.350; // 350 milliseconds
    $cost = 10;
    do {
        $cost++;
        $start = microtime(true);
        $AdminPassword_hash = password_hash($pass_login, PASSWORD_BCRYPT, ["cost" => $cost]);
        $end = microtime(true);
    } while (($end - $start) < $timeTarget);

    $stmt = $conn->prepare("SELECT inf_login.*
                FROM inf_login
                LEFT JOIN departments ON inf_login.department_id = departments.department_id
                WHERE inf_login.AdminUserName=?");


    $stmt->bind_param("s", $user_login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $Admin_id = $row["Admin_id"];
        date_default_timezone_set('Asia/Baghdad');
        $RegistrationData = date("Y-m-d");
        $RegistrationTime = date("g:i a");
        if (password_verify("$pass_login", $row["AdminPassword"])) {
            $sql_UPDATE = "UPDATE inf_login SET  RegistrationData = '$RegistrationData' , RegistrationTime = '$RegistrationTime' WHERE Admin_id = '$Admin_id'";
            $stmt_UPDATE = $conn->query($sql_UPDATE);
            $type = $row["type"];
            $department_id = $row['department_id'];



            if ($type == "Admin" || $type == "SubAdmin") {

                session_start();
                $_SESSION["admin_user"] = $type;
                header("Location: home");
            } else if ($type == "department") {
                session_start();
                echo $college_id;
                $_SESSION["admin_user"] = $type;
                $_SESSION["department_id"] = $department_id;
                header("Location: ShowDepartment");
            }
           
        }else {
            echo "<div id='success-message' style='color: red; font-size: 18px; font-weight: 500; text-align: center;'>كلمة المرور التي ادخلت غير صحيحة</div>";
        }

    } else {
        echo "<div id='success-message' style='color: red; font-size: 18px; font-weight: 500; text-align: center;'>أسم المستخدم الذي ادخل غير صحيح</div>";
    }
}


$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/0b13675ea3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <!-- custom css -->
    <link rel="stylesheet" href="./assets/pg/admins/css/stylelogin.css">
    <title>بوصلة التعليم الجامعي | تسجيل الدخول</title>

</head>

<body>
    <div class="login-form-cont">

        <form action="" method="post">
            <div class="img-logo"><img src="LOGO" alt=""></div>
            <span>أسم المستخدم</span>
            <input type="text" class="box" name="user_log" required>
            <span>كلمة المرور</span>
            <input type="password" class="box" name="pass_log" id="password" required>
            <div class="checkbox">
                <input type="checkbox" id="showPassword">
                <label for="checkbox">عرض كلمة المرور</label>
            </div>
            <button type="submit" name="sub_log" class="btn-active">تسجيل</button>
            <div class="hrsp">
                <hr><span>هل تواجهه بعض المشاكل؟</span>
                <hr>
            </div>

            <div class="login-resert">
                <p><a href="#">تواصل مع المشرف</a></p>
            </div>
        </form>
    </div>
    <script>
        setTimeout(function () {
            document.getElementById('success-message').style.display = 'none';
            
        }, 4000);
    </script>
    <script>
        const password = document.getElementById('password');
        const checkBox = document.getElementById('showPassword');
        checkBox.addEventListener('click', function() {
            if (this.checked) {
                password.type = 'text';
            } else {
                password.type = 'password';
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>