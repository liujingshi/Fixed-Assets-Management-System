<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:98:"E:\code\git\Fixed-Assets-Management-System\www\public/../application/app\view\blapprove\index.html";i:1589032654;s:80:"E:\code\git\Fixed-Assets-Management-System\www\application\common\view\base.html";i:1586071758;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>领用归还审批 - 高校固定资产管理系统</title>

    <link rel="stylesheet" href="/static/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/gijgo/css/gijgo.min.css">
    <link rel="stylesheet" href="/static/common/common.css">
    <link rel="stylesheet" href="/static/common/ljspopup.css">
    <link rel="stylesheet" href="/static/css/main.css">

    

</head>

<body>

    <div class="main">

        <!-- 左侧导航开始 -->
        <div class="main-left hidden-xs">

            <div class="nav-left">

                <div class="nav-left-logo"></div>

                <div class="nav-left-content"></div>

            </div>

        </div>
        <!-- 左侧导航结束 -->

        <div class="main-right">

            <!-- 左顶部导航开始 -->
            <div class="nav-top">

                <ol class="breadcrumb nav-top-left" id="local">
                    <li class="breadcrumb-item"><a href="/app/home/index">固定资产管理系统</a></li>
                    <li class="breadcrumb-item" v-for="item in local" v-html="item"></li>
                    <li class="breadcrumb-item active" aria-current="page" v-html="nowName"></li>
                </ol>

                <a href="javascript:;" class="nav-top-right nav-top-right-first">
                    <i class="las la-envelope"></i>
                    <span>通知</span>
                    <span class="badge message-num">6</span>
                </a>
                <a href="javascript:;" class="nav-top-right">
                    <i class="<?php echo $uHead; ?>"></i>
                    <span><?php echo $uName; ?></span>
                </a>
                <a href="/app/home/logout" class="nav-top-right">
                    <i class="las la-sign-out-alt"></i>
                    <span>登出</span>
                </a>

            </div>
            <!-- 顶部导航结束 -->

            <!-- 主体内容开始 -->
            <div class="content">
                <!-- <iframe class="main-iframe" src="" frameborder="0"></iframe> -->
                
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="home-panel">
                <div class="home-panel-header">
                    <i class="las la-stamp"></i>
                    <span>领用归还审批</span>
                </div>
                <div class="home-panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="table" lay-filter="table"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

            </div>
            <!-- 主体内容结束 -->

            <!-- 底部文字开始 -->
            <div class="nav-bottom">
                Copyright © 2019 - 2020 百里刘叔 版权所有.
            </div>
            <!-- 底部文字结束 -->

        </div>

    </div>

</body>

<script src="/static/jquery/jquery-3.4.1.min.js"></script>
<script src="/static/vue/vue.min.js"></script>
<script src="/static/vue/axios.min.js"></script>
<script src="/static/bootstrap/js/bootstrap.min.js"></script>
<script src="/static/echarts/echarts.min.js"></script>
<script src="/static/layui/layui.js"></script>
<script src="/static/gijgo/js/gijgo.min.js"></script>
<script src="/static/common/ljspopup.js"></script>
<script src="/static/common/common.js"></script>
<script src="/static/js/nav.js"></script>
<script src="/static/js/main.js"></script>


<script type="text/html" id="tableToolbar">
    <div class="layui-btn-container">
        <button class="layui-btn btn btn-success" lay-event="passes">通过选中项目</button>
        <button class="layui-btn btn btn-danger" lay-event="notpasses">不通过选中项目</button>
    </div>
</script>
<script type="text/html" id="tableBar">
    <a class="layui-btn btn btn-success btn-sm cw" lay-event="pass">通过</a>
    <a class="layui-btn btn btn-danger btn-sm cw" lay-event="notpass">不通过</a>
</script>
<script>
    var pageName = "blapprove";
    var pageUrl = "/app/" + pageName + "/";
    update_navs(pageName);
    setLocal(["我的审批"], "领用归还");
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    var layer, table;
    /*
     * layui开始
     */
    layui.use(['layer', 'table', 'laydate'], function () {
        layer = layui.layer;
        table = layui.table;

        table.render({ // 创建表格
            elem: '#table',
            height: 'full-260',
            url: pageUrl + 'select',
            page: true,
            toolbar: '#tableToolbar',
            limit: 10,
            cols: [
                [ // 表头
                    {
                        type: "checkbox",
                        width: "5%"
                    },
                    {
                        field: 'p_name',
                        title: '领用人',
                        width: "10%"
                    }, {
                        field: 'as_name',
                        title: '领用资产',
                        width: "15%"
                    }, {
                        field: 'local_name',
                        title: '资产地点',
                        width: "10%"
                    }, {
                        field: 'cate_name',
                        title: '资产分类',
                        width: "10%"
                    }, {
                        field: 'sta_name',
                        title: '资产状态',
                        width: "10%"
                    }, {
                        field: 'b_time',
                        title: '领用时间',
                        width: "15%"
                    }, {
                        field: 'l_time',
                        title: '归还时间',
                        width: "15%"
                    }, {
                        fixed: 'right',
                        width: "10%",
                        align: 'center',
                        toolbar: '#tableBar',
                        title: '操作',
                    }
                ]
            ]
        });

        table.on('tool(table)', function (obj) {  // 表内时间监听
            var data = obj.data;
            var layEvent = obj.event;
            var tr = obj.tr;

            if (layEvent === 'pass') {
                commonRequest("pass", {"bl_id": data.bl_id}, "通过");
            } else if (layEvent === 'notpass') {
                commonRequest("notpass", {"bl_id": data.bl_id}, "不通过");
            }
        });

        table.on('toolbar(table)', function (obj) { // 表头事件监听
            var checkStatus = table.checkStatus(obj.config.id);
            switch (obj.event) {
                case 'passes':
                    var checkStatus = table.checkStatus('table'),
                        data = checkStatus.data;
                    layer.confirm('确定要通过选中的这' + data.length + '个项目吗？', {
                        title: "提醒",
                        btn: ['确定', '取消'],
                    }, function (index) {
                        commonRequest("passes", {
                            data: JSON.stringify(data)
                        }, "批量通过成功");
                        layer.close(index);
                    }, function (index) {
                        layer.close(index);
                    });
                    break;
                case 'notpasses':
                    var checkStatus = table.checkStatus('table'),
                        data = checkStatus.data;
                    layer.confirm('确定要不通过选中的这' + data.length + '个项目吗？', {
                        title: "提醒",
                        btn: ['确定', '取消'],
                    }, function (index) {
                        commonRequest("notpasses", {
                            data: JSON.stringify(data)
                        }, "批量不通过成功");
                        layer.close(index);
                    }, function (index) {
                        layer.close(index);
                    });
                    break;
            };
        });

    });
    /*
     * layui结束
     */
     function commonRequest(path, data, msg) { // 通用request请求
        var loading = layer.load(1, {
            shade: [0.1, '#000']
        });
        axios
            .post(pageUrl + path, data)
            .then(function (response) {
                layer.close(loading);
                var resData = response.data;
                if (resData.code == 1) {
                    layer.alert(msg, {
                        icon: 1,
                        title: "成功"
                    });
                    table.reload("table");
                } else {
                    alertError(resData.msg);
                }
            })
            .catch(function (error) {
                layer.close(loading);
                console.log(error);
            });
    }
</script>


</html>