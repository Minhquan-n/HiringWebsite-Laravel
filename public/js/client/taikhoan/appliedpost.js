var ungtuyen = [];
var limit = 10;

function add_applied (obj, num) {
    const applied = `<div class="ungtuyen nomal_cv">
                        <div class="id"><p class="content">${num}</p></div>
                        <div class="vitriungtuyen"><p>${obj.vitrituyen}</p></div>
                        <div class="ngay"><p class="content">${obj.ngayungtuyen}</p></div>
                        <div class="trangthaiungtuyen"><p class="content">${obj.trangthai}</p></div>
                        <div class="ngay"><p class="content">${obj.trangthai === 'Hẹn phỏng vấn' ? obj.ngayphongvan : '--/--/--'}</p></div>
                        <div class="thongbao"><p>${obj.ghichu === '' ? 'Không có thông báo.' : obj.ghichu}</p></div>
                    </div>`;
    const applied_accept = `<div class="ungtuyen accept_cv">
                        <div class="id"><p class="content">${num}</p></div>
                        <div class="vitriungtuyen"><p>${obj.vitrituyen}</p></div>
                        <div class="ngay"><p class="content">${obj.ngayungtuyen}</p></div>
                        <div class="trangthaiungtuyen"><p class="content">${obj.trangthai}</p></div>
                        <div class="ngay"><p class="content">${obj.trangthai === 'Hẹn phỏng vấn' ? obj.ngayphongvan : '--/--/--'}</p></div>
                        <div class="thongbao"><p>${obj.ghichu === '' ? 'Không có thông báo.' : obj.ghichu}</p></div>
                    </div>`;
    obj.trangthai == 'Hẹn phỏng vấn' ? $("#applied").append(applied_accept) : $("#applied").append(applied);
}

function changePageApplied (num) {
    $(".button_page").removeClass("button_page_active");
    $(`#button_page_applied${num}`).addClass("button_page_active");
    $("#applied").replaceWith('<div id="applied" class="posts"></div>');
    const first = limit * (num - 1);
    var last = 0;
    if ((ungtuyen.length - 1) < (limit * num -1) ) last = ungtuyen.length - 1;
    else last = limit * num - 1;
    for(var i = first; i <= last; i++) {
        const e = Object(ungtuyen[i]);
        add_applied(e, i + 1);
    }
    window.scrollTo({top: 10, left: 0, behavior: "smooth"});
}

async function open_applied_page () {
    await $.get("/taikhoan/applied", (data) => {
        var count = 0, page = 0;
        data.forEach(element => {
            const ngayungtuyen_date = new Date(element['ngayungtuyen']);
            const ngayungtuyen = ngayungtuyen_date.toLocaleDateString('en-GB');
            const ngayphongvan_date = new Date(element['ngayphongvan']);
            ungtuyen[count] = element;
            ungtuyen[count]['ngayungtuyen'] = ngayungtuyen;
            if (ngayphongvan_date.getTime() !== ngayungtuyen_date.getTime()) {
                ungtuyen[count]['ngayphongvan'] = ngayphongvan_date.toLocaleDateString('en-GB');
            }
            if ((count % limit) === 0) {
                page ++;
                $("#applied_pagination").append(`<button class='button_page' id='button_page_applied${page}' onclick="changePageApplied(${page})">${page}</button>`)
            }
            count++;
        });
    })
    changePageApplied(1);
}

$(() => {
    open_applied_page();
})
