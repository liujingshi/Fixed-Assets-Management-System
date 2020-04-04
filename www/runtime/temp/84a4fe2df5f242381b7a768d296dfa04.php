<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:101:"E:\code\git\Fixed-Assets-Management-System\www\public/../application/app\view\personmanage\index.html";i:1586005969;s:80:"E:\code\git\Fixed-Assets-Management-System\www\application\common\view\base.html";i:1585980709;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>人员管理 - 高校固定资产管理系统</title>

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

                <a href="javascript:open_iframe('message');" class="nav-top-right nav-top-right-first">
                    <i class="las la-envelope"></i>
                    <span>通知</span>
                    <span class="badge message-num">6</span>
                </a>
                <a href="javascript:open_iframe('user');" class="nav-top-right">
                    <i class="las la-user-secret"></i>
                    <span>百里刘叔</span>
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
                    <i class="las la-user-graduate"></i>
                    <span>人员管理</span>
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
    <form id="person_details_form" onsubmit="return false">
        <input type="hidden" v-model="pId">
        <div class="form-group">
            <label>所属部门<b style="color: red;">*</b></label>
            <select class="form-control" v-model="depId">
                <option v-for="dep in deps" :value="dep.dep_id" v-html="dep.dep_name"></option>
            </select>
            <small class="form-text text-muted">人员所属部门，只可以在已有部门里面选择。</small>
        </div>
        <div class="form-group">
            <label>职业<b style="color: red;">*</b></label>
            <select class="form-control" v-model="posId">
                <option v-for="pos in poses" :value="pos.pos_id" v-html="pos.pos_name"></option>
            </select>
            <small class="form-text text-muted">人员职业，只可以在已有职业里面选择。</small>
        </div>
        <div class="form-group">
            <label>人员工号<b style="color: red;">*</b></label>
            <input type="text" class="form-control" v-model="pNo">
            <small class="form-text text-muted">人员工号是人员的唯一标识，比如，学生的学号，教师的工号。</small>
        </div>
        <div class="form-group">
            <label>人员姓名<b style="color: red;">*</b></label>
            <input type="text" class="form-control" v-model="pName">
        </div>
        <div class="form-group">
            <label>性别</label>
            <select class="form-control" v-model="pSex">
                <option value="男">男</option>
                <option value="女">女</option>
            </select>
        </div>
        <div class="form-group">
            <label>邮箱</label>
            <input type="text" class="form-control" v-model="pEmail">
        </div>
        <div class="form-group">
            <label>身份证号</label>
            <input type="text" class="form-control" v-model="pIc">
        </div>
        <button class="btn btn-success" @click="updateP" v-show="editP">保存修改</button>
        <button class="btn btn-danger" @click="deleteP" v-show="editP">删除该人员</button>
        <button class="btn btn-primary" @click="insertP" v-show="addP">确认添加</button>
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
        <button class="layui-btn btn btn-info" lay-event="insertP">添加新人员</button>
        <button class="layui-btn btn btn-danger" lay-event="deletePs">删除选中人员</button>
    </div>
