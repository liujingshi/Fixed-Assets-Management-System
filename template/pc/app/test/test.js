function test() {
    ljspopup({
        el: "#popup",
        title: "刘叔的弹出层"
    });
}

$('#table1').bootstrapTable({
    locale: "zh-cn",
    url: "data1.json",
    columns: [{
        field: 'name',
        title: '名称'
    }, {
        field: 'tag',
        title: '标签'
    }, {
        field: 'type',
        title: '类型'
    }, {
        field: "default",
        title: "默认"
    }, {
        field: "description",
        title: "描述"
    }],
    classes: "table table-striped table-bordered",
    theadClasses: "thead-light"
})

$('#table2').bootstrapTable({
    locale: "zh-cn",
    url: "data2.json",
    columns: [{
        field: 'name',
        title: '名称'
    }, {
        field: 'tag',
        title: '标签'
    }, {
        field: 'type',
        title: '类型'
    }, {
        field: "default",
        title: "默认"
    }, {
        field: "description",
        title: "描述"
    }],
    classes: "table table-striped table-bordered",
    theadClasses: "thead-light"
})