<?php
    if (isset($_POST['search'])) {  
    include '../inc/conn.inc.php';
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT * FROM login_credentials WHERE AdminUserName LIKE '%$search%' OR id LIKE '$search' ";
    $result = $conn->query($sql);
    }else{
        $sql = "SELECT * FROM login_credentials";
        $result = $conn->query($sql);
    }
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td><span class="badge">' . $row["id"] . '</span></td>
                <td>' . $row["department_id"] . '</td>
                <td>' . $row["AdminUserName"] . '</td>
                <td>' . $row["AdminPassword"] . '</td>
                <td data-title="التحكم" class="text-center">
                
                    <a href="assets/pg/admins/edit_university.php?Edit_login_credentials_id='. $row["id"] .'" style="padding: 3px 10px;
                    font-weight: 500;
                    color: #fff;
                    border-radius: 5px;
                    background-color: #95a5a6;
                    text-decoration: none;">تعديل</a>
    
                    <a href="del_login_credentials?del_id='. $row["id"] .'"
                    style="padding: 3px 10px;
                    color: #fff;
                    font-weight: 500;
                    border-radius: 5px;
                    background-color: rgb(223, 20, 10);
                    text-decoration: none;">حذف</a>
                    
                </td>
            </tr>';
    }
$conn->close();
?>