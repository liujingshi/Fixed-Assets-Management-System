/**
 * 仿Mac风格弹出层JS
 * 需要引入jQuery
 * Made in 刘叔
 * GitHub: https://github.com/liujingshi
 * Date: 2020-01-02
 */

var popup_data = [];

// 监听关闭按钮
$(document).on("click", ".ljs-panel-header-close", function () {
    var $panel = $(this).parent().parent().parent();
    var width = $panel.width();
    var height = $panel.height();
    var width_out = width / 10;
    var height_out = height / 10;
    $(".mask").hide();
    $panel.animate({
        width: "+=" + width_out + "px",
        height: "+=" + height_out + "px",
        top: "-=" + width_out / 2 + "px",
        left: "-=" + height_out / 2 + "px"
    }, 100).animate({
        width: 0,
        height: 0,
        top: "+=" + (height + height_out) / 2 + "px",
        left: "+=" + (width + width_out) / 2 + "px"
    }, 150, function () {
        $panel.hide();
        if ($panel.parent().attr("class") != undefined && $panel.parent().attr("class").indexOf("ljs-panel-min-area") >= 0) {
            $panel.css("position", "fixed");
            $panel.parent().remove($panel);
            $("body").append($panel);
        }
    });
});

// 监听最小化按钮
$(document).on("click", ".ljs-panel-header-min", function () {
    if (!is_disabled($(this))) {
        if (el_exist(".ljs-panel-min-area")) {
            $(".ljs-panel-min-area").show();
        } else {
            var ljs_panel_min_area = document.createElement("div");
            $(ljs_panel_min_area).addClass("ljs-panel-min-area");
            $("body").append(ljs_panel_min_area);
        }
        var $panel = $(this).parent().parent().parent();
        if ($panel.css("position") == "static") { // 还原
            $panel.parent().remove($panel);
            $("body").append($panel);
            panel_recovery($panel);
        } else { // 最小化
            var min_width = 200;
            var min_line_height = 38;
            var window_width = $(window).width();
            var window_height = $(window).height();
            var width = $panel.width();
            var height = $panel.height();
            var width_out = width / 10;
            var height_out = height / 10;
            var now_number = $(".ljs-panel-min-area").children().length;
            var max_number = Math.floor(window_width / min_width);
            var c = now_number / max_number;
            var now_line = c < Math.floor(c) ? Math.floor(c) : Math.floor(c) + 1;
            var now_col = (now_number % max_number) + 1;
            $(".mask").hide();
            var sign = get_sign($panel);
            var index = sign_find(sign);
            popup_data[index].can_move = false;
            $panel.animate({
                width: "+=" + width_out + "px",
                height: "+=" + height_out + "px",
                top: "-=" + width_out / 2 + "px",
                left: "-=" + height_out / 2 + "px"
            }, 100).animate({
                width: 0,
                height: 0,
                top: (window_height - (now_line * min_line_height - min_line_height / 2)) + "px",
                left: (window_width - (now_col * min_width - min_width / 2)) + "px"
            }, 150, function () {
                $panel.css("position", "static");
                $(".ljs-panel-min-area").append($panel);
                $panel.find(".ljs-panel-header-title").css("justify-content", "flex-start");
            }).animate({
                width: min_width + "px",
                height: min_line_height + "px"
            }, 100);
        }
    }
});

// 监听最大化按钮
$(document).on("click", ".ljs-panel-header-max", function () {
    if (!is_disabled($(this))) {
        var $panel = $(this).parent().parent().parent();
        var window_width = $(window).width();
        var window_height = $(window).height();
        if ($panel.css("position") == "static" || (window_height == $panel.height() && window_width == $panel.width())) { // 还原
            panel_recovery($panel);
        } else { // 最大化
            $(".mask").hide();
            var sign = get_sign($panel);
            var index = sign_find(sign);
            popup_data[index].can_move = false;
            $panel.animate({
                width: window_width + "px",
                height: window_height + "px",
                top: 0,
                left: 0
            }, 150);
        }
    }
});

