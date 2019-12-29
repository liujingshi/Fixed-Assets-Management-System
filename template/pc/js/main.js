
var title = new Vue({
    el: "title",
    data: {
        title: "固定资产管理系统"
    }
});

var tmp = new Vue({
    el: "#tmp",
    methods: {
        change: function () {
            title.title = "高校固定资产管理系统";
        }
    }
});
