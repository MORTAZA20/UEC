<?php

session_start();
if (isset($_SESSION["admin_user"])) {
    if ($_SESSION["admin_user"] != "Admin" && $_SESSION["admin_user"] != "SubAdmin") {
    header("Location:login");
    exit();
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | إضافة أدمن جديد</title>
    <link rel="stylesheet" href="style">
</head>

<body>
    <?php include '../inc/navbar.php'; ?>

    <div class="content">
        <?php include '../inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>إضافة أدمن جديد</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الادمنية</div>
                <div class="url-path slash">/</div>
                <div class="url-path">إضافة أدمن جديد</div>
            </div>
            <?php
            include '../inc/conn.inc.php';

            if (isset($_POST["sub_form"])) {
                
                $AdminUserName = mysqli_real_escape_string($conn, $_POST["AdminUserName"]);
                $AdminPassword = mysqli_real_escape_string($conn, $_POST["AdminPassword"]);
                $type = mysqli_real_escape_string($conn, $_POST["type"]);
                $timeTarget = 0.350; // 350 milliseconds
                $cost = 10;
                do {
                    $cost++;
                    $start = microtime(true);
                    $AdminPassword_hash = password_hash($AdminPassword, PASSWORD_BCRYPT, ["cost" => $cost]);
                    $end = microtime(true);
                } while (($end - $start) < $timeTarget);

                if ($type == "Admin" || $type == "SubAdmin") {
                    $sql = "INSERT INTO inf_login (AdminUserName, AdminPassword,type) VALUES (?, ?, ?)";
                } else {
                    $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                    $sql = "INSERT INTO inf_login (department_id, AdminUserName, AdminPassword,type) VALUES (?, ?, ?, ?)";
                }

                $stmt = $conn->prepare($sql);
                if ($type != "Admin" && $type != "SubAdmin") {
                    $stmt->bind_param("ssss", $department_id, $AdminUserName, $AdminPassword_hash, $type);
                } else {
                    $stmt->bind_param("sss", $AdminUserName, $AdminPassword_hash, $type);
                }

                $result = $stmt->execute();

                if ($result) {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم إضافة الادمن بنجاح</div>";
                } else {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>هناك خطأ: " . $conn->error . "</div>";
                }

                $stmt->close();
            }
            $conn->close();
            ?>

            <div class="container-form">
                <form action="" method="post">
                    <select class="fruit" name="type" style=" margin-bottom: 10px ;" required
                    onchange="toggleDepartment()">
                        <option value="Admin">ادمن عام</option>
                        <option value="SubAdmin">ادمن فرعي</option>
                        <option value="department">قسم</option>
                    </select>
                    <select class="fruit" name="department_id" style=" margin-bottom: 10px ;" 
                    id="department_select">
                        <?php
                        include '../inc/conn.inc.php';
                        $sql_dep = "SELECT * FROM departments";
                        $result_sql_dep = $conn->query($sql_dep);
                        while ($row_dep = $result_sql_dep->fetch_assoc()) {
                            echo "<option value='" . $row_dep['department_id'] . "'>" . $row_dep['department_name'] . "</option>";
                        }
                        ?>
                    </select>
                    <input type="text" name="AdminUserName" placeholder="أسم المستخدم" style=" margin-bottom: 10px ;" required>
                    <input type="text" name="AdminPassword" placeholder="كلمة المرور" style=" margin-bottom: 10px ;" required>
                    <p>
                        <input class="seve" type="submit" name="sub_form" value=" حـفـظ البـيـانـات" />
                    </p>
                </form>
            </div>
        </div>
    </div>
    <script>
        function toggleDepartment() {
            var type = document.querySelector('select[name="type"]').value;

            if (type == "department") {
                document.getElementById('department_select').style.display = "block";
            } else {
                document.getElementById('department_select').style.display = "none";
            }
        }
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 5000);
    </script>
</body>

</html>