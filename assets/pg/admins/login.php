
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

                $stmt = $conn->prepare("SELECT * FROM inf_login WHERE AdminUserName=?");
                $stmt->bind_param("s", $user_login);
                $stmt->execute();
                $result = $stmt->get_result();

            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();
                if(password_verify("$pass_login", $row["AdminPassword"])) {
                
                $type = $row["type"];
                $department_id = $row['department_id'];
                if ($type == "Admin" || $type == "SubAdmin" ) {
                    
                    session_start();
                    $_SESSION["admin_user"] = $type ;
                    header("Location: home");
                }else{
                    session_start();
                    $_SESSION["admin_user"] = $type;
                    $_SESSION["department_id"] = $department_id ;
                    header("Location: ShowDepartment");
                }

            }}    
            else {
                  echo "<div style='color: red; font-size: 18px; font-weight: 500; text-align: center;'>المعلومات التي ادخلت غير صحيحة</div>";
            }
        }
           
        
        $conn->close();
        
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