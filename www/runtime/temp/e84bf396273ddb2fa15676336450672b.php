<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:99:"E:\code\git\Fixed-Assets-Management-System\www\public/../application/app\view\assetcheck\index.html";i:1589039033;s:80:"E:\code\git\Fixed-Assets-Management-System\www\application\common\view\base.html";i:1586071758;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>资产盘点 - 高校固定资产管理系统</title>

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
                    <i class="las la-check-square"></i>
                    <span>资产盘点</span>
                </div>
                <div class="home-panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="table" lay-filter="table"></table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning alert-dismissible fade show" style="display: none;"
                                role="alert">
                                <strong>小提示：</strong> 双击数据行查看盘点单详情
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="popup" style="display: none;">
    <form id="vue_form" onsubmit="return false">
        <input type="hidden" v-model="cId">
        <div class="form-group">
            <label>盘点单名称<b style="color: red;">*</b></label>
            <input type="text" class="form-control" v-model="cTitle">
        </div>
        <div class="form-group">
            <label>盘点截止时间<b style="color: red;">*</b></label>
            <input type="text" id="datetime" autocomplete="off" class="form-control" v-model="ceTime">
            <small class="form-text text-muted">选择盘点结束最晚的时间。</small>
        </div>
        <div class="form-group">
            <label>盘点人员</label>
            <select class="form-control" v-model="uId">
                <option v-for="item in users" :value="item.u_id" v-html="'('+item.p_no+')'+item.p_name"></option>
            </select>
            <small class="form-text text-muted">可以指定盘点人员，除盘点人员外，所有管理员也可以进行盘点。</small>
        </div>
        <div class="form-group custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" v-model="checked" id="customCheck1">
            <label class="custom-control-label" for="customCheck1">添加盘点人员领用的资产到盘点单。</label>
        </div>
        <button class="btn btn-primary" @click="add" v-show="addS">创建</button>
    </form>
</div>
<div id="sonpopup" style="display: none;">
    <table id="sontable" lay-filter="sontable"></table>
</div>
<div id="assetpopup" style="display: none;">
    <table id="assettable" lay-filter="assettable"></table>
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
        <button class="layui-btn btn btn-info" lay-event="add">创建盘点单</button>
        <button class="layui-btn btn btn-danger" lay-event="del">删除选中盘点单</button>
    </div>
</script>
<script type="text/html" id="sontableToolbar">
    <div class="layui-btn-container">
        <button class="layui-btn btn btn-info" lay-event="add">添加资产</button>
        <button class="layui-btn btn btn-danger" lay-event="del">删除选中资产</button>
    </div>
</script>
<script type="text/html" id="assettableToolbar">
    <div class="layui-btn-container">
        <button class="layui-btn btn btn-info" lay-event="add">添加选中资产</button>
    </div>
