<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | معلومات الطلبة الاوائل </title>
    <link rel="stylesheet" href="style">
</head>
<body>

<?php    include 'inc/navbar.php';?>
    <div class="content">

     <?php    include 'inc/sidebar.php'; ?>
        <div class="content-bar">
            <div style='position:relative; margin-top: 15px; '> <h2 style='margin-right:20px; font-size: 32px; font-weight: lighter;'>الاقسام</div>
            <button class="btn-style" onclick="window.open('add_top_studens' , '_self');">أضافة طالب جديد</button>
          
            <form action="" method="post">
                <div class="group">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                        <g>
                            <path
                                d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                            </path>
                        </g>
                    </svg>

                    <input name="search" placeholder="ادخل اسم الطالب او القسم" type="search" class="input-placeholder">
                    <input name="Input_Serach" type="submit" class="button" value="بـحـث">
                </div>
            </form>
            
            <div    class="path-bar">
                <div class="url-path active-path">لوحة التحكم</div>
                <div class="url-path slash">/</div>
                <div class="url-path">الاقسام</div>
                <div class="url-path slash">/</div>
                <div class="url-path">معلومات الطلبة الاوائل</div>
            </div>

            <table class="table teble-bordered" role="table">
                <thead>
                    <tr>
                        <th width="10%">معرف الطالب</th>
                        <th class="text-right" width="10%">القسم</th>
                        <th class="text-right" width="10%">اسم الطالب</th>
                        <th class="text-right" width="10%">المعدل التراكمي</th>
                        <th class="text-right" width="20%">سنة التخرج</th>
                        <th class="text-right" width="20%">التحكم</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include 'inc/conn.inc.php';
                    if (isset($_POST['Input_Serach'])) {
                        $search = mysqli_real_escape_string($conn, $_POST['search']);
                        $sql = "SELECT top_students.*, departments.department_name 
                        FROM top_students
                        LEFT JOIN departments ON top_students.department_id = departments.department_id WHERE student_name LIKE '%$search%' OR  departments.department_name LIKE '%$search%'";
                    }else{
                       $sql = "SELECT top_students.*, departments.department_name 
                            FROM top_students
                            LEFT JOIN departments ON top_students.department_id = departments.department_id";  
                    }
                   

                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td><span class="badge">' . $row["student_id"] . '</span></td>
                                <td>' . $row["department_name"] . '</td>
                                <td>' . $row["student_name"] . '</td>
                                <td>' . $row["Cumulative_Rating"] . '</td>
                                <td>' . $row["Graduation_Year"] . '</td>
                                
                                <td data-title="التحكم" class="text-center">
                                
                                    <a href="edit_courses.php?Edit_courses_id='. $row["student_id"] .'" style="padding: 3px 10px;
                                    font-weight: 500;
                                    color: #fff;
                                    border-radius: 5px;
                                    background-color: #95a5a6;
                                    text-decoration: none;">تـعـديـل</a>
                    
                                    <a href="#" onclick="submitForm(\'' . $row["student_id"] . '\');" 
                                    style="padding: 3px 10px;
                                    color: #fff;
                                    font-weight: 500;
                                    border-radius: 5px;
                                    background-color: rgb(223, 20, 10);
                                    text-decoration: none;">حذف</a>
                          <form id="deleteForm" action="delete_top_students" method="post" style="display: none;">
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
