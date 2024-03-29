<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:104:"E:\code\git\Fixed-Assets-Management-System\www\public/../application/app\view\assetborrowlend\index.html";i:1589080881;s:80:"E:\code\git\Fixed-Assets-Management-System\www\application\common\view\base.html";i:1586071758;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>领用&归还 - 高校固定资产管理系统</title>

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
                    <i class="las la-plus-square"></i>
                    <span>领用&归还</span>
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
                                <strong>小提示：</strong> 双击数据行进行编辑
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
        <input type="hidden" v-model="blId">
        <div class="form-group">
            <label>领用人<b style="color: red;">*</b></label>
            <select class="form-control" id="borrowuser" v-model="uId">
                <option v-for="item in users" :value="item.u_id" v-html="item.p_name"></option>
            </select>
            <small class="form-text text-muted">请选择领用人，普通用户只可以选自己。</small>
        </div>
        <div class="form-group">
            <label>领用资产<b style="color: red;">*</b></label>
            <input v-show="asNameShow" type="text" readonly autocomplete="off" class="form-control" v-model="asName">
            <select v-show="!asNameShow" class="form-control" id="borrowasset" v-model="asNo">
                <option v-for="item in assets" :value="item.as_no"
                    v-html="item.as_name+'-'+item.local_name+'-'+item.cate_name"></option>
            </select>
            <small class="form-text text-muted">请选择要领用的资产。</small>
        </div>
        <div class="form-group">
            <label>资产状态<b style="color: red;">*</b></label>
            <input type="text" readonly autocomplete="off" class="form-control" v-model="staName">
        </div>
        <div class="form-group">
            <label>领用时间<b style="color: red;">*</b></label>
            <input type="text" id="btime" autocomplete="off" class="form-control" v-model="bTime">
        </div>
        <div class="form-group">
            <label>归还时间<b style="color: red;">*</b></label>
            <input type="text" id="ltime" readonly autocomplete="off" class="form-control" v-model="lTime">
        </div>
        <button class="btn btn-success" @click="edit" v-show="editS">归还</button>
        <button class="btn btn-danger" @click="del" v-show="delS">删除记录</button>
        <button class="btn btn-primary" @click="add" v-show="addS">领用</button>
    </form>
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
        <button class="layui-btn btn btn-info" lay-event="add">添加项目</button>
        <button class="layui-btn btn btn-danger" lay-event="del">删除选中项目</button>
        <button class="layui-btn btn btn-primary" lay-event="edits">批量归还</button>
    </div>
