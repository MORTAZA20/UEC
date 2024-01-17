<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | تعديل معلومات أدمن</title>
    <link rel="stylesheet" href="style">
</head>

<body>
    <?php include '../inc/navbar.php'; ?>

    <div class="content">
        <?php include '../inc/sidebar.php'; ?>

        <div class="content-bar">
            <div style='position:relative; margin-top: 15px;'>
                <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>تعديل معلومات الادمن</h2>
            </div>
            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الادمنية</div>
                <div class="url-path slash">/</div>
                <div class="url-path">تعديل معلومات الادمن</div>
            </div>
            <?php
            include '../inc/conn.inc.php';
            
            if (isset($_POST["sub_form"])) {
                $Edit_Admin_id = mysqli_real_escape_string($conn, $_POST["Edit_id"]);
                $department_id = mysqli_real_escape_string($conn, $_POST["department_id"]);
                $AdminUserName = mysqli_real_escape_string($conn, $_POST["UserName"]);
                $AdminPassword = mysqli_real_escape_string($conn, $_POST["Password"]);

                $sqlUP_login_credentials = "UPDATE inf_login SET department_id = '$department_id', AdminUserName = '$AdminUserName', AdminPassword = '$AdminPassword' WHERE Admin_id = '$Edit_Admin_id'";
                $result_sqlUP_login_credentials = $conn->query($sqlUP_login_credentials);

                if ($result_sqlUP_login_credentials) {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px;'>تم تعديل معلومات الادمن بنجاح</div>";
                } else {
                    echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>هناك خطأ: " . $conn->error . "</div>";
                }
            }
    

            if (isset($_POST['btn_edit'])) {
                $edit_id = $_POST['edit_id'];

                $sql_inf_login = "SELECT * FROM inf_login WHERE Admin_id =?";
                $stmt = $conn->prepare($sql_inf_login);
                $stmt->bind_param("i", $edit_id);
                $stmt->execute();
                $result_sql_inf_login = $stmt->get_result();
                $row = $result_sql_inf_login->fetch_assoc();
            }
            $conn->close();
            ?>


            <div class="container-form">
                <form action="" method="post">
                    <select class="fruit" name="department_id" style=" margin-bottom: 10px ;" required>

                        <option value="">ادمن عام</option>
                        <?php
                        include '../inc/conn.inc.php';
                        $sql_department = "SELECT department_id, department_name FROM departments";
                        $result_sql_department = $conn->query($sql_department);

                        if ($result_sql_department->num_rows > 0) { // تحقق من وجود السجلات
                            while ($rec = $result_sql_department->fetch_assoc()) {
                                echo "<option value='" . $rec['department_id'] . "'>" . $rec['department_name'] . "</option>";
                            }
                        } else {
                            echo "<option value='' disabled selected>لا توجد أقسام مضافة</option>";
                        }

                        $conn->close();
                        ?>
                    </select>
                    <input type="hidden" name="Edit_id" value="<?php if (!isset($_POST['edit_id'])) {
                                                                    echo "";
                                                                } else {
                                                                    echo $Edit_id;
                                                                } ?>" required>
                    <input type="text" name="UserName" placeholder="أسم المستخدم" style=" margin-bottom: 10px ;" value="<?php if (!isset($_POST['edit_id'])) {
                                                                                                                            echo "";
                                                                                                                        } else {
                                                                                                                            echo $row['AdminUserName'];
                                                                                                                        } ?>" required>
                    <input type="text" name="Password" placeholder="كلمة المرور" style=" margin-bottom: 10px ;" value="<?php if (!isset($_POST['edit_id'])) {
                                                                                                                            echo "";
                                                                                                                        } else {
                                                                                                                            echo $row['AdminPassword'];
                                                                                                                        } ?>" required>
                    <p>
                        <input class="seve" type="submit" name="sub_form" value=" حـفـظ البـيـانـات" />
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