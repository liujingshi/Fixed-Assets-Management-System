$(".nav-pull").click(function () {
    var that = this;
    $(".nav-pull").each(function () {
        if (this != that) {
            $(this).parent().find(".nav-ul-son").css("display", "none");
            $(this).find(".pull-icon").removeClass("la-angle-down");
            $(this).find(".pull-icon").addClass("la-angle-right");
        }
    });
    var $ul = $(this).parent().find(".nav-ul-son");
    if ($ul.css("display") == "none") {
        $ul.css("display", "flex");
        var $pull = $(this).find(".pull-icon");
        $pull.removeClass("la-angle-right");
        $pull.addClass("la-angle-down");
    } else {
        $ul.css("display", "none");
        var $pull = $(this).find(".pull-icon");
        $pull.removeClass("la-angle-down");
        $pull.addClass("la-angle-right");
    }
});