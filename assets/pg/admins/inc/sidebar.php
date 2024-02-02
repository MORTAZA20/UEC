<div class="side-bar">
    <?php
    if (isset($_SESSION["admin_user"])) {
        $type = $_SESSION["admin_user"];
        if ($type == "Admin" || $type == "SubAdmin") {
    ?>
               
           
            <div class="item-bar" onclick="window.open('home' , '_self');"><div class="Imgitem" style="background-image: url('home-page');"></div>
            الصفحة الرئيسية</div>
            
           
            
            <div class="item-bar" onclick="window.open('universities' , '_self');"><div class="Imgitem" style="background-image: url('university');"></div>
            الجامعات</div>
            <div class="item-bar" onclick="window.open('colleges' , '_self')"><div class="Imgitem" style="background-image: url('C1');"></div>
            الكليات</div>


        <?php
        }

        if ($type == "Admin" || $type == "SubAdmin") {
        ?>
            <div id="req1" class="item-bar" onclick="sub_menu_open();"><div class="Imgitem" style="background-image: url('department');"></div>
            الاقسام</div>
            <div id="req2" class="item-bar" onclick="sub_menu_close();"><div class="Imgitem" style="background-image: url('department');"></div>
            الاقسام</div>
            <div id="sub-menu" class="sub-menu">
                <div class="item-bar" onclick="window.open('inf_departments' , '_self')"><div class="Imgitem" style="background-image: url('information-department');"></div>
                معلومات الاقسام</div>
                <div class="item-bar" onclick="window.open('courses' , '_self')"><div class="Imgitem" style="background-image: url('Subjects');"></div>
                المواد الدراسية</div>
                <div class="item-bar" onclick="window.open('top_students' , '_self')"><div class="Imgitem" style="background-image: url('graduated');"></div>
                الطلبة الااوائل</div>
                <div class="item-bar" onclick="window.open('student_projects' , '_self')"><div class="Imgitem" style="background-image: url('projects');"></div>
                مشاريع الطلبة</div>
                <div class="item-bar" onclick="window.open('career_opportunities' , '_self')"><div class="Imgitem" style="background-image: url('business');"></div>
                فرص العمل</div>
            </div>
        <?php }
        if ($type == "department"){ 
                   
        ?>
            <div class="item-bar" onclick="window.open('ShowDepartment' , '_self')"><div class="Imgitem" style="background-image: url('information-department');"></div>
            معلومات القسم</div>
            <div class="item-bar" onclick="window.open('courses' , '_self')"><div class="Imgitem" style="background-image: url('Subjects');"></div>
            المواد الدراسية</div>
            <div class="item-bar" onclick="window.open('top_students' , '_self')"><div class="Imgitem" style="background-image: url('graduated');"></div>
            الطلبة الااوائل</div>
            <div class="item-bar" onclick="window.open('student_projects' , '_self')"><div class="Imgitem" style="background-image: url('projects');"></div>
            مشاريع الطلبة</div>
            <div class="item-bar" onclick="window.open('career_opportunities' , '_self')"><div class="Imgitem" style="background-image: url('business');"></div>
            فرص العمل</div>
    <?php }
    
     }?>




    <?php
    if (isset($_SESSION["admin_user"])) {
        if ($type == "Admin") {
    ?>
            <div class="item-bar" onclick="window.open('My_Admins' , '_self')"><div class="Imgitem" style="background-image: url('admin');"></div>
            المشرفين</div>
    <?php
        }
    }
  
    ?>



    <div class="item-bar" onclick="window.open('support' , '_self')"><div class="Imgitem" style="background-image: url('Support');"></div>
    الدعم والمساعدة</div>


</div>

<script>
    function sub_menu_open() {
        document.getElementById("req1").style.display = "none";
        document.getElementById("req2").style.display = "block";
        document.getElementById("sub-menu").style.height = "auto";
    }

    function sub_menu_close() {
        document.getElementById("req2").style.display = "none";
        document.getElementById("req1").style.display = "block";
        document.getElementById("sub-menu").style.height = "0px";
    }
</script>