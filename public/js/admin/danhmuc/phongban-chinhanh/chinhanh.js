function hide_agency_form() {
    $("#close_add_agency_button").css("display", "none");
    $("#add_agency_button").css("display", "block");
    $("#agency_form").css("display", "none");
    $(".close_update_button").css("display", "none");
    $(".open_update_button").css("display", "block");
    $("#form_id").val("");
    $("#form_ten").val("");
}

function hide_agency_update () {
    hide_agency_form();
    $(".close_update_button").css("display", "none");
    $(".open_update_button").css("display", "block");
}

function show_agency_form (length) {
    hide_agency_form();
    $("#close_add_agency_button").css("display", "block");
    $("#add_agency_button").css("display", "none");
    $("#agency_form").css("display", "flex");
    $("#form_id").val(length);
    $("#form_button").attr("onclick", "add_agency()").text("Thêm");
}

function show_agency_update (id, name) {
    const agency_id = Number(id);
    hide_agency_update();
    $("#agency_form").css("display", "flex");
    $(`#close_update_agency_button${id}`).css("display", "block");
    $(`#update_agency_button${id}`).css("display", "none");
    $("#form_id").val(id);
    $("#form_button").attr("onclick", `update_agency(${agency_id})`).text("Cập nhật");
    $("#form_ten").val(name);
}

async function add_agency () {
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
    if ($("#form_ten").val()) {
        const ten = $("#form_ten").val();
        const length = Number($("#form_id").val()) + 1;
        await $.ajax({
            url: "/danhmuc/chinhanh",
            method: "POST",
            data: {name: ten},
            success: function(result) {
                if(result == "success") {
                    $("#department").load("/danhmuc/chinhanh #list");
                    show_agency_form(length);
                    $("#agency_status").html("<p>Thêm chi nhánh thành công</p>");
                }
            }
        })
    }
}

async function update_agency (id) {
    const ten = $("#form_ten").val();
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}})
    await $.ajax({
        url: `/danhmuc/chinhanh/${id}`,
        method: 'POST',
        data: {
            name: ten,
        },
        success: function(result) {
            if(result == 'success') {
                $('#department').load('/danhmuc/chinhanh #list');
                hide_agency_update();
                $("#agency_status").html("<p>Cập nhật chi nhánh thành công</p>");
            }
        }
    })
}


