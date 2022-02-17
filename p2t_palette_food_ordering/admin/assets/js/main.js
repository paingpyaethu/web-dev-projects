$(".show-sidebar-btn").click(function () {
    $(".aside").animate({marginLeft:0});
});
$(".hide-sidebar-btn").click(function () {
    $(".aside").animate({marginLeft:"-100%"});
});

$(".full-screen-btn").click(function () {
    let current = $(this).closest(".card");
    current.toggleClass("full-screen-card");
    if(current.hasClass("full-screen-card")){
        $(this).html(`<i class="fas fa-compress"></i>`);
    }else{
        $(this).html(`<i class="fas fa-expand"></i>`);
    }
});