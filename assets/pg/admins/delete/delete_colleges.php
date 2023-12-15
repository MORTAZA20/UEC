<?php
require_once("inc/conn.inc.php");
session_start();

if (!$_SESSION["admin_user"]) {
    header("Location: admin");
    exit();
}
$delete_colleges = $_POST["del_id"];

if (isset($_POST["dal_stm"]) && $_POST["dal_stm"] === "true") {
    try {

        $sql = "SELECT * FROM departments WHERE college_id =?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $delete_colleges);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dirPath = $row["departments_img_path"];
                deleteDir($dirPath);
            }
        }
        $sql = "SELECT * FROM colleges WHERE college_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $delete_colleges);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $dirPath = $row["colleges_img_path"];
        deleteDir($dirPath);

        $conn->autocommit(FALSE);



    // حذف الجداول المرتبطة بالأقسام
    $sql = "DELETE FROM student_projects WHERE department_id IN (SELECT department_id FROM departments WHERE college_id=?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $delete_colleges);
    $stmt->execute();
    
    $sql = "DELETE FROM career_opportunities WHERE department_id IN (SELECT department_id FROM departments WHERE college_id=?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $delete_colleges);
    $stmt->execute();
    
    $sql = "DELETE FROM courses WHERE department_id IN (SELECT department_id FROM departments WHERE college_id=?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $delete_colleges);
    $stmt->execute();
    
    // حذف الطلاب المرتبطين بالأقسام
    $sql = "DELETE FROM top_students WHERE department_id IN (SELECT department_id FROM departments WHERE college_id=?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $delete_colleges);
    $stmt->execute();
    
    // حذف الأقسام
    $sql = "DELETE FROM departments WHERE college_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $delete_colleges);
    $stmt->execute();
    
    // حذف الكليات
    $sql = "DELETE FROM colleges WHERE college_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $delete_colleges);
    $stmt->execute();

    $conn->commit();

        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px; justify-content: center; text-align: center; font-family: 'Tajawal', sans-serif;'>تم حذف الكلية بنجاح.</div>";
        echo "<div style='justify-content: center; text-align: center;'>
                <a href='colleges' style='padding: 10px; color: #fff; font-size:18px; font-weight: 500; border-radius: 5px; background-color: #18bc9c; font-family: Tajawal, sans-serif; text-decoration: none;'>الرجوع الى صفحة الكليات</a>
              </div>";

    }catch (Exception $e) {
                    echo "حدث خطأ: " . $e->getMessage();
                    echo "<div style='justify-content: center; text-align: center;'>
                    <a href='colleges' style='
                    padding: 10px;
                    color: #fff;
                    font-size: 18px;
                    font-weight: 500;
                    border-radius: 5px;
                    text-decoration: none;
                    background-color: #5DC122;
                    display: inline-block; 
                    margin-top: 20px; 
                '>الرجوع الى صفحة الكليات</a>";
                }
    $conn->close();
}else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | حذف الكلية</title>
    <link rel="stylesheet" href="style">
</head>
<body>
    <div style="text-align: center; margin-top: 10%;">
        <h1>هل أنت متأكد أنك ترغب في حذف هذه الكلية؟ (معرف الكلية <?php echo $delete_colleges ?>)</h1>
        <h2 style="padding: 10px;">
        <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
        <form method="post" action="delete_colleges" style="margin:15px; ">
        <input type="hidden" name="del_id" value="<?php echo $delete_colleges ?>">
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

    <form method="post" action="colleges" style="margin-left: 10px;">
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
function deleteDir($dirPath) {
    if (file_exists($dirPath)) {
        unlink($dirPath);
    } else {
        echo "المسار غير موجود.";
    }
}


?>
