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
    const regex_phone = /^0+[1-9]+[0-9]{8}$/;
    if (id.search("email") != -1) {
        if (!$(`#${id}`).val()) errorStatus(id, "Bạn chưa nhập Email.");
        else if (!regex_email.test($(`#${id}`).val())) warningStatus(id, "Định dạng Email không đúng.");
        else correctStatus(id);
    } else if (id.search("confilmpassword") != -1) {
        if (!$(`#${id}`).val()) errorStatus(id, "Bạn chưa nhập lại mật khẩu.")
        else if ($(`#${id}`).val() !== $("#signup_password").val()) warningStatus(id, "Mật khẩu không khớp. Hãy nhập lại.");
        else correctStatus(id);
    } else if (id.search("password") != -1) {
        if (!$(`#${id}`).val()) errorStatus(id, "Bạn chưa nhập mật khẩu.");
        else if (!regex_password.test($(`#${id}`).val())) warningStatus(id, "Mật khẩu đủ 8 ký tự, chữ số và chữ cái.");
        else correctStatus(id);
    } else if (id.search("phone") != -1) {
        if (!$(`#${id}`).val()) errorStatus(id, "Bạn chưa nhập số điện thoại.");
        else if (!regex_phone.test($(`#${id}`).val())) warningStatus(id, "Số điện thoại chưa đúng định dạng.");
        else correctStatus(id);
    } else if(id.search("fullname") != -1) {
        if (!$(`#${id}`).val()) errorStatus(id, "Bạn chưa nhập họ tên.");
        else correctStatus(id);
    }
}

function login (e) {
    const regex_email = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z])+\.)+([a-zA-Z]{2,4})+$/;
    const regex_password = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,30}$/;
    const email = $("#signin_email").val();
    const password = $("#signin_password").val();
    const user = {"email": email, "password": password};
    if (!regex_email.test(email) || !regex_password.test(password)) {
        $("#signinStatus").css("display", "block").html("<p>Email hoặc mật khẩu không hợp lệ.</p>");
        e.preventDefault();
    }
}

async function register () {
    const regex_email = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z])+\.)+([a-zA-Z]{2,4})+$/;
    const regex_password = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,30}$/;
    const regex_phone = /^0+[1-9]+[0-9]{8}$/;
    const email = $("#signup_email").val();
    const password = $("#signup_password").val();
    const confilmpassword = $("#signup_confilmpassword").val();
    const fullname = $("#signup_fullname").val();
    const phone = $("#signup_phone").val();
    const sex = $("#signup_sex").val();
    const newAccount = {
        "email": email,
        "password": password,
        "fullname": fullname,
        "phone": phone,
        "sex": sex
    }
    if(!fullname || (confilmpassword !== password) || !regex_password.test(password) || !regex_email.test(email) || !regex_phone.test(phone)) {
        $("#signupStatus").css("display", "block").html("<p>Thông tin chưa chính xác.</p>");
    } else {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
        await $.ajax({
            url: "/dangky",
            method: "POST",
            data: {payload: newAccount},
            success: function (result) {
                if(result == "success") {
                    open_signin_form();
                    $("#signinStatus").css("display", "block").html("<p>Đăng ký thành công!</p>");
                } else {
                    $("#signupStatus").css("display", "block").html("<p>Đăng ký thất bại. Vui lòng kiểm tra lại thông tin!</p>")
                }
            }
        })

    }
}
