<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:99:"E:\code\git\Fixed-Assets-Management-System\www\public/../application/app\view\usermanage\index.html";i:1586070052;s:80:"E:\code\git\Fixed-Assets-Management-System\www\application\common\view\base.html";i:1586071758;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>用户管理 - 高校固定资产管理系统</title>

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
                    <i class="las la-user"></i>
                    <span>用户管理</span>
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
    <form id="user_details_form" onsubmit="return false">
        <input type="hidden" v-model="uId">
        <div class="form-group">
            <label>工号（姓名）<b style="color: red;">*</b></label>
            <select class="form-control" v-model="pId">
                <option v-for="p in ps" :value="p.p_id" v-html="p.p_no + '('+p.p_name+')'"></option>
            </select>
            <small class="form-text text-muted">用户的工号，只可以在已有人员里面选择。</small>
        </div>
        <div class="form-group">
            <label>手机号<b style="color: red;">*</b></label>
            <input type="text" class="form-control" v-model="uPhone">
        </div>
        <div class="form-group">
            <label>权限<b style="color: red;">*</b></label>
            <select class="form-control" v-model="powerNo">
                <option v-for="power in powers" :value="power.power_no" v-html="power.power_name"></option>
            </select>
            <small class="form-text text-muted">系统管理员可以管理一切，普通管理员可以管理一切资产，普通用户只可以使用资产，游客只能查看移动端。</small>
        </div>
        <div class="form-group">
            <label>头像：<i :class="uHead"></i></label>
            <select class="form-control" v-model="uHead">
                <option value="las la-user-secret">头像1</option>
                <option value="las la-user-graduate">头像2</option>
                <option value="las la-user-astronaut">头像3</option>
                <option value="las la-user-ninja">头像4</option>
                <option value="las la-user-cog">头像5</option>
                <option value="las la-user-lock">头像6</option>
                <option value="las la-user-clock">头像7</option>
                <option value="las la-user-tag">头像8</option>
                <option value="lab la-teamspeak">头像9</option>
            </select>
        </div>
        <div class="form-group">
            <label>积分</label>
            <input type="number" class="form-control" v-model="uMoney">
            <small class="form-text text-muted">积分是一个神秘的东西。</small>
        </div>
        <button class="btn btn-success" @click="updateU" v-show="editU">保存修改</button>
        <button class="btn btn-danger" @click="deleteU" v-show="editU">删除该用户</button>
        <button class="btn btn-primary" @click="insertU" v-show="addU">确认添加</button>
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
        <button class="layui-btn btn btn-info" lay-event="insertU">添加新用户</button>
        <button class="layui-btn btn btn-danger" lay-event="deleteUs">删除选中用户</button>
    </div>
</script>
<script type="text/html" id="uHeadTpl">
    <i class="{{d.u_head}}"></i>
