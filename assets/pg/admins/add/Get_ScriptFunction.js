function getColleges() {
    var uniId = $("#university_id").val();
    $.ajax({
        url: "get_colleges",
        method: "POST",
        data: { university_id: uniId },
        success: function (response) {

            $("#college_id").html(response);
        }
    });
}
function getInf_departments() {
    var uniId = $("#college_id").val();
    $.ajax({
        url: "get_inf_departments",
        method: "POST",
        data: { college_id: uniId },
        success: function (response) {

            $("#department_id").html(response);
        }
    });
}