// 最大化最小化还原
function panel_recovery($panel) {
    $panel.css("position", "fixed");
    var sign = get_sign($panel);
    var index = sign_find(sign);
    var width = popup_data[index].width;
    var height = popup_data[index].height;
    var window_width = $(window).width();
    var window_height = $(window).height();
    var top = popup_data[index].top >= 0 ? (popup_data[index].top + popup_data[index].height / 2) : window_height / 2;
    var left = popup_data[index].left >= 0 ? (popup_data[index].left + popup_data[index].width / 2) : window_width / 2;
    var width_out = width / 10;
    var height_out = height / 10;
    if (popup_data[index].mask) {
        $(".mask").show();
    }
    popup_data[index].can_move = true;
    $panel.animate({
        width: 0,
        height: 0,
        top: top,
        left: left
    }, 100, function () {
        $panel.find(".ljs-panel-header-title").css("justify-content", "center");
    }).animate({
        width: "+=" + (width + width_out) + "px",
        height: "+=" + (height + height_out) + "px",
        top: "-=" + (height + height_out) / 2 + "px",
        left: "-=" + (width + width_out) / 2 + "px"
    }, 150).animate({
        width: "-=" + width_out + "px",
        height: "-=" + height_out + "px",
        top: "+=" + height_out / 2 + "px",
        left: "+=" + width_out / 2 + "px"
    }, 100);
}

// 监听按下
$(document).on("mousedown", ".ljs-panel-header-title", function (e) {
    var sign = get_sign($(this).parent().parent());
    var index = sign_find(sign);
    if (popup_data[index].can_move && popup_data[index].move) {
        var startX = e.pageX;
        var startY = e.pageY;
        var $panel_start = $(this).parent().parent();
        var panel_startTop = $panel_start.position().top;
        var panel_startLeft = $panel_start.position().left;
        $(this).on("mousemove", function (e) {
            var $panel = $(this).parent().parent();
            if ((panel_startTop + (e.pageY - startY)) > 0 && (panel_startTop + (e.pageY - startY) + $panel.height()) < $(window).height()) {
                $panel.css({
                    top: (panel_startTop + (e.pageY - startY)) + "px"
                });
            }
            if ((panel_startLeft + (e.pageX - startX)) > 0 && (panel_startLeft + (e.pageX - startX) + $panel.width()) < $(window).width()) {
                $panel.css({
                    left: (panel_startLeft + (e.pageX - startX)) + "px"
                });
            }
        });
    }
});

// 监听抬起
$(document).on("mouseup", ".ljs-panel-header-title", function () {
    $(this).off("mousemove");
});

// 弹出显示方法
function panel_show(data) {
    $panel = $("." + data.sign);
    if ($panel.css("display") == "none") {
        if (!el_exist(".mask")) {
            var mask = document.createElement("div");
            $(mask).addClass("mask");
            $("body").append(mask);
        }
        if (data.mask) {
            $(".mask").show();
        }
        var width = data.width;
        var height = data.height;
        var window_width = $(window).width();
        var window_height = $(window).height();
        var top = data.top >= 0 ? (data.top + (data.height / 2)) : window_height / 2;
        var left = data.left >= 0 ? (data.left + (data.width / 2)) : window_width / 2;
        var width_out = width / 10;
        var height_out = height / 10;
        $panel.css({
            width: 0,
            height: 0,
            top: top,
            left: left,
            display: "flex"
        }).animate({
            width: "+=" + (width + width_out) + "px",
            height: "+=" + (height + height_out) + "px",
            top: "-=" + (height + height_out) / 2 + "px",
            left: "-=" + (width + width_out) / 2 + "px"
        }, 150).animate({
            width: "-=" + width_out + "px",
            height: "-=" + height_out + "px",
            top: "+=" + height_out / 2 + "px",
            left: "+=" + width_out / 2 + "px"
        }, 100);
    }
}