</script>
<script>
    var pageName = "assetcheck";
    var pageUrl = "/app/" + pageName + "/";
    update_navs(pageName);
    setLocal(["资产管理"], "盘点管理");
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    var layer, table, laydate, popupObj, assetpopupObj;
    var firstClick = true;
    /*
     * layui开始
     */
    layui.use(['layer', 'table', 'laydate'], function () {
        layer = layui.layer;
        table = layui.table;
        laydate = layui.laydate;

        laydate.render({ // 创建时间日期选择器
            elem: '#datetime',
            type: 'datetime',
            format: 'yyyy-MM-dd HH:mm:ss',
            done: function (value, date, endDate) {
                vueObj.ceTime = value;
            }
        });

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
                        field: 'c_title',
                        title: '盘点单名称',
                        width: "20%"
                    }, {
                        field: 'p_name',
                        title: '盘点人员',
                        width: "15%"
                    }, {
                        field: 'c_time',
                        title: '盘点单创建时间',
                        width: "20%"
                    }, {
                        field: 'c_e_time',
                        title: '盘点截止时间',
                        width: "20%"
                    }, {
                        field: 'c_sta_name',
                        title: '盘点单状态',
                        width: "20%"
                    }
                ]
            ]
        });

        table.on('toolbar(table)', function (obj) { // 表头事件监听
            var checkStatus = table.checkStatus(obj.config.id);
            switch (obj.event) {
                case 'add':
                    clearFormData();
                    vueObj.addS = true;
                    ljspopup({
                        el: "#popup",
                        title: "创建盘点单"
                    });
                    break;
                case 'del':
                    var checkStatus = table.checkStatus('table'),
                        data = checkStatus.data;
                    layer.confirm('确定要删除选中的这' + data.length + '个项目吗？', {
                        title: "提醒",
                        btn: ['确定', '取消'],
                    }, function (index) {
                        commonRequest("deletes", {
                            data: JSON.stringify(data)
                        }, "批量删除成功");
                        layer.close(index);
                    }, function (index) {
                        layer.close(index);
                    });
                    break;
            };
        });

        table.on('row(table)', function (obj) { //监听行单击事件
            if (firstClick) {
                firstClick = false;
                $('.alert').attr("style", "");
            }
        });

        table.on('rowDouble(table)', function (obj) { //监听行双击事件
            var data = obj.data;
            vueObj.cId = data.c_id;
            table.reload("sontable", {
                url: pageUrl + 'selectcontent/id/' + vueObj.cId
            })
            ljspopup({
                el: "#sonpopup",
                title: "盘点单详情"
            });
        });

        table.render({ // 创建资产表格
            elem: '#assettable',
            width: 600,
            height: 400,
            url: '/app/assetimport/select',
            page: true,
            toolbar: '#assettableToolbar',
            limit: 10,
            cols: [
                [ // 表头
                    {
                        type: "checkbox",
                        width: 30
                    },
                    {
                        field: 'as_no',
                        title: '资产编号',
                        width: 200
                    }, {
                        field: 'as_name',
                        title: '资产名称',
                        width: 200
                    }, {
                        field: 'sta_name',
                        title: '资产状态',
                        width: 150
                    }, {
                        field: 'cate_name',
                        title: '资产分类',
                        width: 150
                    }, {
                        field: 'as_price',
                        title: '资产价格',
                        width: 100
                    }, {
                        field: 'as_import_time',
                        title: '资产入库时间',
                        width: 200
                    }, {
                        field: 'local_name',
                        title: '资产地点',
                        width: 150
                    }
                ]
            ]
        });

        table.on('toolbar(assettable)', function (obj) { // 资产表头事件监听
            var checkStatus = table.checkStatus(obj.config.id);
            switch (obj.event) {
                case 'add':
                    var checkStatus = table.checkStatus('assettable'),
                        data = checkStatus.data;
                    commonRequest("inserts/id/" + vueObj.cId, {
                        data: JSON.stringify(data)
                    }, "添加成功");
                    break;
            };
        });

        table.render({ // 创建盘点内容表格
            elem: '#sontable',
            width: 800,
            height: 600,
            url: pageUrl + 'selectcontent/id/0',
            page: true,
            toolbar: '#sontableToolbar',
            limit: 10,
            cols: [
                [ // 表头
                    {
                        type: "checkbox",
                        width: 30
                    },
                    {
                        field: 'as_no',
                        title: '资产编号',
                        width: 200
                    }, {
                        field: 'as_name',
                        title: '资产名称',
                        width: 200
                    }, {
                        field: 'sta_name',
                        title: '资产状态',
                        width: 150
                    }, {
                        field: 'cate_name',
                        title: '资产分类',
                        width: 150
                    }, {
                        field: 'as_price',
                        title: '资产价格',
                        width: 100
                    }, {
                        field: 'as_import_time',
                        title: '资产入库时间',
                        width: 200
                    }, {
                        field: 'local_name',
                        title: '资产地点',
                        width: 150
                    }
                ]
            ]
        });

        table.on('toolbar(sontable)', function (obj) { // 盘点单详情表头事件监听
            var checkStatus = table.checkStatus(obj.config.id);
            switch (obj.event) {
                case 'add':
                    assetpopupObj = ljspopup({
                        el: "#assetpopup",
                        title: "资产列表"
                    });
                    break;
                case 'del':
                    var checkStatus = table.checkStatus('sontable'),
                        data = checkStatus.data;
                    layer.confirm('确定要删除选中的这' + data.length + '个项目吗？', {
                        title: "提醒",
                        btn: ['确定', '取消'],
                    }, function (index) {
                        commonRequest("deletecontents", {
                            data: JSON.stringify(data)
                        }, "批量删除成功");
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
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /*
     * vue开始
     */
    var vueObj = new Vue({ // vue对象创建
        el: "#vue_form",
        data: {
            cId: "",
            cTitle: "",
            uId: 0,
            checked: false,
            ceTime: "",
            addS: true,
            users: []
        },
        methods: {
            add: function (event) { // 添加
                var data = getFormData();
                commonRequest("insert", data, "添加成功");
            },
            edit: function (event) { // 修改
                var data = getFormData();
                commonRequest("update", data, "修改成功");
            },
            del: function (event) { // 删除
                layer.confirm('确定要删除吗？', {
                    title: "提醒",
                    btn: ['确定', '取消'],
                }, function (index) {
                    var mainId = vueObj.asId;
                    commonRequest("delete", {
                        asId: mainId
                    }, "删除成功");
                    layer.close(index);
                }, function (index) {
                    layer.close(index);
                });
            }
        },
        mounted() { // ajax请求数据 用于select框
            axios
                .post("/app/Assetborrowlend/usersData")
                .then(response => (this.users = response.data))
                .catch(function (error) {
                    console.log(error);
                });
        }
    });
    /*
     * vue结束
     */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
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
                    if (path == "insert" || path == "deletes") {
                        table.reload("table");
                    } else if (path.indexOf("inserts") >= 0) {
                        closeLjspopup(assetpopupObj);
                        table.reload("sontable", {
                            url: pageUrl + 'selectcontent/id/' + vueObj.cId
                        })
                        table.reload("assettable");
                    } else if (path.indexOf("deletecontents") >= 0) {
                        table.reload("sontable", {
                            url: pageUrl + 'selectcontent/id/' + vueObj.cId
                        })
                    }
                } else {
                    alertError(resData.msg);
                }
            })
            .catch(function (error) {
                layer.close(loading);
                console.log(error);
            });
    }

    function getFormData() { // 获取表单数据
        var data = {
            cId: vueObj.cId,
            cTitle: vueObj.cTitle,
            uId: vueObj.uId,
            checked: vueObj.checked,
            ceTime: vueObj.ceTime
        };
        return data;
    }

    function clearFormData() { // 清空表单数据
        vueObj.cId = "";
        vueObj.cTitle = "";
        vueObj.uId = 0;
        vueObj.checked = false;
        vueObj.ceTime = "";
        vueObj.addS = false;
    }
</script>


</html>