</script>
<script>
    var pageName = "userManage";
    var pageUrl = "/app/" + pageName + "/";
    update_navs(pageName);
    setLocal(["系统管理"], "用户管理");
    var layer, table, popupObj;
    var firstClick = true;
    layui.use(['layer', 'table'], function () { // 加载layui
        layer = layui.layer;
        table = layui.table;

        table.render({ // 创建表格
            elem: '#table',
            height: 'full-260',
            url: pageUrl + 'selectU',
            page: true,
            toolbar: '#tableToolbar',
            limit: 10,
            cols: [
                [ // 表头
                    {
                        type: "checkbox",
                        width: "5%"
                    }, {
                        field: 'p_no',
                        title: '工号',
                        width: "15%"
                    }, {
                        field: 'p_name',
                        title: '姓名',
                        width: "15%"
                    }, {
                        field: 'u_phone',
                        title: '手机号',
                        width: "20%"
                    }, {
                        field: 'u_openid',
                        title: 'openid',
                        width: "20%"
                    }, {
                        field: 'power_name',
                        title: '权限',
                        width: "15%"
                    }, {
                        field: 'u_head',
                        title: '头像',
                        templet: '#uHeadTpl',
                        width: "5%"
                    }, {
                        field: 'u_money',
                        title: '积分',
                        width: "5%"
                    }
                ]
            ]
        });

        table.on('toolbar(table)', function (obj) { // 表头事件监听
            var checkStatus = table.checkStatus(obj.config.id);
            switch (obj.event) {
                case 'insertU':
                    clearFormData();
                    userDetailsFormVueObj.addU = true;
                    userDetailsFormVueObj.powerNo = "VISIT";
                    ljspopup({
                        el: "#popup",
                        title: "用户管理"
                    });
                    break;
                case 'deleteUs':
                    var checkStatus = table.checkStatus('table'),
                        data = checkStatus.data;
                    layer.confirm('确定要删除选中的这' + data.length + '个用户吗？', {
                        title: "提醒",
                        btn: ['确定', '取消'],
                    }, function (index) {
                        uRequest("deleteUs", {
                            data: JSON.stringify(data)
                        }, "用户删除成功");
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
            userDetailsFormVueObj.uId = data.u_id;
            userDetailsFormVueObj.pId = data.p_id;
            userDetailsFormVueObj.uPhone = data.u_phone;
            userDetailsFormVueObj.powerNo = data.power_no;
            userDetailsFormVueObj.uHead = data.u_head;
            userDetailsFormVueObj.uMoney = data.u_money;
            userDetailsFormVueObj.editU = true;
            popupObj = ljspopup({
                el: "#popup",
                title: "用户管理"
            });
        });
    });

    var userDetailsFormVueObj = new Vue({ // vue对象创建
        el: "#user_details_form",
        data: {
            uId: "",
            pId: "",
            uPhone: "",
            powerNo: "",
            uHead: "",
            uMoney: "",
            editU: true,
            addU: true,
            ps: [],
            powers: []
        },
        methods: {
            insertU: function (event) { // 添加用户
                var data = getFormData();
                if (data.pId == "" || data.powerNo == "") {
                    alertError("nullError");
                } else if (!(/^1[3456789]\d{9}$/.test(data.uPhone))) {
                    alertError("uPhoneError");
                } else {
                    uRequest("insertU", data, "用户添加成功");
                }
            },
            updateU: function (event) { // 修改用户
                var data = getFormData();
                if (data.uPhone == "" || data.pId == "" || data.powerNo == "") {
                    alertError("nullError");
                } else {
                    uRequest("updateU", data, "用户修改成功");
                }
            },
            deleteU: function (event) { // 删除用户
                layer.confirm('确定要删除该用户吗？', {
                    title: "提醒",
                    btn: ['确定', '取消'],
                }, function (index) {
                    var uId = userDetailsFormVueObj.uId;
                    if (uId == "") {
                        alertError("Error");
                    } else if (uId < 2) {
                        alertError("uRootError");
                    } else {
                        uRequest("deleteU", {
                            uId: uId
                        }, "用户删除成功");
                    }
                    layer.close(index);
                }, function (index) {
                    layer.close(index);
                });
            }
        },
        mounted() { // ajax请求数据 用于select框
            axios
                .post("/app/personManage/personsData")
                .then((response) => (this.ps = response.data))
                .catch(function (error) {
                    console.log(error);
                });
            axios
                .post("/app/userManage/powersData")
                .then((response) => (this.powers = response.data))
                .catch(function (error) {
                    console.log(error);
                });
        }
    });

    function uRequest(path, data, msg) { // 通用request请求
        axios
            .post(pageUrl + path, data)
            .then(function (response) {
                var resData = response.data;
                if (resData.code == 1) {
                    layer.alert(msg, {
                        icon: 1,
                        title: "成功"
                    });
                    table.reload("table");
                    if (path == "deleteU") {
                        closeLjspopup(popupObj);
                    }
                } else {
                    alertError(resData.msg);
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    function getFormData() { // 获取表单数据
        var data = {
            uId: userDetailsFormVueObj.uId,
            pId: userDetailsFormVueObj.pId,
            uPhone: userDetailsFormVueObj.uPhone,
            powerNo: userDetailsFormVueObj.powerNo,
            uHead: userDetailsFormVueObj.uHead,
            uMoney: userDetailsFormVueObj.uMoney
        };
        return data;
    }

    function clearFormData() { // 清空表单数据
        userDetailsFormVueObj.uId = "";
        userDetailsFormVueObj.pId = "";
        userDetailsFormVueObj.uPhone = "";
        userDetailsFormVueObj.powerNo = "";
        userDetailsFormVueObj.uHead = "";
        userDetailsFormVueObj.uMoney = "";
        userDetailsFormVueObj.editU = false;
        userDetailsFormVueObj.addU = false;
    }
</script>


</html>