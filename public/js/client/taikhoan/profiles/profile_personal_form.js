
function upload_avatar () {
    const avatar_file = $("#avatar_input")[0].files[0];
    var imgPath = $("#avatar_input")[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    $("#avatar_holder").replaceWith('<div id="avatar_holder"></div>');
    var image_holder = $("#avatar_holder");
    image_holder.empty();
    if (extn == "png" || extn == "jpg" || extn == "jpeg") {
        if (typeof(FileReader) != "undefined") {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("<img />", {"src": e.target.result}).appendTo(image_holder);
            }
            image_holder.show();
            reader.readAsDataURL(avatar_file);
        }
    }
}

async function open_district_list (id) {
    const tinhthanh = $(`#${id}_province`).val();
    $(`#${id}_district`).replaceWith(`<select name="${id}_district" id="${id}_district" onchange="open_ward_list('${id}')"><option value="0">Chưa xác định</option></select>`)
    if (tinhthanh !== "0") {
        await $.get("/taikhoan/hoso/capnhat/quan", {province: tinhthanh} )
        .done(function(data) {
            data.forEach (element => {
                $(`#${id}_district`).append(`<option value="${element['id_quanhuyen']}">${element['tenquanhuyen']}</option>`)
            });
        })
    }
}

async function open_ward_list (id) {
    const tinhthanh = $(`#${id}_province`).val();
    const quanhuyen = $(`#${id}_district`).val();
    $(`#${id}_ward`).replaceWith(`<select name="${id}_ward" id="${id}_ward"><option value="0">Chưa xác định</option></select>`)
    if (tinhthanh !== "0" && quanhuyen !== "0") {
        await $.get("/taikhoan/hoso/capnhat/phuong", {province: tinhthanh, district: quanhuyen})
        .done(function(data) {
            data.forEach (element => {
                $(`#${id}_ward`).append(`<option value="${element['id_phuongxa']}">${element['tenphuongxa']}</option>`)
            });
        })
    }
}

