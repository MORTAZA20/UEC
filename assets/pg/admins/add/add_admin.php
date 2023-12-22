<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | إضافة أدمن جديد</title>
    <link rel="stylesheet" href="style">
</head>
<body>
<?php    include '../inc/navbar.php';?>

    <div class="content">
    <?php  include '../inc/sidebar.php';?>

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
                    
                    $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                    $AdminUserName = mysqli_real_escape_string($conn, $_POST["AdminUserName"]);
                    $AdminPassword = mysqli_real_escape_string($conn, $_POST["AdminPassword"]);
                
                            $sql = "INSERT INTO login_credentials  (department_id, AdminUserName, AdminPassword) 
                            VALUES ('$department_id', '$AdminUserName', '$AdminPassword')";
                            $result = $conn->query($sql);
                            if ($result) {
                                echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم إضافة الادمن بنجاح</div>";
                            }else {
                                echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>هناك خطأ: " . $conn->error . "</div>";
                            }

                }

                        $conn->close();   
            ?>
    

            <div class="container-form">
            <form action="" method="post">
                <select class="fruit" name="department_id" style=" margin-bottom: 10px ;" required>
                    <?php
                    include '../inc/conn.inc.php';
                    $sql = "SELECT department_id, department_name FROM departments";
                    $result = $conn->query($sql);
        
                    if ($result->num_rows > 0) { // تحقق من وجود السجلات
                        while ($rec = $result->fetch_assoc()) {
                            echo "<option value='" . $rec['department_id'] . "'>" . $rec['department_name'] . "</option>";
                        }
                    } else {
                        echo "<option value='' disabled selected>لا توجد أقسام مضافة</option>";
                    }
                    
                    $conn->close();
                    ?>
                    </select>
                    <input type="text" name="AdminUserName" placeholder="أسم المستخدم" style=" margin-bottom: 10px ;"  required>
                    <input type="password" name="AdminPassword" placeholder="كلمة المرور" style=" margin-bottom: 10px ;" required>
                    <p>
                       <input  class="seve" type="submit" name ="sub_form" value=" حـفـظ البـيـانـات" />
                    </p>
                </form>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
        }, 5000);
    </script>
</body>
</html>