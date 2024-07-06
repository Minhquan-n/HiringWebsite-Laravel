$(async function() {
    const windowHeight = window.innerHeight;
    const mainHeight = $("main").height();
    const footerHeight = $("footer").height();
    if (mainHeight < (windowHeight - footerHeight)) $("footer").css("position", "relative")
    else $("footer").css("position", "static");
    $("#form_signin_signup").css("height", windowHeight);
    await $.ajax({
        url: '/user-layout',
        method: "GET",
        success: function(result) {
            $("head").prepend(`<meta name="csrf-token" content="${result['token']}">`);
        }
    })
})

function reset_form () {
    $("#signin_email").val("");
    $("#signin_password").val("");
    $("#signup_email").val("");
    $("#signup_password").val("");
    $("#signup_confilmpassword").val("");
    $("#signup_fullname").val("");
    $("#signup_phone").val("");
    $("#signup_sex").val("Nam");
    $(".status_icon").css("display", "none").removeClass("error_color warning_color");
    $(".status").css("display", "none").removeClass("error_color warning_color");
}

function close_form () {
    $("#form_signin_signup").css("display", "none");
    reset_form();
}

function open_signin_form () {
    reset_form();
    $("#signinStatus").css("display", "none");
    $("#form_signin_signup").css("display", "flex");
    $("#signin_form").css("display", "flex");
    $("#signup_form").css("display", "none");
}

function open_signup_form () {
    reset_form();
    $("#signupStatus").css("display", "none");
    $("#signup_form").css("display", "flex");
    $("#signin_form").css("display", "none");
}

function scrollToTop () {
    window.scrollTo({top: 0, left: 0, behavior: "smooth"});
}



