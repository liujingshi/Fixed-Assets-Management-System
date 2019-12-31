var nav_left = new Vue({
    el: "#nav_left",
    data: {
        navs: nav_left_data
    }
});

$(".nav-pull").click(function () {
    var that = this;
    $(this).parent().parent().children().each(function () {
        $(this).children().each(function () {
            var cs = $(this).attr("class");
            var css = cs.split(" ");
            if (css.indexOf("nav-pull") >= 0) {
                if (this != that) {
                    $(this).parent().children().eq(1).css("display", "none");
                    $(this).find(".pull-icon").removeClass("la-angle-down");
                    $(this).find(".pull-icon").addClass("la-angle-right");
                } else {
                    var $ul = $(this).parent().children().eq(1);
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
                }
            }
        });
    });
});