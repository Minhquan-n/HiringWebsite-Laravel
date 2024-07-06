var posts = [];
const limit = 5; /*So tin hien thi tren 1 trang*/

function addPost (obj) {
    const post = `<div class="post" id="post_${obj.id}" onclick="post(${obj.id})">
    <div class="post_title"><h3>${obj.tieude}</h3></div>
    <div class="post_workplace"><p><i class="fa-solid fa-location-dot"></i> &nbsp; ${obj.tenchinhanh}</p></div>
    <div class="post_candidate"><p>Số lượng: ${obj.soluong}</p><p>Giới tính: ${obj.gioitinh}</p><p><i class="fa-solid fa-clock"></i> &nbsp; ${obj.hannophoso}</p></div>
    <div class="post_description"><strong>Mô tả công việc:</strong><p>- ${obj.chitietcv}</p></div>
    <div class="post_request"><strong>Yêu cầu:</strong><p>+ ${obj.yeucaucv}</p></div></div>`;
    $("#page").append(post);
}

$(function() {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
    $.ajax({
        url: "/tuyendung-post",
        method: "GET",
        success: function(result) {
            var count = 0;
            var page = 0;
            result.forEach(element => {
                const request = element['yeucaucv'].replace(/[.]+[\n]/g, ".</p><p>+ ");
                const description = element['chitietcv'].replace(/[.]+[\n]/g, ".</p><p>- ");
                const dateobj = new Date(element['hannophoso']);
                const date = dateobj.toLocaleDateString('en-GB');
                posts[count] = element;
                posts[count]['hannophoso'] = date;
                posts[count]['yeucaucv'] = request;
                posts[count]['chitietcv'] = description;
                if (count >= 0 && count < limit) addPost(Object(posts[count]));
                if ((count % limit) === 0) {
                    page++;
                    $("#pagination").append(`<button class='button_page' id='button_page${page}' onclick="moveToPage(${page})">${page}</button>`);
                }
                count++;
            });
            $("#button_page1").addClass("button_page_active");
        }
    })
})

/*  Pagination's logic:
    first: lim * (page - 1)
    last: lim * page - 1 */

function moveToPage (num) {
    $(".button_page").removeClass("button_page_active");
    $(`#button_page${num}`).addClass("button_page_active");
    $("#page").replaceWith('<div id="page" class="page"></div>');
    const first = limit * (num - 1);
    var last = 0;
    if ((posts.length - 1) < (limit * num -1) ) last = posts.length - 1;
    else last = limit * num - 1;
    for(var i = first; i <= last; i++) {
        const e = Object(posts[i]);
        addPost(e);
    }
    window.scrollTo({top: 10, left: 0, behavior: "smooth"});
}
