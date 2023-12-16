<?php
require_once("../inc/conn.inc.php");
session_start();

if (!$_SESSION["admin_user"]) {
    header("Location: login");
}

$delete_departments = $_POST["del_id"];



if (isset($_POST["dal_stm"]) && $_POST["dal_stm"] == "true") {
    try {
       
        $conn->autocommit(FALSE);
        //حذف جميع صور المشاريع المرتبطة بالقسم
        $sql = "SELECT * FROM student_projects WHERE department_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $delete_departments);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dirPath = '../'.$row["student_projects_img_path"];
                deleteDir($dirPath);
            }
        }
        //حذف صورة القسم
        $sql = "SELECT * FROM departments WHERE department_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $delete_departments);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $dirPath = '../'.$row["departments_img_path"];
        deleteDir($dirPath);


        // حذف الجداول المرتبطة بالأقسام
        $sql = "DELETE FROM student_projects WHERE department_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $delete_departments);
        $stmt->execute();

        $sql = "DELETE FROM career_opportunities WHERE department_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $delete_departments);
        $stmt->execute();

        $sql = "DELETE FROM courses WHERE department_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $delete_departments);
        $stmt->execute();

        $sql = "DELETE FROM top_students WHERE department_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $delete_departments);
        $stmt->execute();

        // حذف الأقسام
        $sql = "DELETE FROM departments WHERE department_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $delete_departments);
        $stmt->execute();


        $conn->commit();
        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px; justify-content: center; text-align: center; font-family: 'Tajawal', sans-serif;'>تم حذف الفسم بنجاح</div>";
        echo "<div style='justify-content: center; text-align: center;'>
                <a href='inf_departments' style='padding: 10px; color: #fff; font-size:18px; font-weight: 500; border-radius: 5px; background-color: #18bc9c; font-family: Tajawal, sans-serif; text-decoration: none;'>الرجوع الى صفحة معلومات الاقسام</a>
              </div>";

    } catch (Exception $e) {
        $conn->rollback();
        echo "حدث خطأ: " . $e->getMessage();
        echo "<div style='justify-content: center; text-align: center;'>
        <a href='inf_departments'  style='
            padding: 10px;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            border-radius: 5px;
            text-decoration: none;
            background-color: #5DC122;
            display: inline-block; 
            margin-top: 20px; 
        '>الرجوع الى صفحة الجامعات</a>
    </div>";
    } finally {
        $conn->autocommit(TRUE);
    }
    $conn->close();
} else {

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>لوحة التحكم | حذف معلومات الاقسام</title>
        <link rel="stylesheet" href="style">
    </head>

    <body>
        <div style="text-align: center; margin-top: 10%;">
            <h1>هل أنت متأكد أنك ترغب في حذف هذا القسم؟ (معرف القسم
                <?php echo $delete_departments ?>)
            </h1>
            <h2 style="padding: 10px;">
                <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
                    <form method="post" action="delete_inf_departments" style="margin:15px; ">
                        <input type="hidden" name="del_id" value="<?php echo $delete_departments ?>">
                        <input type="hidden" name="dal_stm" value="true">
                        <button type="submit" style="padding: 15px 70px;
                          font-size: 20px;
                          font-family: 'Tajawal', sans-serif;
                          color: #fff;
                          font-weight: 700;
                          border-radius: 5px;
                          background-color: rgb(223, 20, 10);
                          text-decoration: none;
                          border: none;
                          cursor: pointer;
                          width: 170px; ;
                          display: inline-block;">نعم</button>
                    </form>

                    <form method="post" action="inf_departments" style="margin-left: 10px;">
                        <button type="submit" style="padding: 15px 70px;
                          font-family: 'Tajawal', sans-serif;
                          font-size: 20px;
                          color: #fff;
                          font-weight: 700;
                          border-radius: 5px;
                          background-color:  #42E6A4;
                          text-decoration: none;
                          border: none;
                          cursor: pointer;
                          width: 170px; ;
                          display: inline-block;">لا</button>
                    </form>
                </div>
            </h2>
        </div>
    </body>

    </html>
    <?php
}
function deleteDir($dirPath)
{
    if (file_exists($dirPath)) {
        unlink($dirPath);
    } else {
        echo "المسار غير موجود.";
    }
}

?>