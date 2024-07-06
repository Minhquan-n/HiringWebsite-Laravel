
$(async function(){
    const windowHeight = window.innerHeight;
    $("header").css("height", windowHeight);
    await $.ajax({
        url: "/user_layout",
        method: "GET",
        success: function(result) {
            $("head").prepend(`<meta name="csrf-token" content="${result['token']}">`);
            $("title").text(result['title']);
            $("#avatar").append(`<p>${result['title']}</p>`);
        }
    })
})
