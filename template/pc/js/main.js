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
                    $(this).parent().children().eq(1).slideUp(500);
                    $(this).find(".pull-icon").removeClass("la-angle-down");
                    $(this).find(".pull-icon").addClass("la-angle-right");
                } else {
                    var $ul = $(this).parent().children().eq(1);
                    if ($ul.css("display") == "none") {
                        $ul.slideDown(500);
                        var $pull = $(this).find(".pull-icon");
                        $pull.removeClass("la-angle-right");
                        $pull.addClass("la-angle-down");
                    } else {
                        $ul.slideUp(500);
                        var $pull = $(this).find(".pull-icon");
                        $pull.removeClass("la-angle-down");
                        $pull.addClass("la-angle-right");
                    }
                }
            }
        });
    });
});

$(".nav-li-a").click(function (e) {
    $(".nav-li-a").removeClass("nav-active");
    $(this).addClass("nav-active");
    var name = e.currentTarget.dataset.name;
    open_iframe(name);
});


function open_iframe(name) {
    if (name != "") {
        $(".main-iframe").attr("src", "./app/" + name + "/" + name + ".html");
    }
}