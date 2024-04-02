<footer>
    <div class="control">
        <div class="about" id="about">
            <h3>ماذا عنا</h3>
            <p>
                يهدف المشروع إلى توفير معلومات شاملة ومفصلة حول الجامعات والكليات والأقسام العلمية المختلفة. يتم توفير المعلومات حول المتطلبات الدراسية، والمواد الدراسية لكل قسم، ومعدلات القبول للدراسة الصباحية والمسائية والموازي والأنشطة الطلابية،وما إلى ذلك، بهدف مساعدة الطلاب في اتخاذ قرارات مهمة بشأن تعليمهم العالي.
            </p>
        </div>
        <div class="feedback">
            <h3>اترك لنا رأيك</h3>
            <form action="" method="POST">
                <p>الايميل</p>
                <input type="Email" name="Email" placeholder="example@gmail.com" required autocomplete="on">
                <p>الرساله</p>
                <textarea required name="msg"></textarea>
                <input type="submit" name="sub_form">
            </form>
        </div>
        <div class="contact_information">
            <h3>معلومات الاتصال</h3>
            <div class="grop">
                <div onclick="window.open('#', '_blank');">
                    <div class="fa-brands fa-instagram"></div>
                    <div>انستغرام</div>
                </div>
                <div onclick="window.open('#', '_blank');">
                    <div class="fa-brands fa-facebook"></div>
                    <div>فيسبوك</div>
                </div>
                <div onclick="window.open('https://t.me/M71_17', '_blank');">
                    <div class="fa-brands fa-telegram"></div>
                    <div>تلجرام</div>
                </div>
                <div onclick="window.open('#', '_blank');">
                    <div class="fa-brands fa-twitter"></div>
                    <div>تويتر</div>
                </div>

                <div onclick="window.open('tel:+9647839985872', '_blank');">
                    <div class="fa-solid fa-phone"></div>
                    <div> رقم الهاتف</div>

                </div>
                <div onclick="window.open('mailto:qqwwertyui488@gmail.com', '_blank');">
                    <div class="fa-solid fa-envelope"></div>
                    <div>حساب الجيميل</div>
                </div>
            </div>
        </div>
    </div>

    <div class="copy">
        <p>جميع الحقوق محفوظة &copy; 2024 Murtadha Haider Al-Mansouri</p>

    </div>
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p style="text-align: center; font-size: 24px; font-weight: bold; color: #4caf50;">
                تم إرسال الرسالة بنجاح!
            </p>
            <p style="text-align: center; font-size: 18px; color: #333; margin-top: 10px;">
                نشكرك على تواصلك معنا، وسنتعامل مع طلبك في أقرب وقت ممكن.
            </p>
        </div>
    </div>

    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p style="text-align: center; font-size: 24px; font-weight: bold; color: #f44336;">
                حدث خطأ أثناء إرسال الرسالة!
            </p>
            <p style="text-align: center; font-size: 18px; color: #333; margin-top: 10px;">
                نأسف لعدم تمكننا من إرسال رسالتك، يرجى المحاولة مرة أخرى لاحقًا.
            </p>
            <p style="text-align: center; font-size: 18px; color: #333; margin-top: 10px;">
                إذا استمرت المشكلة، يرجى التواصل معنا عبر البريد الإلكتروني:
                <a href="mailto:support@example.com" style="color: #333; font-weight: bold; text-transform: none;">qqwwertyui488@gmail.com</a>
            </p>
        </div>
    </div>
    <script>
        // الحصول على عناصر النوافذ النشطة
        var successModal = document.getElementById("successModal");
        var errorModal = document.getElementById("errorModal");

        // الحصول على عناصر الإغلاق (زر "x")
        var successClose = successModal.getElementsByClassName("close")[0];
        var errorClose = errorModal.getElementsByClassName("close")[0];

        // عندما ينقر المستخدم على زر "x"، أخفي النافذة
        successClose.onclick = function() {
            successModal.style.display = "none";
        }
        errorClose.onclick = function() {
            errorModal.style.display = "none";
        }
    </script>

    <!--  افحص نتيجة الإرسال وأظهر النافذة المناسبة -->
    <?php
    if (isset($_POST["sub_form"])) {
        $email = $_POST["Email"];
        $msg   = $_POST["msg"];

        require_once("admins/Mail-Msg.php");

        $mail->setFrom("$email", "University Education Compass");
        $mail->addAddress('qqwwertyui488@gmail.com');
        $mail->Subject = "رسالة من مستخدم";

        $mailBody = "<html><body style='font-family: Arial, sans-serif; text-align: right;'>";
        $mailBody .= "<h2 style='color: #333; text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px;'>رسالة من مستخدم</h2>";
        $mailBody .= "<p style='font-size: 22px; color: #333;'><strong><span style='font-size: 18px; color: #333;'>$email</span> : البريد الإلكتروني</strong> </p>";
        $mailBody .= "<p style='font-size: 22px; color: #333;'><strong> : الرسالة</strong></p>";
        $mailBody .= "<strong style='font-size: 22px; color: #333;'>$msg</strong>";
        $mailBody .= "</body></html>";

        $mail->Body = $mailBody;

        if ($mail->send()) {
    ?>
            <script>
                successModal.style.display = "block";
            </script>
        <?php
        } else {
        ?>
            <script>
                errorModal.style.display = "block";
            </script>
    <?php
        }
    }
    ?>

</footer>