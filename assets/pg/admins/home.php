<?php

require_once("inc/conn.inc.php");

session_start();
if (isset($_SESSION["admin_user"])) {
    if ($_SESSION["admin_user"] != "Admin" && $_SESSION["admin_user"] != "SubAdmin") {
        header("Location: login");
        exit();
    }
} else {
    header("Location: login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بوصلة التعليم الجامعي | لوحة التحكم</title>
    <link rel="icon" href="LOGO">
    <link rel="stylesheet" href="style">
</head>

<body>

    <?php include 'inc/navbar.php'; ?>

    <div class="content">
        <?php include 'inc/sidebar.php'; ?>


        <div class="content-bar">
            <div style='position:relative; margin-top: 15px; '>

                <h2 style='margin-right:20px; font-size: 32px; font-weight: 550;'>الصفحة الرئيسية</h2>
            </div>

            <div class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الصفحة الرئيسية</div>
            </div>

            <div class="panel-bar">
                <div>عدد الزوار <div>
                        <script type="text/javascript" src="online_t"></script>
                        <script type="text/javascript">
                            sc_online_t(1684310, "", "23a0a9");
                        </script>
                    </div>
                </div>
                <div>عدد الجامعات <div>
                        <?php
                        include 'inc/conn.inc.php';

                        $sql = "SELECT * FROM universities";
                        $result = $conn->query($sql);
                        echo $result->num_rows
                        ?>
                    </div>
                </div>
                <div>عدد الكليات<div>
                        <?php
                        include 'inc/conn.inc.php';

                        $sql = "SELECT * FROM colleges";
                        $result = $conn->query($sql);
                        echo $result->num_rows;
                        ?>
                    </div>
                </div>
                <div>عدد الاقسام<div>
                        <?php
                        include 'inc/conn.inc.php';

                        $sql = "SELECT * FROM departments";
                        $result = $conn->query($sql);
                        echo $result->num_rows;
                        ?></div>
                </div>
                <?php if ($_SESSION["admin_user"] == "Admin") {
                ?>
                    <div>عدد الادمنية<div>
                            <?php
                            include 'inc/conn.inc.php';

                            $sql = "SELECT * FROM inf_login";
                            $result = $conn->query($sql);
                            echo $result->num_rows;
                            ?></div>
                    </div>

                <?php } ?>
            </div>
            <div class="Latest-orders">احدث الاضافات</div>

            <table class="table teble-bordered" role="table">
                <thead>
                    <tr>
                        <th width="10%">معرف القسم</th>
                        <th class="text-right" width="10%">الكلية</th>
                        <th class="text-right" width="10%">القسم</th>
                        <th class="text-right" width="10%">شعار القسم</th>
                        <th class="text-right" width="30%">التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT departments.*, colleges.college_name FROM departments
                    LEFT JOIN colleges ON departments.college_id = colleges.college_id ORDER BY departments.TheCounter DESC";
                    $result = $conn->query($sql);


                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                    ?>
                        <tr>
                            <div class="truncated-text">
                                <td><?php echo $row["department_id"] ?></td>
                                <td><?php echo $row["college_name"] ?></td>
                                <td><?php echo $row["department_name"] ?></td>
                            </div>
                            <td><img style="pointer-events: none;" src="./assets/pg/admins/<?php echo $row["departments_img_path"]; ?>">
                            </td>



                            <td data-title="التحكم" class="text-center">
                                <div class="control-buttons">
                                    <form id="ShowForm" action="ShowDepartment" method="post">
                                        <input type="hidden" name="Show_id" value="<?php echo $row['department_id']; ?>">
                                        <input type="submit" name="btn_Show" value="عرض كل البيانات" class="Show-btn">
                                    </form>
                                    <?php if (isset($_SESSION["admin_user"])) {
                                        if ($_SESSION["admin_user"] != "college") {
                                    ?>
                                            <form id="EditForm" action="edit_inf_departments" method="post">
                                                <input type="hidden" name="edit_id" value="<?php echo $row['department_id']; ?>">
                                                <input type="submit" name="btn_edit" value="تعديل" class="edit-btn">
                                            </form>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <?php if (isset($_SESSION["admin_user"])) {
                                        if ($_SESSION["admin_user"] == "Admin") {
                                    ?>
                                            <form id="deleteForm" action="delete_inf_departments" method="post">
                                                <input type="hidden" name="del_id" value="<?php echo $row['department_id']; ?>">
                                                <input type="submit" name="btn_delete" value="حذف" class="delete-btn">
                                            </form>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>

                    <?php
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>