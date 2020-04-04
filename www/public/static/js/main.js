
var localVueObj = new Vue({  // 创建页面上面路径导航vue对象
    el: "#local",
    data: {
        local: [],
        nowName: ""
    }
});

function setLocal(local, nowName) {  // 设置路径导航
    localVueObj.local = local;
    localVueObj.nowName = nowName;
}