</script>
<script>
    var pageName = 'personManage';
    var pageUrl = "/app/" + pageName + "/";
    update_navs(pageName);
    setLocal(["系统管理", "组织架构"], "人员管理");
    var layer, table, popupObj;
    var firstClick = true;
    layui.use(['layer', 'table'], function () { // 加载layui
        layer = layui.layer;
        table = layui.table;

        table.render({ // 创建表格
            elem: '#table',
            height: 'full-260',
            url: pageUrl + 'selectP',
            page: true,
            toolbar: '#tableToolbar',
            limit: 10,
            cols: [
                [ // 表头
                    {
                        type: "checkbox",
                        width: "5%"
                    }, {
                        field: 'dep_name',
                        title: '所属部门',
                        width: "20%"
                    }, {
                        field: 'pos_name',
                        title: '职位',
                        width: "10%"
                    }, {
                        field: 'p_no',
                        title: '人员工号',
                        width: "20%"
                    }, {
                        field: 'p_name',
                        title: '姓名',
                        width: "10%"
                    }, {
                        field: 'p_sex',
                        title: '性别',
                        width: "5%"
                    }, {
                        field: 'p_email',
                        title: '邮箱',
                        width: "15%"
                    }, {
                        field: 'p_ic',
                        title: '身份证号',
                        width: "15%"
                    }
                ]
            ]
        });

        table.on('toolbar(table)', function (obj) { // 表头事件监听
            var checkStatus = table.checkStatus(obj.config.id);
            switch (obj.event) {
                case 'insertP':
                    clearFormData();
                    personDetailsFormVueObj.addP = true;
                    ljspopup({
                        el: "#popup",
                        title: "人员管理"
                    });
                    break;
                case 'deletePs':
                    var checkStatus = table.checkStatus('table'),
                        data = checkStatus.data;
                    layer.confirm('确定要删除选中的这' + data.length + '个人员吗？', {
                        title: "提醒",
                        btn: ['确定', '取消'],
                    }, function (index) {
                        pRequest("deletePs", {
                            data: JSON.stringify(data)
                        }, "人员删除成功");
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
            personDetailsFormVueObj.pId = data.p_id;
            personDetailsFormVueObj.depId = data.dep_id;
            personDetailsFormVueObj.posId = data.pos_id;
            personDetailsFormVueObj.pNo = data.p_no;
            personDetailsFormVueObj.pName = data.p_name;
            personDetailsFormVueObj.pSex = data.p_sex;
            personDetailsFormVueObj.pEmail = data.p_email;
            personDetailsFormVueObj.pIc = data.p_ic;
            personDetailsFormVueObj.editP = true;
            popupObj = ljspopup({
                el: "#popup",
                title: "人员管理"
            });
        });
    });

    var personDetailsFormVueObj = new Vue({ // vue对象创建
        el: "#person_details_form",
        data: {
            pId: "",
            depId: "",
            posId: "",
            pNo: "",
            pName: "",
            pSex: "",
            pEmail: "",
            pIc: "",
            editP: true,
            addP: true,
            deps: [],
            poses: []
        },
        methods: {
            insertP: function (event) { // 添加人员
                var data = getFormData();
                if (data.pNo == "" || data.pName == "" || data.depId == "" || data.posId == "") {
                    alertError("nullError");
                } else if (data.depId < 2) {
                    alertError("pUpDepIdError");
                } else {
                    pRequest("insertP", data, "人员添加成功");
                }
            },
            updateP: function (event) { // 修改人员
                var data = getFormData();
                if (data.pNo == "" || data.pName == "" || data.depId == "" || data.posId == "") {
                    alertError("nullError");
                } else {
                    pRequest("updateP", data, "人员修改成功");
                }
            },
            deleteP: function (event) { // 删除人员
                layer.confirm('确定要删除该人员吗？', {
                    title: "提醒",
                    btn: ['确定', '取消'],
                }, function (index) {
                    var pId = personDetailsFormVueObj.pId;
                    if (pId == "") {
                        alertError("Error");
                    } else if (pId < 2) {
                        alertError("pRootError");
                    } else {
                        pRequest("deleteP", {
                            pId: pId
                        }, "人员删除成功");
                    }
                    layer.close(index);
                }, function (index) {
                    layer.close(index);
                });
            }
        },
        mounted() { // ajax请求数据 用于select框
            axios
                .post("/app/departmentManage/departmentsData")
                .then(response => (this.deps = response.data))
                .catch(function (error) {
                    console.log(error);
                });
            axios
                .post("/app/positionManage/positionsData")
                .then(response => (this.poses = response.data))
                .catch(function (error) {
                    console.log(error);
                });
        }
    });

    function pRequest(path, data, msg) { // 通用request请求
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
                    if (path == "deleteP") {
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
            pId: personDetailsFormVueObj.pId,
            depId: personDetailsFormVueObj.depId,
            posId: personDetailsFormVueObj.posId,
            pNo: personDetailsFormVueObj.pNo,
            pName: personDetailsFormVueObj.pName,
            pSex: personDetailsFormVueObj.pSex,
            pEmail: personDetailsFormVueObj.pEmail,
            pIc: personDetailsFormVueObj.pIc
        };
        return data;
    }

    function clearFormData() { // 清空表单数据
        personDetailsFormVueObj.pId = "";
        personDetailsFormVueObj.depId = "";
        personDetailsFormVueObj.posId = "";
        personDetailsFormVueObj.pNo = "";
        personDetailsFormVueObj.pName = "";
        personDetailsFormVueObj.pSex = "";
        personDetailsFormVueObj.pEmail = "";
        personDetailsFormVueObj.pIc = "";
        personDetailsFormVueObj.editP = false;
        personDetailsFormVueObj.addP = false;
    }
</script>


</html>