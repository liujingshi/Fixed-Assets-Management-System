var url_data = get_url();
new Vue({
    el: "#header_title",
    data: {
        icon: url_data.icon,
        title: url_data.title
    }
});

$('#table').bootstrapTable({
    url: 'data.json',
    local: "zh-cn",
    columns: [{
        field: 'name',
        title: '姓名'
    }, {
        field: 'age',
        title: '年龄'
    }, {
        field: 'sex',
        title: '性别'
    }],
    height: $(document).height() - 120,
    theadClasses: "thead-light",
    pagination: true
})