</script>
<script>
    var pageName = "assetborrowlend";
    var pageUrl = "/app/" + pageName + "/";
    update_navs(pageName);
    setLocal(["资产管理"], "领用&归还");
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    var layer, table, laydate, popupObj;
    var firstClick = true;
    var userinfo = {};
    $.post("/app/Home/getMyUserInfo", {}, function (res) {
        userinfo = JSON.parse(res);
        if (userinfo.powerNo == "VIP" || userinfo.powerNo == "SVIP") {
            setTimeout(() => {
                vueObj.canDel = true;
            }, 2000);
        }
    });
    /*
     * layui开始
     */
    layui.use(['layer', 'table', 'laydate'], function () {
        layer = layui.layer;
        table = layui.table;
        laydate = layui.laydate;

        laydate.render({ // 创建时间日期选择器
            elem: '#btime',
            type: 'datetime',
            format: 'yyyy-MM-dd HH:mm:ss',
            done: function (value, date, endDate) {
                vueObj.bTime = value;
            }
        });

        laydate.render({ // 创建时间日期选择器
            elem: '#ltime',
            type: 'datetime',
            format: 'yyyy-MM-dd HH:mm:ss',
            done: function (value, date, endDate) {
                vueObj.lTime = value;
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
                        field: 'p_name',
                        title: '领用人',
                        width: "20%"
                    }, {
                        field: 'as_name',
                        title: '领用资产',
                        width: "20%"
                    }, {
                        field: 'sta_name',
                        title: '资产状态',
                        width: "15%"
                    }, {
                        field: 'b_time',
                        title: '领用时间',
                        width: "20%"
                    }, {
                        field: 'l_time',
                        title: '归还时间',
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
                    vueObj.asNameShow = false;
                    if (userinfo.powerNo == "VIP" || userinfo.powerNo == "SVIP") {
                        $("#borrowuser").removeAttr("disabled")
                    } else {
                        vueObj.uId = userinfo.uId
                        console.log(userinfo)
                    }
                    $("#borrowasset").removeAttr("disabled")
                    $("#btime").removeAttr("readonly")
                    ljspopup({
                        el: "#popup",
                        title: "领用归还"
                    });
                    break;
                case 'del':
                    if (vueObj.canDel) {
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
                    } else {
                        layer.msg("权限不足");
                    }
                    break;
                case 'edits':
                    var checkStatus = table.checkStatus('table'),
                        data = checkStatus.data;
                    layer.confirm('确定要归还选中的这' + data.length + '个项目吗？', {
                        title: "提醒",
                        btn: ['确定', '取消'],
                    }, function (index) {
                        commonRequest("updates", {
                            data: JSON.stringify(data)
                        }, "批量归还成功");
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
            clearFormData();
            vueObj.blId = data.bl_id;
            vueObj.uId = data.u_id;
            vueObj.asName = data.as_name;
            vueObj.asNo = data.as_no;
            vueObj.staName = data.sta_name;
            vueObj.bTime = data.b_time;
            vueObj.lTime = data.l_time;
            vueObj.editS = true;
            vueObj.asNameShow = true;
            if (userinfo.powerNo == "VIP" || userinfo.powerNo == "SVIP") {
                vueObj.delS = true;
            }
            popupObj = ljspopup({
                el: "#popup",
                title: "领用归还"
            });
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
            blId: "",
            uId: "",
            asNo: "",
            staName: "",
            bTime: "",
            lTime: "",
            asName: "",
            editS: true,
            delS: true,
            addS: true,
            users: [],
            assets: [],
            canDel: false,
            asNameShow: false
        },
        methods: {
            add: function (event) { // 添加
                var data = getFormData();
                commonRequest("insert", data, "领用成功");
            },
            edit: function (event) { // 修改
                var data = getFormData();
                commonRequest("update", data, "归还成功");
            },
            del: function (event) { // 删除
                layer.confirm('确定要删除吗？', {
                    title: "提醒",
                    btn: ['确定', '取消'],
                }, function (index) {
                    var mainId = vueObj.blId;
                    commonRequest("delete", {
                        blId: mainId
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
            reloadAssets();
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
    function reloadAssets() {
        axios
            .post("/app/Assetborrowlend/xzData")
            .then(response => (vueObj.assets = response.data))
            .catch(function (error) {
                console.log(error);
            });
    }
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
                    if (path == "delete") {
                        closeLjspopup(popupObj);
                    } else if (path == "insert" || path == "update" || path == "updates") {
                        reloadAssets();
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
            blId: vueObj.blId,
            uId: vueObj.uId,
            asNo: vueObj.asNo,
            staName: vueObj.staName,
            bTime: vueObj.bTime,
            lTime: vueObj.lTime
        };
        return data;
    }

    function clearFormData() { // 清空表单数据
        vueObj.blId = "";
        vueObj.uId = "";
        vueObj.asNo = "";
        vueObj.staName = "";
        vueObj.bTime = "";
        vueObj.lTime = "";
        vueObj.editS = false;
        vueObj.delS = false;
        vueObj.addS = false;
        $("input").attr("readonly", "true");
        $("select").attr("disabled", "true");
    }

    $("#borrowasset").change(() => {
        for (let i in vueObj.assets) {
            if (vueObj.assets[i]['as_no'] == $("#borrowasset").val()) {
                vueObj.staName = vueObj.assets[i]['sta_name'];
                break;
            }
        }
    })
</script>


</html>