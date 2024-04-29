<!DOCTYPE html>
<html>

<head>
    <title>بوصلة التعليم الجامعي | التنمية المستدامة</title>
    <link rel="stylesheet" href="./assets/css/swiper-bundle.min.css">
    <link href="./assets/fontawesome-free-6.5.1-web/css/fontawesome.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/brands.css" rel="stylesheet" />
    <link href="./assets/fontawesome-free-6.5.1-web/css/solid.css" rel="stylesheet" />
    <link rel="icon" href="LOGO" type="image/png" sizes="16x16">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="./assets/css/styleIndex.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="tailwind"></script>
</head>

<body>
    <?php
    require_once("admins/inc/conn.inc.php");
    include "Navbar_Index.php";
    ?>

    <div class="control">
        <!-- <section>
        <img src="8.png" alt="" />
      </section> -->
        <section class="flex justify-center items-center" style="height: 400px; width: 100%; background-color: var(--primary);">
            <h1 class="text-white font-bold text-3xl">التنميه المستدامه (التعليم المستدام)</h1>
        </section>
        <section class="Sh-des">
            <h1 class="font-bold text-3xl my-6">نُبذة عن الاستدامة</h1>
            <p style="line-height: 1.3;">
                الاستدامة هي مفهوم شامل يهدف إلى تلبية احتياجات الجيل الحالي دون المساس بقدرة الأجيال القادمة على تلبية احتياجاتها. تشمل الاستدامة الاهتمام بالبيئة والاقتصاد والمجتمع والتعليم، ويسعى لتحقيق التوازن بين هذه الجوانب الأربعة. يتطلب تحقيق الاستدامة التفكير بشكل مستدام في استخدام الموارد الطبيعية وتطوير تكنولوجيا نظيفة وتعزيز المجتمعات المستدامة.
                وعلوم البيئة تلعب دورًا حيويًا في تحقيق الاستدامة وتسهم علوم الطاقة وهندسة الطاقة في تحقيق الاستدامة من خلال تطوير واستخدام مصادر طاقة نظيفة ومتجددة من جهة أخرى، تسعى هندسة البيئة إلى تحسين جودة البيئة والمحافظة عليها ويعتبر التعليم المستدام جزءًا أساسيًا من تحقيق الاستدامة، حيث يهدف إلى نشر الوعي بأهمية الحفاظ على الموارد الطبيعية وتعزيز السلوكيات المستدامة. باستخدام هذه الاقسام العلمية وغيرها، يمكن تحقيق الاستدامة عبر التفكير الابتكاري وتطوير الحلول التقنية والسياسات الاجتماعية التي تعزز التوازن بين الاحتياجات الحالية والمستقبلية. وهذه تعتبر أكثر الأقسام التي يمكن من خلالها تحقيق الاستدامة.

            </p>
        </section>
        <br />
        <section class="Sh-des">
            <h2 class="font-bold text-3xl" style="margin-bottom: 30px;">الاقسام</h2>
            <div class="cards">
                <?php
                $sql1_departments = "SELECT d.*, c.college_name, u.university_name
                       FROM departments d
                       LEFT JOIN colleges c ON d.college_id = c.college_id
                       LEFT JOIN universities u ON c.university_id = u.university_id ";

                $result_sql1_departments = $conn->query($sql1_departments);
                while ($row_sql1_departments = $result_sql1_departments->fetch_assoc()) {
                ?>
                    <div class="card">
                        <img width="100%" class="object-fit-contain" src="assets/pg/admins/<?php echo $row_sql1_departments['departments_img_path']; ?>">
                        <div class="text-card">
                            <p><?php echo $row_sql1_departments["university_name"] . " - " .  $row_sql1_departments["college_name"] ?></p>
                            <h4 class="title"><?php echo $row_sql1_departments["department_name"]; ?></h4>
                            <form action="Show_Inf_department">
                                <button name="id" value="<?php echo $row_sql1_departments['department_id']; ?>">عرض القسم</button>
                            </form>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </section>
    </div>
    <script src="jquery-3.6.0.min"></script>
    <script src="assets/js/Script.js"></script>

</body>

</html>