/**
 * 主体调用方法
 * 弹出层框架搭建
 * @param {弹出层参数} data 
 * {
 *   el: "", 元素或内容, eg: #id .class <p>Hello World!</p>
 *   title: "", 标题文字,
 *   width: 400, 宽度
 *   height: 300, 长度
 * }
 */
function ljspopup(data = {}) {
    var panel_sign = "ljs-sign-" + $.md5(JSON.stringify(data));
    var index = sign_find(panel_sign);
    if (index < 0) {
        var new_data = {
            el: data.el ? data.el : "",
            title: data.title ? data.title : "",
            width: data.width || data.width == 0 ? data.width : -1,
            height: data.height || data.height == 0 ? data.height : -1,
            top: data.top || data.top == 0 ? data.top : -1,
            left: data.left || data.left == 0 ? data.left : -1,
            min: data.min != undefined ? data.min : true,
            max: data.max != undefined ? data.max : true,
            mask: data.mask != undefined ? data.mask : true,
            move: data.move != undefined ? data.move : true,
            can_move: true,
            sign: panel_sign
        };
        var ljs_panel = document.createElement("div");
        var ljs_panel_header = document.createElement("div");
        var ljs_panel_header_three_btn = document.createElement("div");
        var ljs_panel_header_close = document.createElement("div");
        var ljs_panel_header_min = document.createElement("div");
        var ljs_panel_header_max = document.createElement("div");
        var ljs_panel_header_title = document.createElement("div");
        var ljs_panel_body = document.createElement("div");
        $(ljs_panel).addClass("ljs-panel");
        $(ljs_panel).addClass(panel_sign);
        $(ljs_panel_header).addClass("ljs-panel-header");
        $(ljs_panel_header_three_btn).addClass("ljs-panel-header-three-btn");
        $(ljs_panel_header_close).addClass("ljs-panel-header-close");
        $(ljs_panel_header_min).addClass("ljs-panel-header-min");
        if (!new_data.min) {
            $(ljs_panel_header_min).addClass("ljs-panel-header-btn-disabled");
        }
        $(ljs_panel_header_max).addClass("ljs-panel-header-max");
        if (!new_data.max) {
            $(ljs_panel_header_max).addClass("ljs-panel-header-btn-disabled");
        }
        $(ljs_panel_header_title).addClass("ljs-panel-header-title");
        if (!new_data.move) {
            $(ljs_panel_header_title).css("cursor", "default")
        }
        $(ljs_panel_body).addClass("ljs-panel-body");
        $(ljs_panel_header_close).html("×");
        $(ljs_panel_header_min).html("﹣");
        $(ljs_panel_header_max).html("﹢");
        $(ljs_panel_header_title).html(new_data.title);
        $(ljs_panel_body).append($(new_data.el));
        $(ljs_panel_header_three_btn).append(ljs_panel_header_close);
        $(ljs_panel_header_three_btn).append(ljs_panel_header_min);
        $(ljs_panel_header_three_btn).append(ljs_panel_header_max);
        $(ljs_panel_header).append(ljs_panel_header_three_btn);
        $(ljs_panel_header).append(ljs_panel_header_title);
        $(ljs_panel).append(ljs_panel_header);
        $(ljs_panel).append(ljs_panel_body);
        $("body").append(ljs_panel);
        $(ljs_panel).find(".ljs-panel-body").children().show();
        new_data.width = new_data.width < 0 ? $(ljs_panel).width() : new_data.width;
        new_data.height = new_data.height < 0 ? $(ljs_panel).height() : new_data.height;
        popup_data.push(new_data);
        panel_show(new_data);
    } else {
        panel_show(popup_data[index]);
    }
}

// 判断按钮是否被禁用
function is_disabled($element) {
    var classes = $element.attr("class");
    var class_rows = classes.split(" ");
    if (class_rows.indexOf("ljs-panel-header-btn-disabled") < 0) {
        return false
    } else {
        return true;
    }
}

