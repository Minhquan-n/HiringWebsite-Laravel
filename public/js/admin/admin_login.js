function correctStatus (id) {
    $(`#${id}`).css("width", "90%");
    $(`#${id}_status`).css("display", "none");
    $(`#${id}_status_icon`).css("display", "none");
}

function errorStatus (id, text) {
    $(`#${id}`).css("width", "87%");
    $(`#${id}_status`).css("display", "block").addClass("error_color").html(`<p class='error_color'>${text}</p>`).removeClass("warning_color");
    $(`#${id}_status_icon`).css("display", "block").addClass("error_color").removeClass("warning_color");
}

function warningStatus (id, text) {
    $(`#${id}`).css("width", "87%");
    $(`#${id}_status`).css("display", "block").addClass("warning_color").html(`<p class='warning_color'>${text}</p>`).removeClass("error_color");
    $(`#${id}_status_icon`).css("display", "block").addClass("warning_color").removeClass("error_color");
}

function checkInput (id) {
    const regex_email = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z])+\.)+([a-zA-Z]{2,4})+$/;
    const regex_password = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,30}$/;
    if (id.search("email") != -1) {
        if (!$(`#${id}`).val()) errorStatus(id, "Bạn chưa nhập Email.");
        else if (!regex_email.test($(`#${id}`).val())) warningStatus(id, "Định dạng Email không đúng.");
        else correctStatus(id);
    } else if (id.search("password") != -1) {
        if (!$(`#${id}`).val()) errorStatus(id, "Bạn chưa nhập mật khẩu.");
        else if (!regex_password.test($(`#${id}`).val())) warningStatus(id, "Mật khẩu đủ 8 ký tự, chữ số và chữ cái.");
        else correctStatus(id);
    }
}

function login (e) {
    const regex_email = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z])+\.)+([a-zA-Z]{2,4})+$/;
    const regex_password = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,30}$/;
    const email = $("#admin_email").val();
    const password = $("#admin_password").val();
    const user = {"email": email, "password": password};
    if (!regex_email.test(email) || !regex_password.test(password)) {
        $("#signinStatus").css("display", "block").html("<p>Email hoặc mật khẩu không hợp lệ.</p>");
        e.preventDefault();
    }
}

$(function() {
    const height = window.innerHeight;
    $("main").css("height", height);
})
