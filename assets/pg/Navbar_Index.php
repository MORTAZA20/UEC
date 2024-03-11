<nav class="navbar">
    <img src="LOGO" alt="شعار بوصلة التعليم الجامعي">
    <ul class="nav-menu">

        <li class="nav-item" onclick="window.open('../university-education-compass/', '_self');"><i class="fa-solid fa-house"></i> الرئيسية</li>

        <li class="nav-item active">الجامعات
            <i class="fa-solid fa-caret-down"></i>
            <ul class="menu-dep-universities">
                <?php
                $sql = "SELECT * FROM universities";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                    <li><a href="Show_Inf_university?id=<?php echo $row["university_id"]; ?>"><?php echo $row["university_name"]; ?></a></li>
                <?php } ?>
            </ul>
        </li>

        <li class="nav-item active">الكليات
            <i class="fa-solid fa-caret-down"></i>
            <ul class="menu-dep-colleges">
                <?php
                $sql2 = "SELECT  c.*, u.university_name
                    FROM colleges c
                    LEFT JOIN universities u ON c.university_id = u.university_id ";

                $result2 = $conn->query($sql2);
                while ($row2 = $result2->fetch_assoc()) {
                ?>
                    <li><a href="Show_Inf_college?id=<?php echo $row2["college_id"]; ?>"><?php echo $row2["university_name"] . " - " .  $row2["college_name"]; ?></a></li>
                <?php } ?>
            </ul>
        </li>

        <li class="nav-item active">الاقسام العلمية
            <i class="fa-solid fa-caret-down"></i>
            <ul class="menu-dep-departments">
                <?php
                $sql3 = "SELECT d.*, c.college_name, u.university_name
                    FROM departments d
                    LEFT JOIN colleges c ON d.college_id = c.college_id
                    LEFT JOIN universities u ON c.university_id = u.university_id";

                $result3 = $conn->query($sql3);
                while ($row3 = $result3->fetch_assoc()) {
                ?>
                    <li><a href="Show_Inf_department?id=<?php echo $row3["department_id"]; ?>"><?php echo $row3["university_name"] . " - " .  $row3["college_name"] . " - " .  $row3["department_name"]; ?></a></li>
                <?php } ?>
            </ul>
        </li>
    </ul>
    <i class="fas fa-search search1"></i>
    <div class="search-from">
        <input type="search" placeholder="عن ماذا تبحث؟" id="search-box" oninput="showResults()">
        <i class="fas fa-search"></i>
    </div>
    <div id="search-results" class="search-results"></div>

    <div class="nav-item">
        <div onclick="window.open('../university-education-compass/#about', '_self');"><i class="fa-solid fa-circle-info" title="ماذا عنا"></i></div>
    </div>
</nav>