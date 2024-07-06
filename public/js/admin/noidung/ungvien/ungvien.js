var applicants = [];
const applicant_limit = 10;
var applicants_update = [];

function add_applicant (obj, num) {
    const applicant = `<div class="applicant">
                        <div class="id"><p class="content">${num}</p></div>
                        <div class="mahoso"><p class="content">${obj.id}</p></div>
                        <div class="vitrituyen"><p>${obj.vitrituyen}</p></div>
                        <div class="tenungvien"><p class="content">${obj.hoten}</p></div>
                        <div class="ngay"><p class="content">${obj.ngayungtuyen}</p></div>
                        <div class="trangthai"><p class="content">${obj.trangthai}</p></div>
                        <div class="applicant_button">
                            <button type="submit" class="show_cv" onclick="open_applicant_cv(${obj.id_user})"><i class="fa-solid fa-eye"></i></button>
                            <button type="submit" class="update_status" onclick="open_update_cv_status(${obj.id})"><i class="fa-solid fa-pen"></i></button>
                            <button type="submit"class="print_cv"><i class="fa-solid fa-print"></i></button>
                        </div>
                    </div>`
    $("#applicants").append(applicant);
}

function changePageApplicants (num) {
    $(".button_page").removeClass("button_page_active");
    $(`#button_page_applicant${num}`).addClass("button_page_active");
    $("#applicants").replaceWith('<div id="applicants" class="posts"></div>');
    const first = applicant_limit * (num - 1);
    var last = 0;
    if ((applicants.length - 1) < (applicant_limit * num -1) ) last = applicants.length - 1;
    else last = applicant_limit * num - 1;
    for(var i = first; i <= last; i++) {
        const e = Object(applicants[i]);
        add_applicant(e, i + 1);
    }
    window.scrollTo({top: 10, left: 0, behavior: "smooth"});
}

async function get_applicants (p) {
    await $.get("/noidung/applicants", (data) => {
        var count = 0, page = 0;
        data.forEach(element => {
            const ngayungtuyen_date = new Date(element['ngayungtuyen']);
            const ngayungtuyen = ngayungtuyen_date.toLocaleDateString('en-GB');
            applicants[count] = element;
            applicants[count]['ngayungtuyen'] = ngayungtuyen;
            if ((count % applicant_limit) === 0) {
                page ++;
                $("#applicant_pagination").append(`<button class='button_page' id='button_page_applicant${page}' onclick="changePageApplicants(${page})">${page}</button>`)
            }
            count++;
        });
    })
    changePageApplicants(p);
    $(`#button_page_applicant${p}`).addClass("button_page_active");
}

function refresh_applicants () {
    $("#applicant_pagination").replaceWith('<div id="applicant_pagination" class="pagination"></div>');
    get_applicants(1);
}

async function open_update_cv_status (id) {
    $("#update_cv").css('display', 'flex');
    await $.get(`/noidung/applicants/${id}`, (data) => {
        applicants_update = data;
        data['ghichu'] == null ? applicants_update.ghichu = '' : applicants_update.ghichu = data['ghichu'];
        const ngayungtuyen_date = new Date(data['ngayungtuyen']);
        const ngayungtuyen = ngayungtuyen_date.toLocaleDateString('en-GB');
        const ngayphongvan_date = new Date(data['ngayphongvan']);
        const ngayphongvan = ngayphongvan_date.toLocaleDateString('en-GB');
        $("#cv_status").val(data['trangthai']);
        (ngayungtuyen_date.getTime() < ngayphongvan_date.getTime()) ? $("#cv_interviewday").val(data['ngayphongvan']) : $("#cv_interviewday").val('');
        $("#cv_notice").val(data['ghichu']);
        $("#applicants_update_submit").attr('onclick', `submit_update_applicant(${id})`);
    })
}

function close_update_cv_status () {
    $("#update_cv").css('display', 'none');
}

function check_update_diffrence () {
    const payload = {
        'trangthai': $("#cv_status").val(),
        'ngayphongvan': $("#cv_interviewday").val()? $("#cv_interviewday").val() : applicants_update.ngayphongvan,
        'ghichu': $("#cv_notice").val()
    }
    const trangthai = payload.trangthai == applicants_update.trangthai;
    const ngayphongvan = (new Date(payload.ngayphongvan)).getTime() == (new Date(applicants_update.ngayphongvan)).getTime()
    const ghichu = payload.ghichu == applicants_update.ghichu;
    if (trangthai && ngayphongvan && (ghichu)) return false;
    return true;
}

async function submit_update_applicant (id) {
    const str = $(".button_page_active").attr('id');
    const current_page = str.substring('button_page_applicant'.length, str.length);
    const cur_page = Number(current_page);
    var ngayphongvan_date = !$("#cv_interviewday").val() ? new Date(applicants_update['ngayphongvan']) : new Date($("#cv_interviewday").val());
    const payload = {
        'trangthai': $("#cv_status").val(),
        'ngayphongvan': ngayphongvan_date.toLocaleDateString('zh-Hans-CN'),
        'ghichu': $("#cv_notice").val()
    };
    const check = check_update_diffrence();
    if (check) {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
        await $.post (`/noidung/applicants/${id}`, {payload: payload})
            .done((data) => {
                if (data == 'success') {
                    alert("Thông báo đã được cập nhật.")
                    close_update_cv_status();
                    $("#applicant_pagination").replaceWith('<div id="applicant_pagination" class="pagination"></div>');
                    get_applicants(cur_page);
                }
                else {
                    alert("Server đang gặp lỗi! Thử lại sau.");
                    close_update_cv_status();
                }
            })
    } else {
        alert("Thông báo đã được cập nhật.");
        close_update_cv_status();
    }
}

async function open_applicant_cv (id) {
    await $.get(`/noidung/applicant_cv/${id}`, () => {
        $("#applicant_cv_show").load(`/noidung/applicant_cv/${id} #applicants_cv_page`);
    })
    $("#applicant_cv").css('display', 'flex');
    document.getElementById('applicant_cv_show').scrollTo({top:0, left: 0, behavior: 'smooth'})
}

function close_cv () {
    $("#applicant_cv").css('display', 'none');
}

$(() => {
    const height = window.innerHeight;
    $(".show_on_top").css('height', height);
    $(".show_background").css('height', height);
    $("#applicant_cv_show").css('height', height - 60);
    get_applicants(1);
})
