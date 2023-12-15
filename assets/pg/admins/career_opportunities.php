<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | الوظائف بعد التخرج   </title>
    <link rel="stylesheet" href="style">
</head>
<body>

<?php    include 'inc/navbar.php';?>
    <div class="content">

     <?php    include 'inc/sidebar.php'; ?>
        <div class="content-bar">
            <div style='position:relative; margin-top: 15px; '> <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>الوظائف بعد التخرج</div>
            <button class="btn-style" onclick="window.open('add_career_opportunities.php' , '_self');">أضافة وظيفة جديدة</button>
            <div    class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الاقسام</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الوظائف بعد التخرج</div>
            </div>

            <table class="table teble-bordered" role="table">
                <thead>
                    <tr>
                        <th width="10%">معرف الوظيفة</th>
                        <th class="text-right" width="10%">القسم</th>
                        <th class="text-right" width="10%">العنوان الوظيفي</th>
                        <th class="text-right" width="10%">مقدار الراتب</th>
                        <th class="text-right" width="15%">نبذه عن الوظيفة</th>
                        <th class="text-right" width="20%">التحكم</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include 'inc/conn.inc.php';

                    $sql = "SELECT career_opportunities.*, departments.department_name 
                            FROM career_opportunities
                            LEFT JOIN departments ON career_opportunities.department_id = departments.department_id";

                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td><span class="badge">' . $row["opportunity_id"] . '</span></td>
                                <td>' . $row["department_name"] . '</td>
                                <td>' . $row["job_title"] . '</td>
                                <td>' . $row["salary_range"] . '</td>
                                <td>' . $row["job_description"] . '</td>
                                <td data-title="التحكم" class="text-center">
                                
                                    <a href="edit_courses.php?Edit_courses_id='. $row["opportunity_id"] .'" style="padding: 3px 10px;
                                    font-weight: 500;
                                    color: #fff;
                                    border-radius: 5px;
                                    background-color: #95a5a6;
                                    text-decoration: none;">تـعـديـل</a>
                    
                                    <a href="#" onclick="submitForm(\'' . $row["opportunity_id"] . '\');" 
                                              style="padding: 3px 10px;
                                              color: #fff;
                                              font-weight: 500;
                                              border-radius: 5px;
                                              background-color: rgb(223, 20, 10);
                                              text-decoration: none;">حذف</a>
                                    <form id="deleteForm" action="delete_career_opportunities" method="post" style="display: none;">
                                        <input type="hidden" name="del_id" id="del_id_input">
                                    </form>
                                </td>
                            </tr>';
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function submitForm(delId) {
            document.getElementById('del_id_input').value = delId;
            document.getElementById('deleteForm').submit();
        }
    </script>
</body>
</html>