// 判断元素是否存在
function el_exist(element) {
    if ($(element).length > 0) {
        return true;
    } else {
        return false;
    }
}

// 查找实例
function sign_find(sign) {
    for (var i in popup_data) {
        if (popup_data[i].sign == sign) {
            return i;
        }
    }
    return -1;
}

// 得到sign
function get_sign($element) {
    var classes = $element.attr("class");
    var class_rows = classes.split(" ");
    for (var i in class_rows) {
        if (class_rows[i].indexOf("ljs-sign-") >= 0) {
            return class_rows[i];
        }
    }
    return "ljs-sign-not-found";
}


/**
 * ================================================================
 * 究极无敌分割线 以下为jquery.md5.js
 * ================================================================
 */
(function ($) {

    var rotateLeft = function (lValue, iShiftBits) {
        return (lValue << iShiftBits) | (lValue >>> (32 - iShiftBits));
    }

    var addUnsigned = function (lX, lY) {
        var lX4, lY4, lX8, lY8, lResult;
        lX8 = (lX & 0x80000000);
        lY8 = (lY & 0x80000000);
        lX4 = (lX & 0x40000000);
        lY4 = (lY & 0x40000000);
        lResult = (lX & 0x3FFFFFFF) + (lY & 0x3FFFFFFF);
        if (lX4 & lY4) return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
        if (lX4 | lY4) {
            if (lResult & 0x40000000) return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
            else return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
        } else {
            return (lResult ^ lX8 ^ lY8);
        }
    }

    var F = function (x, y, z) {
        return (x & y) | ((~x) & z);
    }

    var G = function (x, y, z) {
        return (x & z) | (y & (~z));
    }

    var H = function (x, y, z) {
        return (x ^ y ^ z);
    }

    var I = function (x, y, z) {
        return (y ^ (x | (~z)));
    }

    var FF = function (a, b, c, d, x, s, ac) {
        a = addUnsigned(a, addUnsigned(addUnsigned(F(b, c, d), x), ac));
        return addUnsigned(rotateLeft(a, s), b);
    };

    var GG = function (a, b, c, d, x, s, ac) {
        a = addUnsigned(a, addUnsigned(addUnsigned(G(b, c, d), x), ac));
        return addUnsigned(rotateLeft(a, s), b);
    };

    var HH = function (a, b, c, d, x, s, ac) {
        a = addUnsigned(a, addUnsigned(addUnsigned(H(b, c, d), x), ac));
        return addUnsigned(rotateLeft(a, s), b);
    };

    var II = function (a, b, c, d, x, s, ac) {
        a = addUnsigned(a, addUnsigned(addUnsigned(I(b, c, d), x), ac));
        return addUnsigned(rotateLeft(a, s), b);
    };

    var convertToWordArray = function (string) {
        var lWordCount;
        var lMessageLength = string.length;
        var lNumberOfWordsTempOne = lMessageLength + 8;
        var lNumberOfWordsTempTwo = (lNumberOfWordsTempOne - (lNumberOfWordsTempOne % 64)) / 64;
        var lNumberOfWords = (lNumberOfWordsTempTwo + 1) * 16;
        var lWordArray = Array(lNumberOfWords - 1);
        var lBytePosition = 0;
        var lByteCount = 0;
        while (lByteCount < lMessageLength) {
            lWordCount = (lByteCount - (lByteCount % 4)) / 4;
            lBytePosition = (lByteCount % 4) * 8;
            lWordArray[lWordCount] = (lWordArray[lWordCount] | (string.charCodeAt(lByteCount) << lBytePosition));
            lByteCount++;
        }
        lWordCount = (lByteCount - (lByteCount % 4)) / 4;
        lBytePosition = (lByteCount % 4) * 8;
        lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80 << lBytePosition);
        lWordArray[lNumberOfWords - 2] = lMessageLength << 3;
        lWordArray[lNumberOfWords - 1] = lMessageLength >>> 29;
        return lWordArray;
    };

    var wordToHex = function (lValue) {
        var WordToHexValue = "",
            WordToHexValueTemp = "",
            lByte, lCount;
        for (lCount = 0; lCount <= 3; lCount++) {
            lByte = (lValue >>> (lCount * 8)) & 255;
            WordToHexValueTemp = "0" + lByte.toString(16);
            WordToHexValue = WordToHexValue + WordToHexValueTemp.substr(WordToHexValueTemp.length - 2, 2);
        }
        return WordToHexValue;
    };

    var uTF8Encode = function (string) {
        string = string.replace(/\x0d\x0a/g, "\x0a");
        var output = "";
        for (var n = 0; n < string.length; n++) {
            var c = string.charCodeAt(n);
            if (c < 128) {
                output += String.fromCharCode(c);
            } else if ((c > 127) && (c < 2048)) {
                output += String.fromCharCode((c >> 6) | 192);
                output += String.fromCharCode((c & 63) | 128);
            } else {
                output += String.fromCharCode((c >> 12) | 224);
                output += String.fromCharCode(((c >> 6) & 63) | 128);
                output += String.fromCharCode((c & 63) | 128);
            }
        }
        return output;
    };

    $.extend({
        md5: function (string) {
            var x = Array();
            var k, AA, BB, CC, DD, a, b, c, d;
            var S11 = 7,
                S12 = 12,
                S13 = 17,
                S14 = 22;
            var S21 = 5,
                S22 = 9,
                S23 = 14,
                S24 = 20;
            var S31 = 4,
                S32 = 11,
                S33 = 16,
                S34 = 23;
            var S41 = 6,
                S42 = 10,
                S43 = 15,
                S44 = 21;
            string = uTF8Encode(string);
            x = convertToWordArray(string);
            a = 0x67452301;
            b = 0xEFCDAB89;
            c = 0x98BADCFE;
            d = 0x10325476;
            for (k = 0; k < x.length; k += 16) {
                AA = a;
                BB = b;
                CC = c;
                DD = d;
                a = FF(a, b, c, d, x[k + 0], S11, 0xD76AA478);
                d = FF(d, a, b, c, x[k + 1], S12, 0xE8C7B756);
                c = FF(c, d, a, b, x[k + 2], S13, 0x242070DB);
                b = FF(b, c, d, a, x[k + 3], S14, 0xC1BDCEEE);
                a = FF(a, b, c, d, x[k + 4], S11, 0xF57C0FAF);
                d = FF(d, a, b, c, x[k + 5], S12, 0x4787C62A);
                c = FF(c, d, a, b, x[k + 6], S13, 0xA8304613);
                b = FF(b, c, d, a, x[k + 7], S14, 0xFD469501);
                a = FF(a, b, c, d, x[k + 8], S11, 0x698098D8);
                d = FF(d, a, b, c, x[k + 9], S12, 0x8B44F7AF);
                c = FF(c, d, a, b, x[k + 10], S13, 0xFFFF5BB1);
                b = FF(b, c, d, a, x[k + 11], S14, 0x895CD7BE);
                a = FF(a, b, c, d, x[k + 12], S11, 0x6B901122);
                d = FF(d, a, b, c, x[k + 13], S12, 0xFD987193);
                c = FF(c, d, a, b, x[k + 14], S13, 0xA679438E);
                b = FF(b, c, d, a, x[k + 15], S14, 0x49B40821);
                a = GG(a, b, c, d, x[k + 1], S21, 0xF61E2562);
                d = GG(d, a, b, c, x[k + 6], S22, 0xC040B340);
                c = GG(c, d, a, b, x[k + 11], S23, 0x265E5A51);
                b = GG(b, c, d, a, x[k + 0], S24, 0xE9B6C7AA);
                a = GG(a, b, c, d, x[k + 5], S21, 0xD62F105D);
                d = GG(d, a, b, c, x[k + 10], S22, 0x2441453);
                c = GG(c, d, a, b, x[k + 15], S23, 0xD8A1E681);
                b = GG(b, c, d, a, x[k + 4], S24, 0xE7D3FBC8);
                a = GG(a, b, c, d, x[k + 9], S21, 0x21E1CDE6);
                d = GG(d, a, b, c, x[k + 14], S22, 0xC33707D6);
                c = GG(c, d, a, b, x[k + 3], S23, 0xF4D50D87);
                b = GG(b, c, d, a, x[k + 8], S24, 0x455A14ED);
                a = GG(a, b, c, d, x[k + 13], S21, 0xA9E3E905);
                d = GG(d, a, b, c, x[k + 2], S22, 0xFCEFA3F8);
                c = GG(c, d, a, b, x[k + 7], S23, 0x676F02D9);
                b = GG(b, c, d, a, x[k + 12], S24, 0x8D2A4C8A);
                a = HH(a, b, c, d, x[k + 5], S31, 0xFFFA3942);
                d = HH(d, a, b, c, x[k + 8], S32, 0x8771F681);
                c = HH(c, d, a, b, x[k + 11], S33, 0x6D9D6122);
                b = HH(b, c, d, a, x[k + 14], S34, 0xFDE5380C);
                a = HH(a, b, c, d, x[k + 1], S31, 0xA4BEEA44);
                d = HH(d, a, b, c, x[k + 4], S32, 0x4BDECFA9);
                c = HH(c, d, a, b, x[k + 7], S33, 0xF6BB4B60);
                b = HH(b, c, d, a, x[k + 10], S34, 0xBEBFBC70);
                a = HH(a, b, c, d, x[k + 13], S31, 0x289B7EC6);
                d = HH(d, a, b, c, x[k + 0], S32, 0xEAA127FA);
                c = HH(c, d, a, b, x[k + 3], S33, 0xD4EF3085);
                b = HH(b, c, d, a, x[k + 6], S34, 0x4881D05);
                a = HH(a, b, c, d, x[k + 9], S31, 0xD9D4D039);
                d = HH(d, a, b, c, x[k + 12], S32, 0xE6DB99E5);
                c = HH(c, d, a, b, x[k + 15], S33, 0x1FA27CF8);
                b = HH(b, c, d, a, x[k + 2], S34, 0xC4AC5665);
                a = II(a, b, c, d, x[k + 0], S41, 0xF4292244);
                d = II(d, a, b, c, x[k + 7], S42, 0x432AFF97);
                c = II(c, d, a, b, x[k + 14], S43, 0xAB9423A7);
                b = II(b, c, d, a, x[k + 5], S44, 0xFC93A039);
                a = II(a, b, c, d, x[k + 12], S41, 0x655B59C3);
                d = II(d, a, b, c, x[k + 3], S42, 0x8F0CCC92);
                c = II(c, d, a, b, x[k + 10], S43, 0xFFEFF47D);
                b = II(b, c, d, a, x[k + 1], S44, 0x85845DD1);
                a = II(a, b, c, d, x[k + 8], S41, 0x6FA87E4F);
                d = II(d, a, b, c, x[k + 15], S42, 0xFE2CE6E0);
                c = II(c, d, a, b, x[k + 6], S43, 0xA3014314);
                b = II(b, c, d, a, x[k + 13], S44, 0x4E0811A1);
                a = II(a, b, c, d, x[k + 4], S41, 0xF7537E82);
                d = II(d, a, b, c, x[k + 11], S42, 0xBD3AF235);
                c = II(c, d, a, b, x[k + 2], S43, 0x2AD7D2BB);
                b = II(b, c, d, a, x[k + 9], S44, 0xEB86D391);
                a = addUnsigned(a, AA);
                b = addUnsigned(b, BB);
                c = addUnsigned(c, CC);
                d = addUnsigned(d, DD);
            }
            var tempValue = wordToHex(a) + wordToHex(b) + wordToHex(c) + wordToHex(d);
            return tempValue.toLowerCase();
        }
    });
})(jQuery);