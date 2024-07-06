var newpost = [];
var applied = [];
const limit = 4;

function add_post (obj) {
    const post = `<div id="${obj.id}" class="tin">
                    <div class="id" onclick="open_post_detail(${obj.id})"><p class="content"></p></div>
                    <div class="tieudetin" onclick="open_post_detail(${obj.id})"><p>${obj.tieude}</p></div>
                    <div class="noilamviec" onclick="open_post_detail(${obj.id})"><p class="content">${obj.tenchinhanh}</p></div>
                    <div class="ngayhethan" onclick="open_post_detail(${obj.id})"><p class="content">${obj.hannophoso}</p></div>
                    <div class="button"><button id="apply_button" type="button" onclick="apply(${obj.id})">Nộp hồ sơ</button><button id="applied_button" type="button"><i class="fa-solid fa-check"></i></button></div>
                </div>`
    $("#posts").append(post);
}

function applied_button (id) {
    $(`#${id} .button #apply_button`).css('display', 'none');
    $(`#${id} .button #applied_button`).css('display', 'flex');
}

async function get_applied_list () {
    var t = 0;
    await $.get("/taikhoan/newpost", (data) => {
        data['applied'].forEach(e => {
            applied[t] = (e);
            t++;
        })
    })
}

function changePage (num) {
    get_applied_list();
    $(".button_page").removeClass("button_page_active");
    $(`#newpost_page${num}`).addClass("button_page_active");
    $("#posts").replaceWith('<div id="posts" class="posts"></div>');
    const first = limit * (num - 1);
    var last = 0;
    if ((newpost.length - 1) < (limit * num -1) ) last = newpost.length - 1;
    else last = limit * num - 1;
    for(var i = first; i <= last; i++) {
        const e = Object(newpost[i]);
        add_post(e);
        $(`#${e['id']} .id .content`).text(i + 1);
        applied.forEach(element => {
            if (element['id_post'] === e['id'] && element['trangthai'] === 'Hẹn phỏng vấn') applied_button(e['id']);
        })
    }
    window.scrollTo({top: 10, left: 0, behavior: "smooth"});
}

async function open_post() {
    await $.ajax ({
        url: "/taikhoan/newpost",
        method: "GET",
        success: function (result) {
            var count = 0;
            var page = 0;
            result['post'].forEach(element => {
                const dateobj = new Date(element['hannophoso']);
                const date = dateobj.toLocaleDateString('en-GB');
                newpost[count] = element;
                newpost[count]['hannophoso'] = date;
                if ((count % limit) === 0) {
                    page++;
                    $("#account_pagination").append(`<button class='button_page' id='newpost_page${page}' onclick="changePage(${page})">${page}</button>`);
                }
                count++;
            });
            var t = 0;
            result['applied'].forEach(e => {
                applied[t] = (e);
                t++;
            })
            changePage(1);
            $("#newpost_page1").addClass("button_page_active");
        }
    })
}

async function open_post_detail (id) {
    await $.get(`/taikhoan/newpost/${id}`, () => {
        $("#post_detail_main").load(`/taikhoan/newpost/${id} #post_detail`);
    })
    $("#post_background").css('display', 'block');
    $("#post_details").css('display', 'flex');
    $("#show_post").css('display', 'flex');

}

const close_post_detail = () => {
    $("#post_detail").css('display', 'none');
    $("#post_background").css('display', 'none');
    $("#show_post").css('display', 'none');
}

async function apply (id) {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    await $.post("/taikhoan/newpost", (data) => {
        if (data != 0) {
            alert("Bạn chưa cập nhật đầy đủ thông tin!");
            return;
        } else {
            $.ajax ({
                url: `/taikhoan/newpost/${id}`,
                method: 'POST',
                success: (data) => {
                    if (data == 'success') {
                        alert('Bạn đã ứng tuyển thành công. Theo dõi thông báo từ DHG Pharma tại mục úng tuyển.');
                        applied_button(id);
                    }
                }
            })
        }
    })
}

$(() => {
    const height = window.innerHeight;
    $("#post_background").css('height', height);
    open_post();
})

