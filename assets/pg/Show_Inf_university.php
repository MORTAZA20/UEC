<?php
require_once("admins/inc/conn.inc.php");

$id = $_GET['id'];
$sql_university = "SELECT * FROM universities WHERE university_id = '$id'";
$result_university = $conn->query($sql_university);
$row_university = $result_university->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>بوصلة التعليم الجامعي | الجامعة</title>
    <link rel="icon" href="LOGO" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="./assets/css/swiper-bundle.min.css">
    <link href="./assets/fontawesome-free-6.5.1-web/css/fontawesome.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/brands.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/styleIndex.css">

</head>

<body>

    <?php include "Navbar_Index.php"; ?>
    <div class="control">
        <section class="Show-SE">
            <div class="Img-logo">
                <img src="./assets\pg\admins\<?php echo $row_university["universities_img_path"]; ?>" alt="rtttt">
            </div>
            <div class="info">
                <h1><?php echo $row_university["university_name"]; ?></h1>
                <p><?php echo $row_university["university_location"]; ?></p>
                <a href="<?php echo $row_university["university_website"]; ?> target="_blank"">الموقع الالكتروني</a>
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
                        LEFT JOIN universities u ON c.university_id = u.university_id WHERE c.university_id = '$id'";
                $result4 = $conn->query($sql4);
                if ($result4->num_rows > 0) {
                    while ($row4 = $result4->fetch_assoc()) {
                ?>
                        <div class="card">
                            <img width="100%" class="object-fit-contain" src="./assets/pg/admins/<?php echo $row4['colleges_img_path']; ?>">
                            <div class="text-card">
                                <p><?php echo $row4["university_name"]; ?></p>
                                <h4 class="title"><?php echo $row4["college_name"]; ?></h4>
                                <form action="Show_Inf_college">
                                    <button name="id" value="<?php echo $row4['college_id']; ?>">عرض الكلية</button>
                                </form>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "لا توجد كليات للجامعة المحددة";
                } ?>
            </div>
        </section>
    </div>
    <?php include "Footer_Index.php"; ?>
    <script src="jquery-3.6.0.min"></script>
    <script src="./assets/js/Script.js"></script>
    <script src="./assets/js/swiper-bundle.min.js"></script>
</body>

</html>