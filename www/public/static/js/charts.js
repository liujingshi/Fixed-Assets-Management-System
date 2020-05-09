var chart_pie_use = echarts.init(document.getElementById("chart_pie_use"));
var chart_pie_unuse = echarts.init(document.getElementById("chart_pie_unuse"));
var chart_pie_state = echarts.init(document.getElementById("chart_pie_state"));
var chart_bar_class = echarts.init(document.getElementById("chart_bar_class"));
var chart_bar_use = echarts.init(document.getElementById("chart_bar_use"));
var chart_line_use = echarts.init(document.getElementById("chart_line_use"));

// 在用资产饼状图
$.post("/app/home/chart/id/zy", {}, function (res) {
    var data = JSON.parse(res);
    var num = 0,
        price = 0;
    for (let i in data) {
        num += data[i].value;
        price += data[i].price;
    }
    $(".zy_num").html(num);
    $("#zy_price").html(price);
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
            data: data
        }]
    };
    chart_pie_use.setOption(chart_pie_use_option);
})

// 闲置资产饼状图
$.post("/app/home/chart/id/xz", {}, function (res) {
    var data = JSON.parse(res);
    var num = 0,
        price = 0;
    for (let i in data) {
        num += data[i].value;
        price += data[i].price;
    }
    $(".xz_num").html(num);
    $("#xz_price").html(price);
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
            data: data
        }]
    };
    chart_pie_unuse.setOption(chart_pie_unuse_option);
});

// 资产状态占比饼状图
$.post("/app/home/chart/id/zb", {}, function (res) {
    var data = JSON.parse(res);
    for (let i in data) {
        if (data[i].no == "SPZ") {
            $("#spz_num").html(data[i].value)
        }
    }
    var chart_pie_state_option = {
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)",
            confine: true
        },
        series: [{
            name: '资产状态占比',
            type: 'pie',
            radius: '70%',
            center: ['30%', '50%'],
            avoidLabelOverlap: false,
            label: {
                show: false
            },
            data: data
        }]
    };
    chart_pie_state.setOption(chart_pie_state_option);
});

// 资产分类统计柱状图
function showCateChart(path) {
    $.post("/app/home/chart/id/" + path, {}, function (res) {
        var data = JSON.parse(res);
        var xData = [];
        var yData = [];
        for (let i in data) {
            xData.push(data[i].name)
            yData.push(data[i].value)
        }
        var chart_bar_class_option = {
            color: ['#3398DB'],
            tooltip: {
                trigger: 'axis',
                axisPointer: { // 坐标轴指示器，坐标轴触发有效
                    type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis: [{
                type: 'category',
                data: xData,
                axisTick: {
                    alignWithLabel: true
                }
            }],
            yAxis: [{
                type: 'value'
            }],
            series: [{
                name: '资产分类统计',
                type: 'bar',
                barWidth: '60%',
                data: yData
            }]
        };
        chart_bar_class.setOption(chart_bar_class_option);
    });
}
showCateChart("catenum")
$("#cate_num_btn").click(() => {
    showCateChart("catenum")
})
$("#cate_price_btn").click(() => {
    showCateChart("cateprice")
})


// 资产状态占比饼状图
var chart_pie_state_option = {
    tooltip: {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)",
        confine: true
    },
    series: [{
        name: '资产状态占比',
        type: 'pie',
        radius: '70%',
        center: ['30%', '50%'],
        avoidLabelOverlap: false,
        label: {
            show: false
        },
        data: [{
                value: 2144,
                name: '闲置'
            },
            {
                value: 2354,
                name: '在用'
            },
            {
                value: 1530,
                name: '借出'
            },
            {
                value: 120,
                name: '维修'
            },
            {
                value: 50,
                name: '调拨中'
            },
            {
                value: 632,
                name: '报废'
            }
        ]
    }]
};

// 资产使用情况柱状图
var chart_bar_use_option = {
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'shadow'
        }
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    xAxis: [{
        type: 'category',
        data: ['2019-01', '2019-03', '2019-05', '2019-07', '2019-09', '2019-11'],
        axisTick: {
            alignWithLabel: true
        }
    }],
    yAxis: [{
        type: 'value'
    }],
    series: [{
        name: '资产使用情况',
        type: 'bar',
        barWidth: '60%',
        data: [40, 70, 200, 334, 390, 330]
    }]
};

// 耗材领用情况折线图
var chart_line_use_option = {
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'line'
        }
    },
    xAxis: {
        type: 'category',
        data: ['2019-01', '2019-03', '2019-05', '2019-07', '2019-09', '2019-11']
    },
    yAxis: {
        type: 'value'
    },
    series: [{
        name: '耗材领用情况',
        data: [820, 932, 901, 934, 1290, 1330],
        type: 'line'
    }]
};




chart_bar_use.setOption(chart_bar_use_option);
chart_line_use.setOption(chart_line_use_option);