var chart_pie_use = echarts.init(document.getElementById("chart_pie_use"));
var chart_pie_unuse = echarts.init(document.getElementById("chart_pie_unuse"));

// 在用资产饼状图
var chart_pie_use_option = {
    tooltip: {
        trigger: 'item',
        formatter: "{a} <br/>{b}: {c} ({d}%)",
        confine: true
    },
    series: [{
        name: '在用资产',
        type: 'pie',
        radius: ['50%', '70%'],
        avoidLabelOverlap: false,
        label: {
            normal: {
                show: false,
                position: 'center'
            },
            emphasis: {
                show: true,
                textStyle: {
                    fontSize: '16',
                    fontWeight: 'bold'
                }
            }
        },
        labelLine: {
            normal: {
                show: false
            }
        },
        data: [{
                value: 335,
                name: '电脑'
            },
            {
                value: 310,
                name: '对讲机'
            },
            {
                value: 234,
                name: '广告牌'
            },
            {
                value: 135,
                name: '书架'
            },
            {
                value: 1548,
                name: '投影'
            }
        ]
    }]
};

// 闲置资产饼状图
var chart_pie_unuse_option = {
    tooltip: {
        trigger: 'item',
        formatter: "{a} <br/>{b}: {c} ({d}%)",
        confine: true
    },
    series: [{
        name: '闲置资产',
        type: 'pie',
        radius: ['50%', '70%'],
        avoidLabelOverlap: false,
        label: {
            normal: {
                show: false,
                position: 'center'
            },
            emphasis: {
                show: true,
                textStyle: {
                    fontSize: '16',
                    fontWeight: 'bold'
                }
            }
        },
        labelLine: {
            normal: {
                show: false
            }
        },
        data: [{
                value: 360,
                name: '折叠椅'
            },
            {
                value: 260,
                name: '笔记本电脑'
            },
            {
                value: 10,
                name: '自动贩卖机'
            },
            {
                value: 100,
                name: '条幅'
            },
            {
                value: 60,
                name: '照相机'
            }
        ]
    }]
};

chart_pie_use.setOption(chart_pie_use_option);
chart_pie_unuse.setOption(chart_pie_unuse_option);