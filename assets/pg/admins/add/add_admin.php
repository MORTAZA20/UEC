<?php

session_start();
if (isset($_SESSION["admin_user"])) {
    if ($_SESSION["admin_user"] != "Admin" && $_SESSION["admin_user"] != "SubAdmin") {
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
    <title>لوحة التحكم | إضافة مشرف جديد</title>
    <link rel="stylesheet" href="style">
</head>

<body>
    <?php include '../inc/navbar.php'; ?>

    <div class="content">
        <?php include '../inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>إضافة مشرف جديد</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">المشرفين</div>
                <div class="url-path slash">/</div>
                <div class="url-path">إضافة مشرف جديد</div>
            </div>
            <?php
            include '../inc/conn.inc.php';

            if (isset($_POST["sub_form"])) {
                
                $AdminUserName = mysqli_real_escape_string($conn, $_POST["AdminUserName"]);
                $AdminPassword = mysqli_real_escape_string($conn, $_POST["AdminPassword"]);
                $type = mysqli_real_escape_string($conn, $_POST["type"]);
                $Gmail = mysqli_real_escape_string($conn, $_POST["Gmail"]);
                $timeTarget = 0.350; // 350 milliseconds
                $cost = 10;
                do {
                    $cost++;
                    $start = microtime(true);
                    $AdminPassword_hash = password_hash($AdminPassword, PASSWORD_BCRYPT, ["cost" => $cost]);
                    $end = microtime(true);
                } while (($end - $start) < $timeTarget);

                if ($type == "Admin" || $type == "SubAdmin") {
                    $sql = "INSERT INTO inf_login (AdminUserName, AdminPassword,type,Gmail) VALUES (?, ?, ?, ?)";
                } else if($type == "department") {
                    $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                    $sql = "INSERT INTO inf_login (department_id, AdminUserName, AdminPassword,type) VALUES (?, ?, ?, ?)";
                }else{
                    $college_id = mysqli_real_escape_string($conn, $_POST["college_id"]);
                    $sql = "INSERT INTO inf_login (college_id, AdminUserName, AdminPassword,type) VALUES (?, ?, ?, ?)";
                }

                $stmt = $conn->prepare($sql);
                if ($type == "Admin" && $type == "SubAdmin") { 
                    $stmt->bind_param("ssss", $AdminUserName, $AdminPassword_hash, $type,$Gmail);
                } else if($type == "department")  {
                    $stmt->bind_param("ssss", $department_id, $AdminUserName, $AdminPassword_hash, $type);
                }else{
                    $stmt->bind_param("ssss", $college_id, $AdminUserName, $AdminPassword_hash, $type);
                }

                $result = $stmt->execute();

                if ($result) {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم إضافة المشرف بنجاح</div>";
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
                    onchange="toggle()">
                        <option value="Admin">مشرف عام</option>
                        <option value="SubAdmin">مشرف ثانوي</option>
                        <option value="department">قسم</option>
                        <option value="college">كلية</option>
                    </select>
                    <select class="fruit" name="department_id" style=" margin-bottom: 10px ;" 
                    id="department_select">
                        <?php
                        include '../inc/conn.inc.php';
                        $sql1 = "SELECT d.*, c.college_name, u.university_name
                                FROM departments d
                                LEFT JOIN colleges c ON d.college_id = c.college_id
                                LEFT JOIN universities u ON c.university_id = u.university_id
                                WHERE d.department_id NOT IN (SELECT department_id FROM inf_login WHERE type = 'department')";

                        $result = $conn->query($sql1);
                        if($result->num_rows >0){
                            while ($row1 = $result->fetch_assoc()) {
                            echo "<option value='" . $row1['department_id'] . "'>" . $row1['university_name'] ." - " . $row1['college_name'] ." - ". $row1['department_name'] . "</option>";
                        }
                        }else{
                            echo "<option>لا توجد أقسام مضافه</option>";
                        }
                        
                        ?>
                    </select>
                    <select class="fruit" name="college_id" style=" margin-bottom: 10px ;" 
                    id="college_select">
                        <?php
                        include '../inc/conn.inc.php';
                        $sql2 = "SELECT  c.*, u.university_name
                                FROM colleges c
                                LEFT JOIN universities u ON c.university_id = u.university_id
                                WHERE c.college_id NOT IN (SELECT college_id FROM inf_login WHERE type = 'college')";

                        $result = $conn->query($sql2);
                        if($result->num_rows >0){
                            while ($row2 = $result->fetch_assoc()) {
                            echo "<option value='" . $row2['college_id'] . "'>" . $row2['university_name'] ." - " . $row2['college_name'] . "</option>";
                        }
                        }else{
                            echo "<option>لا توجد كليات مضافه</option>";
                        }
                        
                        ?>
                    </select>
                    
                    <input type="text" name="AdminUserName" placeholder="أسم المستخدم" style=" margin-bottom: 10px ;" required>
                    <input type="text" name="AdminPassword" placeholder="كلمة المرور" style=" margin-bottom: 10px ;" required>
                    <input type="email" name="Gmail" id="gmailField" placeholder="حساب الـ Gmail" style=" margin-bottom: 10px ;" >

                    <p>
                        <input class="seve" type="submit" name="sub_form" value=" حـفـظ البـيـانـات" />
                    </p>
                </form>
            </div>
        </div>
    </div>
    <script>
    function toggle() {
        var type = document.querySelector('select[name="type"]').value;
        var departmentSelect = document.getElementById('department_select');
        var collegeSelect = document.getElementById('college_select');
        var gmailField = document.getElementById('gmailField');

        if (type == "department") {
            departmentSelect.style.display = "block";
            collegeSelect.style.display = "none";
            gmailField.style.display = "none";
            departmentSelect.setAttribute("required", "required");
            collegeSelect.removeAttribute("required"); 
        } else if (type == "college") {
            departmentSelect.style.display = "none";
            collegeSelect.style.display = "block";
            gmailField.style.display = "none";
            departmentSelect.removeAttribute("required"); 
            collegeSelect.setAttribute("required", "required"); 
        } else {
            departmentSelect.style.display = "none";
            collegeSelect.style.display = "none";
            gmailField.style.display = "block";
            departmentSelect.removeAttribute("required");  
            collegeSelect.removeAttribute("required"); 
        }
    }
    setTimeout(function () {
        document.getElementById('success-message').style.display = 'none';
    }, 4000);
</script>


</body>

</html>