$(document).ready(function () {
    $("#search-box").on("input", function () {
        // يقوم بتشغيل الكود بمجرد أن يتم إدخال قيمة جديدة في صندوق البحث
        var searchValue = $(this).val().trim(); // يستخرج القيمة المدخلة في صندوق البحث
        if (searchValue === "") {
            $("#search-results").empty(); // يفرغ عنصر عرض النتائج إذا كانت القيمة المدخلة فارغة
            $(".search-results").hide(); // يخفي عنصر عرض النتائج إذا كانت القيمة المدخلة فارغة
            return;
        }
        // يقوم بإرسال طلب POST باستخدام AJAX للحصول على النتائج من ملف "SearchHome.php"
        $.ajax({
            type: "POST",
            url: "assets/pg/SearchHome.php",
            data: {
                search: searchValue
            },
            success: function (data) {
                // يقوم بعرض النتائج إذا تم العثور على بيانات
                if (data.trim() !== "") {
                    $(".search-results").html(data);
                    $(".search-results").show();
                } else {
                    // يعرض رسالة "لا توجد نتائج" إذا لم يتم العثور على أي بيانات
                    $(".search-results").html("<div>لا توجد نتائج.</div>");
                    $(".search-results").show();
                }
            }
        });
    });

    // يقوم بالتعامل مع النقر على عناصر النتائج
    $(document).on("click", ".search-results div", function () {
        var resultText = $(this).text(); // يستخرج نص النتيجة التي تم النقر عليها
        $("#search-box").val(resultText); // يضع نص النتيجة في صندوق البحث
        $(".search-results").hide(); // يخفي عنصر عرض النتائج بعد النقر على نتيجة
    });

    // يقوم بإخفاء عنصر عرض النتائج عند النقر خارجه
    $(document).on("click", function (event) {
        if (!$(event.target).closest('.search-from').length) {
            $(".search-results").hide();
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("search-results").style.display = "none"; // يخفي عنصر عرض النتائج عند تحميل الصفحة
});

// يقوم بعرض عنصر عرض النتائج
function showResults() {
    document.getElementById("search-results").style.display = "block";
}
