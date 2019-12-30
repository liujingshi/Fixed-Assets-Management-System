$(".home-two-btn").click(function () {
    $(this).parent().find(".home-two-btn").removeClass("home-two-btn-active");
    $(this).addClass("home-two-btn-active");
});

$(".home-three-btn").click(function () {
    $(this).parent().find(".home-three-btn").removeClass("home-three-btn-active");
    $(this).addClass("home-three-btn-active");
});