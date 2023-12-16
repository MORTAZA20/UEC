<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | معلومات مشاريع الطلاب </title>
    <link rel="stylesheet" href="style">
</head>
<body>

<?php    include 'inc/navbar.php';?>
    <div class="content">

     <?php    include 'inc/sidebar.php'; ?>
        <div class="content-bar">
            <div style='position:relative; margin-top: 15px; '> <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>الاقسام</div>
            <button class="btn-style" onclick="window.open('add_student_projects' , '_self');">أضافة مشروع جديد</button>
            <div    class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الاقسام</div>
                <div class="url-path slash">/</div>
                <div class="url-path">معلومات مشاريع الطلاب</div>
            </div>

            <table class="table teble-bordered" role="table">
                <thead>
                    <tr>
                        <th width="10%">معرف الطالب</th>
                        <th class="text-right" width="10%">القسم</th>
                        <th class="text-right" width="10%">اسم المشروع</th>
                        <th class="text-right" width="10%">صاحب المشروع</th>
                        <th class="text-right" width="15%">المشرف على المشروع</th>
                        <th class="text-right" width="15%">نبذه عن المشروع</th>
                        <th class="text-right" width="20%">التحكم</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include 'inc/conn.inc.php';

                    $sql = "SELECT student_projects.*, departments.department_name 
                            FROM student_projects
                            LEFT JOIN departments ON student_projects.department_id = departments.department_id";

                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td><span class="badge">' . $row["project_id"] . '</span></td>
                                <td>' . $row["department_name"] . '</td>
                                <td>' . $row["project_name"] . '</td>
                                <td>' . $row["student_name"] . '</td>
                                <td>' . $row["project_supervisor"] . '</td>
                                <td>' . $row["project_description"] . '</td>
                                <td data-title="التحكم" class="text-center">
                                
                                    <a href="edit_courses.php?Edit_courses_id='. $row["project_id"] .'" style="padding: 3px 10px;
                                    font-weight: 500;
                                    color: #fff;
                                    border-radius: 5px;
                                    background-color: #95a5a6;
                                    text-decoration: none;">تعديل</a>
                    
                                    <a href="#" onclick="submitForm(\'' . $row["project_id"] . '\');" 
                                    style="padding: 3px 10px;
                                    color: #fff;
                                    font-weight: 500;
                                    border-radius: 5px;
                                    background-color: rgb(223, 20, 10);
                                    text-decoration: none;">حذف</a>
                          <form id="deleteForm" action="delete_student_projects" method="post" style="display: none;">
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
