$(async function() {
    const windowHeight = window.innerHeight;
    $("header").css("height", windowHeight);

    await $.ajax({
        url: "/admin-layout",
        method: "GET",
        success: function(result) {
            $("head").prepend(`<meta name="csrf-token" content="${result['token']}">`);
            $("title").text(result['title'] + " | DHG Pharma");
            $("#avatar").append(`<p>${result['title']}</p>`)
        }
    })
})

function click_dropdown_menu (id) {
    const status = $(`#${id}>.dropdown_menu_headline`).hasClass("dropdown_menu_active");
    if (!status) {
        $(`#${id}>.dropdown_menu_headline`).addClass("dropdown_menu_active");
        $(`#${id}>.dropdown_item`).css("display", "flex");
    } else {
        $(`#${id}>.dropdown_menu_headline`).removeClass("dropdown_menu_active");
        $(`#${id}>.dropdown_item`).css("display", "none");
    }
}

