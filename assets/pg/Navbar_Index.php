<nav class="navbar">
    <label class="hamburger">
        <input type="checkbox">
        <svg viewBox="0 0 32 32">
            <path class="line line-top-bottom" d="M27 10 13 10C10.8 10 9 8.2 9 6 9 3.5 10.8 2 13 2 15.2 2 17 3.8 17 6L17 26C17 28.2 18.8 30 21 30 23.2 30 25 28.2 25 26 25 23.8 23.2 22 21 22L7 22"></path>
            <path class="line" d="M7 16 27 16"></path>
        </svg>
    </label>
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

    <div class="search-from">
        <input type="search" placeholder="عن ماذا تبحث؟" id="search-box" oninput="showResults()">
        <i class="fas fa-search"></i>
    </div>

    <div id="search-results" class="search-results"></div>



    <img src="LOGO" alt="شعار بوصلة التعليم الجامعي">

</nav>
<div class="side">
    <ul class="side-menu">
        <li class="side-menu-item" onclick="window.open('../university-education-compass/', '_self');"><i class="fa-solid fa-house"></i> الرئيسية</li>
        <li class="side-menu-item active">الجامعات
            <i class="fa-solid fa-caret-down"></i>
        </li>
        <ul class="menu-dep-universities">
            <?php
            $sql = "SELECT * FROM universities";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
            ?>
                <li><a href="Show_Inf_university?id=<?php echo $row["university_id"]; ?>"><?php echo $row["university_name"]; ?></a></li>
            <?php } ?>
        </ul>

        <li class="side-menu-item active">الكليات
            <i class="fa-solid fa-caret-down"></i>
        </li>
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

        <li class="side-menu-item active">الاقسام العلمية
            <i class="fa-solid fa-caret-down"></i>
        </li>
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
    </ul>
</div>

<script>
    function sub_menu_open() {
        document.getElementById("req1").style.display = "none";
        document.getElementById("req2").style.display = "flex";
        document.getElementById("side-menu").style.height = "auto";
    }

    function sub_menu_close() {
        document.getElementById("req2").style.display = "none";
        document.getElementById("req1").style.display = "flex";
        document.getElementById("side-menu").style.height = "0px";
    }
</script>