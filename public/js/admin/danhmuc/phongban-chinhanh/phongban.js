function hide_department_form() {
    $("#close_add_department_button").css("display", "none");
    $("#add_department_button").css("display", "block");
    $("#department_form").css("display", "none");
    $(".close_update_button").css("display", "none");
    $(".open_update_button").css("display", "block");
    $("#form_id").val("");
    $("#form_ten").val("");
}

function hide_department_update () {
    hide_department_form();
    $(".close_update_button").css("display", "none");
    $(".open_update_button").css("display", "block");
}

function show_department_form (length) {
    hide_department_form();
    $("#close_add_department_button").css("display", "block");
    $("#add_department_button").css("display", "none");
    $("#department_form").css("display", "flex");
    $("#form_id").val(length);
    $("#form_button").attr("onclick", "add_department()").text("Thêm");
}

function show_department_update (id, name) {
    const department_id = Number(id);
    hide_department_update();
    $("#department_form").css("display", "flex");
    $(`#close_update_department_button${id}`).css("display", "block");
    $(`#update_department_button${id}`).css("display", "none");
    $("#form_id").val(id);
    $("#form_button").attr("onclick", `update_department(${department_id})`).text("Cập nhật");
    $("#form_ten").val(name);
}

async function add_department () {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
    if ($("#form_ten").val()) {
        const ten = $("#form_ten").val();
        const length = Number($("#form_id").val()) + 1;
        await $.ajax({
            url: "/danhmuc/phongban",
            method: "POST",
            data: {name: ten},
            success: function(result) {
                if(result == "success") {
                    $("#department").load("/danhmuc/phongban #list");
                    show_department_form(length);
                    $("#department_status").html("<p>Thêm phòng ban thành công</p>");
                }
            }
        })
    }
}

async function update_department (id) {
    const ten = $("#form_ten").val();
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
    await $.ajax({
        url: `/danhmuc/phongban/${id}`,
        method: 'POST',
        data: {
            name: ten,
        },
        success: function(result) {
            if(result == 'success') {
                $('#department').load('/danhmuc/phongban #list');
                hide_department_update();
                $("#department_status").html("<p>Cập nhật phòng ban thành công</p>");
            }
        }
    })
}


