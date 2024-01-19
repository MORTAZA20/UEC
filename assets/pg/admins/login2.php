<style>
    @import url('assets/pg/admins/css/tailwind.css');
    @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap');

    
    /* login form  */

    .login-form-cont {
        display: flex;
        align-items: center;
        justify-content: center;
        position: fixed;
        top: 0;
        right: -105%;
        background-color: var(--bord);
        width: 100%;
        height: 100%;
        z-index: 10000;
    }

    .login-form-cont.active {
        top: 0;
        right: 0;
    }

    /* .pglogin{
        right: 0;
    } */

    .login-form-cont .close-lgin {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 30px;
        color: var(--primary);
    }

    .login-form-cont .close-lgin:hover {
        color: var(--sec);
    }

    .login-form-cont form {
        font-family: var(--main-font);
        width: 100%;
        max-width: 480px;
        padding: 10px;
        margin: 40px;
        border-radius: 5px;
        box-shadow: var(--box-shadow);
        background-color: #fff;
        text-align: center;
        justify-content: center;
    }

    .login-form-cont form .img-logo {
        width: 100%;
        text-align: center;
    }

    .login-form-cont form .img-logo img {
        width: 25%;
        margin: auto;
    }

    .login-form-cont form span {
        display: block;
        font-size: 15px;
        padding-top: 5px;
        width: 100%;
        margin-right: 10px;
        text-align: right;
    }

    .login-form-cont form .box {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        font-size: 15px;
        color: var(--primary);
        background-color: #fff;
        border-radius: 5px;
        border: 1.5px var(--border);
        text-align: right;
        text-decoration: none;
    }

    .login-form-cont form .checkbox {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 2px;
    }

    .login-form-cont form .checkbox label {
        font-size: 15px;
    }

    .login-form-cont form .btn-active {
        width: 100%;
        text-align: center;
    }

    .login-form-cont form p {
        text-align: right;
        color: var(--light-color2);
        margin: 4px;
    }

    .login-form-cont form .hrsp {
        display: flex;
        margin: 10px 0;
        align-items: center;
    }

    .login-form-cont form .hrsp span {
        width: 180px;
        font-size: 16px;
        margin: 0 20px;
        text-align: center;
    }

    .login-form-cont form .login-resert {
        display: flex;
        justify-content: center;
        margin: 20px 0;

    }

    .login-form-cont form .login-resert p {
        margin: 0 10px;
        color: var(--primary);

    }

    .login-form-cont form .login-resert p a {
        text-decoration: underline;
    }

    .login-form-cont form .login-resert p:hover {
        color: var(--sec);
    }

    .login-form-cont form .hrsp hr {
        flex: 1;
        height: 2px;
        background-color: var(--primary);
    }

    .login-form-cont form .login-icons i {
        font-size: 20px;
    }

    .login-form-cont form .login-icons .ic-brands:hover {
        background-color: #CDD0CB;
    }


    /* /login form  */

</style>


<div class="login-form-cont" id="loginfc">
    <div id="btn-close" class="fa-solid fa-circle-xmark close-lgin"></div>
    <form action="">
        <div class="img-logo"><img src="assets\pg\admins\img\logo2.png" alt=""></div>
        <span>أسم المستخدم</span>
        <input type="email" class="box" name="" value="" id="">
        <span>كلمة المرور</span>
        <input type="password" class="box" name="" value="" id="remeber-me">
        <div class="checkbox">
            <input type="checkbox">
            <label for="remeber-me">تذكرني</label>
        </div>
        <button type="submit" class="btn-active">تسجيل</button>
        <div class="hrsp">
            <hr><span>أو سجل الدخول باستخدام</span>
            <hr>
        </div>
        <div class="mt-6 login-icons">
            <div class="mt-6 grid grid-cols-5 gap-3">
                <div class="ic-brands">
                    <a href="https://www.aseeralkotb.com/login/apple" title="الدخول بواسطة Apple" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">الدخول بواسطة Apple</span>
                        <i class="fa-brands fa-apple"></i>
                    </a>
                </div>
                <div class="ic-brands">
                    <a href="https://www.aseeralkotb.com/login/facebook" title="الدخول بواسطة فيسبوك" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">الدخول بواسطة فيسبوك</span>
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                </div>
                <div class="ic-brands">
                    <a href="https://www.aseeralkotb.com/login/twitter" title="الدخول بواسطة تويتر" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">الدخول بواسطة تويتر</span>
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                </div>
                <div class="ic-brands">
                    <a href="https://www.aseeralkotb.com/login/instagram" title="الدخول بواسطة Instagram" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">الدخول بواسطة Instagram</span>
                        <i class="fa-brands fa-square-instagram"></i>
                    </a>
                </div>
                <div class="ic-brands">
                    <a href="https://www.aseeralkotb.com/login/google" title="الدخول بواسطة Google" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">الدخول بواسطة Google</span>
                        <i class="fa-brands fa-google"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="login-resert">
            <p><a href="#">نسيت كلمة المرور؟</a></p>
            <p><a href="#">أنشاء حساب صديق جديد</a></p>
        </div>
    </form>
</div>
