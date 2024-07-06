async function open_profile_update () {
    await $.get("/taikhoan/hoso/capnhat", () => {
        $("main").load("/taikhoan/hoso/capnhat #account_profile_update");
        history.pushState({}, "", "/taikhoan/hoso/capnhat");
    })
}

async function back_to_profile () {
    await $.get("/taikhoan/hoso", () => {
        $("main").load("/taikhoan/hoso #account_personal_profile_page");
        history.pushState({}, "", "/taikhoan/hoso");
    })
}

async function open_profile_update_form () {
    await $.get("/taikhoan/hoso/lylich", function() {
        $("main").load("/taikhoan/hoso/lylich #account_profile_update_form");
    })
}

async function open_education_update_form () {
    await $.get("/taikhoan/hoso/hocvan", function() {
        $("main").load("/taikhoan/hoso/hocvan #account_education_form");
    })
}

async function open_experience_update_form () {
    await $.get("/taikhoan/hoso/kinhnghiem", function() {
        $("main").load("/taikhoan/hoso/kinhnghiem #account_experience_form");
    })
}

async function open_skill_update_form () {
    await $.get("/taikhoan/hoso/kynang", function() {
        $("main").load("/taikhoan/hoso/kynang #account_skill_form");
    })
}

async function open_parent_update_form () {
    await $.get("/taikhoan/hoso/nguoithan", function() {
        $("main").load("/taikhoan/hoso/nguoithan #account_parent_form");
    })
}

function back_to_profile_upadate () {
    $.get("/taikhoan/hoso/capnhat", () => {
        $("main").load("/taikhoan/hoso/capnhat #account_profile_update");
    } )
}

