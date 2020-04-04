
function get_url() {  // 得到URL参数
    var url = document.location.href;
    var urls = url.split("?");
    if (urls.length > 1) {
        var ps = urls[1].split("&");
        var data = {};
        for (var i in ps) {
            var item = ps[i].split("=");
            data[item[0]] = decodeURI(item[1]);
        }
        return data;
    }
    return false;
}

function alertError(msg) {  // 错误提醒
    if (msg == "depNoError") {
        layer.alert("部门编号已存在", {
            icon: 2,
            title: "错误"
        });
    } else if (msg == "posNoError") {
        layer.alert("职位编号已存在", {
            icon: 2,
            title: "错误"
        });
    } else if (msg == "upDepIdError") {
        layer.alert("上级部门不可以是本部门或总系统", {
            icon: 2,
            title: "错误"
        });
    }else if (msg == "depRootError") {
        layer.alert("系统总部门不可修改或删除", {
            icon: 2,
            title: "错误"
        });
    } else if (msg == "posRootError") {
        layer.alert("系统管理员不可修改或删除", {
            icon: 2,
            title: "错误"
        });
    } else if (msg == "nullError") {
        layer.alert("关键项不能为空", {
            icon: 2,
            title: "错误"
        });
    } else {
        layer.alert("未知错误", {
            icon: 2,
            title: "错误"
        });
    }
}
