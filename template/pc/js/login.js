
var send_code = 0;
var send_time = 10;

var phone = new Vue({
    el: "#phone",
    methods: {
        send: function (e) {
            if (send_code == 0) {
                send_code = 1;
                e.target.innerHTML = "重新发送("+send_time+")";
                // 发送验证码
                var tmp = send_time;
                var time_worker = setInterval(function () {
                    tmp = tmp - 1;
                    if (tmp <= 0) {
                        send_code = 0;
                        e.target.innerHTML = "重新发送";
                        clearInterval(time_worker);
                    } else {
                        e.target.innerHTML = "重新发送("+tmp+")";
                    }
                }, 1000);
            }
        },
        do_login: function () {
            console.log("登录");
        }
    }
});
