// Cac bien toan cuc
var post = [];
const limit = 8;

// Mo form tin tuyen dung
function open_post_form () {
    $("#tintuyendung_background").css("display", "block");
    $("#tintuyendung_form").css("display", "block");
    $("#post_submit").attr("onclick", `submit_post_form()`).text("Đăng tin");
}

// Reset form tin tuyen dung
function reset_form () {
    $("#post_title").val(""),
    $("#post_deadline").val(""),
    $("#post_position").val(""),
    $("#post_quantity").val(""),
    $("#post_age").val(""),
    $("#post_agency").val(1),
    $("#post_department").val(1),
    $("#post_sex").val("Nam"),
    $("#post_description").val(""),
    $("#post_workrequest").val(""),
    $("#post_benefit").val(""),
    $("#post_salary").val("Lương thỏa thuận")
}

// Tat form cap nhat tin tuyen dung
function close_post_form() {
    $("#tintuyendung_background").css("display", "none");
    $("#tintuyendung_form").css("display", "none");
    reset_form();
}

function add_post (obj) {
    const post1 = `<div id="${obj.id}" class="tin">
                    <div class="id"><p class="content"></p></div>
                    <div class="tieudetin"><p class="content">${obj.tieude}</p></div>
                    <div class="noilamviec"><p class="content">${obj.tenchinhanh}</p></div>
                    <div class="ngayhethan"><p class="content">${obj.hannophoso}</p></div>
                    <div class="button"><button type="submit" onclick="disable_button(${obj.id})" id="disable_button${obj.id}"class="disable_button"><i class="fa-solid fa-eye"></i></button><button type="submit" onclick="open_update_form(${obj.id})" id="update_button" class="update_button"><i class="fa-solid fa-pen"></i></button></div></div>`
    const post2 = `<div id="${obj.id}" class="tin">
                    <div class="id"><p class="content"></p></div>
                    <div class="tieudetin"><p class="content">${obj.tieude}</p></div>
                    <div class="noilamviec"><p class="content">${obj.tenchinhanh}</p></div>
                    <div class="ngayhethan"><p class="content">${obj.hannophoso}</p></div>
                    <div class="button"><button type="submit" onclick="disable_button(${obj.id})" id="disable_button${obj.id}"class="disable_button"><i class="fa-solid fa-eye-slash"></i></button><button type="submit" onclick="open_update_form(${obj.id})" id="update_button" class="update_button"><i class="fa-solid fa-pen"></i></button></div></div>`
    $("#posts").append(obj.status == 1 ? post1 : post2);
}

function changePage (num) {
    $(".button_page").removeClass("button_page_active");
    $(`#button_page${num}`).addClass("button_page_active");
    $("#posts").replaceWith('<div id="posts" class="posts"></div>');
    const first = limit * (num - 1);
    var last = 0;
    if ((post.length - 1) < (limit * num -1) ) last = post.length - 1;
    else last = limit * num - 1;
    for(var i = first; i <= last; i++) {
        const e = Object(post[i]);
        add_post(e);
        $(`#${e['id']} .id .content`).text(i + 1);
    }
    window.scrollTo({top: 10, left: 0, behavior: "smooth"});
}

async function open_post(num) {
    await $.ajax ({
        url: "/danhmuc/laytintuyendung",
        method: "GEt",
        success: function (result) {
            var count = 0;
            var page = 0;
            result.forEach(element => {
                const dateobj = new Date(element['hannophoso']);
                const date = dateobj.toLocaleDateString('en-GB');
                post[count] = element;
                post[count]['hannophoso'] = date;
                if ((count % limit) === 0) {
                    page++;
                    $("#account_pagination").append(`<button class='button_page' id='button_page${page}' onclick="changePage(${page})">${page}</button>`);
                }
                count++;
            });
            changePage(num);
        }
    })
    $(`#button_page${num}`).addClass("button_page_active");
}

// An tin tuyen dung
async function disable_button( id ) {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
    await $.ajax({
        url: `/danhmuc/tintuyendung/${id}`,
        method: "PUT",
        success: function(result) {
            if(result == 'success') {
                $(`#disable_button${id}>i`).attr("class", "fa-solid fa-eye-slash");
                $(`#disable_button${id}`).attr("onclick", `enable_button(${id})`);
            }
        }
    })
}

