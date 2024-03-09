<?php
session_start();
if (isset($_SESSION["admin_user"])) {
if ($_SESSION["admin_user"] != "Admin" && $_SESSION["admin_user"] != "SubAdmin") {
    header("Location: login");
    exit();
}
}else{
    header("Location: login");
    exit(); 
}

?>

<head>
    <link rel='stylesheet' href='./assets/pg/admins/css/stylelogin.css'>
</head>
<div class='container'>
    <h2>أدخل رمز المصادقة الثنائية</h2>
    <h3>تم ارسال رمز مكون من 8 من الارقام والاحرف الى الايميل</h3>
   <?php echo $_SESSION["random_code"]; ?> 
    <form action="" method="post">
        <input type='text' name='verification_code' placeholder='رمز المصادقة' required>
        <input class='button' type='submit' name='Submit-verification_code' value='تأكيد'>
    </form>
</div>

<?php
if(isset($_POST["Submit-verification_code"])) {
    $verification_code = $_POST["verification_code"];
    $random_code = $_SESSION["random_code"];

    if ($random_code == $verification_code) {
        header("Location: home");
    }else{
        
        echo "<div id='success-message' style='margin:20px; padding:10px 15px; font-size: 18px; background-color:#ffe6e6; border-radius: 5px;'>رمز التاكيد الذي ادخلتة خاطئ</div>";   
    }
  }
?>