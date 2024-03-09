<?php
require_once("admins/inc/conn.inc.php");
$id = $_GET['id'];
$sql = "SELECT * FROM universities WHERE university_id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بوصلة التعليم الجامعي | عرض الجامعات</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/0b13675ea3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/styleIndex.css">

</head>

<body>
    <?php include "Navbar_Index.php"; ?>
    <div class="control">
        <section class="Show-SE">
            <div class="Img-logo">
                <img src="./assets\pg\admins\img\111.png" alt="rtttt">
            </div>
            <div class="info">
                <h1>جامعة البصرة</h1>
                <p>البصرة- الكرمة</p>
                <a href="http://localhost/university-education-compass/ShowCollege">الموقع الالكتروني</a>
            </div>
        </section>
        <section>
            <div class="pagimation_">
                <h3>الكليات</h3>
            </div>
           
                <div class="cards">
                    <?php
                    $sql4 = "SELECT  c.*, u.university_name
                        FROM colleges c
                        LEFT JOIN universities u ON c.university_id = u.university_id WHERE c.university_id = $id";
                    $result4 = $conn->query($sql4);
                    while ($row4 = $result4->fetch_assoc()) {
                    ?>
                        <div class="card Sh-card">
                            <img width="100%" class="object-fit-contain" src="./assets/pg/admins/<?php echo $row4['colleges_img_path']; ?>">
                            <div class="text-card">
                                <p><?php echo $row4["university_name"]; ?></p>
                                <h4 class="title"><?php echo $row4["college_name"]; ?></h4>
                                <button onclick="window.open('Show_Inf_college?id=<?php echo $row4['college_id']; ?>', '_self');">عرض الكلية</button>
                            </div>
                        </div>
                    <?php
                    } ?>
                </div>
        </section>
</div>
     <?php include "Footer_Index.php"; ?> 
    <script src="jquery-3.6.0.min"></script>
    <script src="./assets/js/Script.js"></script>
    
</body>

</html>