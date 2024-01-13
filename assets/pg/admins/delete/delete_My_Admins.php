<?php
require_once("../inc/conn.inc.php");
session_start();

if (!$_SESSION["admin_user"]) {
    header("Location: admin");
}

$delete_My_Admins = $_POST["del_id"];

if (isset($_POST["dal_stm"]) && $_POST["dal_stm"] == "true") {
    try {

        $conn->autocommit(FALSE);

        $sql = "DELETE FROM login_credentials WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$delete_My_Admins);
        $stmt->execute();

        $conn->commit();

        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#e6fff5; border-radius: 5px; justify-content: center; text-align: center; font-family: 'Tajawal', sans-serif;'>تم حذف الادمن بنجاح</div>";
        echo "<div style='justify-content: center; text-align: center;'>
                <a href='My_Admins' style='padding: 10px; color: #fff; font-size:18px; font-weight: 500; border-radius: 5px; background-color: #18bc9c; font-family: Tajawal, sans-serif; text-decoration: none;'>الرجوع الى صفحة الادمنية</a>
              </div>";
    } catch (Exception $e) {
        $conn->rollback();
        echo "حدث خطأ: " . $e->getMessage();
        echo "<div style='justify-content: center; text-align: center;'>
        <a href='My_Admins'  
        style='
            font-family: 'Tajawal', sans-serif;
            padding: 10px;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            border-radius: 5px;
            text-decoration: none;
            background-color: #5DC122;
            display: inline-block; 
            margin-top: 20px;  
        '>الرجوع الى صفحة  الادمنية</a>

    </div>";
    } finally {
        $conn->autocommit(TRUE);
    }
    $conn->close();
}else{
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>لوحة التحكم | حذف الادمنية</title>
        <link rel="stylesheet" href="style">
    </head>

    <body>
        <div style="text-align: center; margin-top: 10%;">
            <h1>هل أنت متأكد أنك ترغب في حذف هذه الادمن؟ (معرف  الادمن
                <?php echo $delete_My_Admins ?>)
            </h1>
            <h2 style="padding: 10px;">
            <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
                    <form method="post" action="delete_My_Admins" style="margin:15px; ">
                    <input type="hidden" name="del_id" value="<?php echo $delete_My_Admins ?>">
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
            
                    <form method="post" action="My_Admins" style="margin-left: 10px;">
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
?>