// Hien thi tin tuyen dung
async function enable_button( id ) {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
    await $.ajax({
        url: `/danhmuc/tintuyendung/${id}`,
        method: "PATCH",
        success: function(result) {
            if(result == 'success') {
                $(`#disable_button${id}>i`).attr("class", "fa-solid fa-eye");
                $(`#disable_button${id}`).attr("onclick", `disable_button(${id})`);
            }
        }
    })
}

// Them tin moi vao db
async function submit_post_form () {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
    const post = {
        'tieude': $("#post_title").val(),
        'hannophoso': $("#post_deadline").val(),
        'vitrituyen': $("#post_position").val(),
        'soluong': $("#post_quantity").val(),
        'dotuoi': $("#post_age").val(),
        'noilamviec': $("#post_agency").val(),
        'phongban': $("#post_department").val(),
        'gioitinh': $("#post_sex").val(),
        'chitietcv': $("#post_description").val(),
        'yeucaucv': $("#post_workrequest").val(),
        'quyenloi': $("#post_benefit").val(),
        'mucluong': $("#post_salary").val()
    }
    await $.ajax({
        url: "/danhmuc/tintuyendung",
        method: "POST",
        data: {payload: post},
        success: function(result) {
            if(result == 'success') {
                $("#post_status").text("Đăng tin thành công");
                close_post_form();
                $("#account_pagination").replaceWith('<div id="account_pagination" class="pagination"></div>');
                open_post(1);
            }
        }
    })
}

// Mo form cap nhat tin tuyen dung
async function open_update_form (id) {
    open_post_form();
    $("#post_submit").attr("onclick", `submit_update_post(${id})`).text("Cập nhật");
    await $.ajax({
        url: `/danhmuc/tintuyendung/${id}`,
        method: "GET",
        success: function(result) {
            const post = result['post'][0];
            $("#post_title").val(post['tieude']),
            $("#post_deadline").val(post['hannophoso']),
            $("#post_position").val(post['vitrituyen']),
            $("#post_quantity").val(post['soluong']),
            $("#post_age").val(post['dotuoi']),
            $("#post_agency").val(post['id_chinhanh']),
            $("#post_department").val(post['id_phongban']),
            $("#post_sex").val(post['gioitinh']),
            $("#post_description").val(post['chitietcv']),
            $("#post_workrequest").val(post['yeucaucv']),
            $("#post_benefit").val(post['quyenloi']),
            $("#post_salary").val(post['mucluong'])
        }
    })
}

// Cap nhat du lieu da duoc thay doi len db
async function submit_update_post (id) {
    const post = {
        'tieude': $("#post_title").val(),
        'hannophoso': $("#post_deadline").val(),
        'vitrituyen': $("#post_position").val(),
        'soluong': $("#post_quantity").val(),
        'dotuoi': $("#post_age").val(),
        'noilamviec': $("#post_agency").val(),
        'phongban': $("#post_department").val(),
        'gioitinh': $("#post_sex").val(),
        'chitietcv': $("#post_description").val(),
        'yeucaucv': $("#post_workrequest").val(),
        'quyenloi': $("#post_benefit").val(),
        'mucluong': $("#post_salary").val()
    }
    const str = $(".button_page_active").attr('id');
    const current_page = str.substring('button_page'.length, str.length);
    const cur_page = Number(current_page);
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
    await $.ajax({
        url: `/danhmuc/tintuyendung/${id}`,
        method: "POST",
        data: {payload: post},
        success: function(result) {
            if(result == "success") {
                $("#post_status").text("Cập nhật tin thành công");
                close_post_form();
                $("#account_pagination").replaceWith('<div id="account_pagination" class="pagination"></div>');
                open_post(cur_page);
            }
        }
    })
}

$(function() {
    const windowHeight = window.innerHeight;
    const windowWidth = window.innerWidth;
    $("#tintuyendung_background").css("height", windowHeight);
    $("#tintuyendung_background").css("width", windowWidth);
    $("#tintuyendung_form").css("height", windowHeight - 100);
    open_post(1);
})
