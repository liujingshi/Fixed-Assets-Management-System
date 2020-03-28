var send_code = 0;
var send_time = 9;

var phone = new Vue({
    el: "#phone",
    methods: {
        send: function (e) {
            var phone = $("#username").val();
            if(!(/^1[3456789]\d{9}$/.test(phone))){ 
                layer.msg("手机号码有误 请重填");  
            } else {
                if (send_code == 0) {
                    var captcha = $("#verify").val();
                    if (captcha == "") {
                        layer.msg("请输入验证码");
                    } else {
                        $.post("/login/index/checkCaptcha", {
                            captcha: captcha
                        }, function (data) {
                            if (data.code == 1) {
                                send_code = 1;
                                layer.msg("验证码发送成功 请注意查收");
                                e.target.innerHTML = "重新发送(" + send_time + ")";
                                // 发送验证码
                                var tmp = send_time;
                                var time_worker = setInterval(function () {
                                    tmp = tmp - 1;
                                    if (tmp <= 0) {
                                        send_code = 0;
                                        e.target.innerHTML = "重新发送";
                                        clearInterval(time_worker);
                                    } else {
                                        e.target.innerHTML = "重新发送(" + tmp + ")";
                                    }
                                }, 1000);
                            } else {
                                layer.msg("验证码输入错误");
                                reVerify();
                            }
                        });
                        
                    }
                } else {
                    layer.msg("不要着急");
                }
            }
        },
        do_login: function () {
            console.log("登录");
            document.location.href = "/";
        }
    }
});

function reVerify() {
    $(".verify-img").attr("src", $(".verify-img").attr("src"));
}

$(".verify-img").click(reVerify);