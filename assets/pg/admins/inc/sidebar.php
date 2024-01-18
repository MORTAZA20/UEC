<div class="side-bar">
            <div class="item-bar" onclick="window.open('home' , '_self');">الصفحة الرئيسية</div>
            <div class="item-bar" onclick="window.open('universities' , '_self');">الجامعات</div>
            <div class="item-bar" onclick="window.open('colleges' , '_self')">الكليات</div>
            <div id="req1" class="item-bar" onclick="sub_menu_open();">الاقسام</div>
            <div id="req2" class="item-bar" onclick="sub_menu_close();">الاقسام</div>

            <div id="sub-menu" class="sub-menu">
               <div onclick="window.open('inf_departments' , '_self')">معلومات القسم</div>
               <div onclick="window.open('courses' , '_self')">المواد الدراسية</div>
               <div onclick="window.open('top_students' , '_self')">الطلبة الااوائل</div>
               <div onclick="window.open('student_projects' , '_self')">مشاريع الطلبة</div>
               <div onclick="window.open('career_opportunities' , '_self')">فرص العمل المستقبلية</div>
            </div>
            <div class="item-bar" onclick="window.open('My_Admins' , '_self')">الادمنية</div>
            <div class="item-bar" onclick="window.open('support' , '_self')">الدعم</div>


</div>           
<script>
        function sub_menu_open(){
            document.getElementById("req1").style.display = "none";
            document.getElementById("req2").style.display = "block";
            document.getElementById("sub-menu").style.height = "auto";
        }
        function sub_menu_close(){
            document.getElementById("req2").style.display = "none";
            document.getElementById("req1").style.display = "block";
            document.getElementById("sub-menu").style.height = "0px";
        }
</script>    

            <?php
        
            if  (isset($_SESSION["admin_user"])){
                ?>

                <?php 
                }
                ?>



