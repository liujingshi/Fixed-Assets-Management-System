<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:105:"E:\code\git\Fixed-Assets-Management-System\www\public/../application/app\view\departmentmanage\index.html";i:1585922164;s:80:"E:\code\git\Fixed-Assets-Management-System\www\application\common\view\base.html";i:1585894895;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>部门管理 - 高校固定资产管理系统</title>

    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
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
                    <li><a href="index.html">固定资产管理系统</a></li>
                    <li><a v-for="item in local" v-html="item.title" :href="'javascript:open_iframe(\''+item.name+'\');'"></a></li>
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
                    <i class="las la-city"></i>
                    <span>部门管理</span>
                </div>
                <div class="home-panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="home-panel">
                                <div class="home-panel-header">
                                    <i class="las la-cubes"></i>
                                    <span>部门结构</span>
                                </div>
                                <div class="home-panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="treeview"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="home-panel">
                                <div class="home-panel-header">
                                    <i class="las la-rainbow"></i>
                                    <span>部门详情</span>
                                </div>
                                <div class="home-panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form id="department_details_form" onsubmit="return false"
                                                v-show="formShow">
                                                <input type="hidden" v-model="depId">
                                                <div class="form-group">
                                                    <label>上级部门<b style="color: red;">*</b></label>
                                                    <select class="form-control" v-model="upDepId">
                                                        <option v-for="dep in deps" :value="dep.dep_id"
                                                            v-html="dep.dep_name"></option>
                                                    </select>
                                                    <small
                                                        class="form-text text-muted">这是这个部门的上级部门，只可以在已有部门里面选择，千万不要选自己哦。</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>部门编号<b style="color: red;">*</b></label>
                                                    <input type="text" class="form-control" v-model="depNo">
                                                    <small
                                                        class="form-text text-muted">部门编号是部门的唯一标识，可以使用英文和数字的结合，也可以使纯英文和存数字，当然，下划线也是可以的，但是尽量不要使用中文。</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>部门名称<b style="color: red;">*</b></label>
                                                    <input type="text" class="form-control" v-model="depName">
                                                    <small class="form-text text-muted">部门名称就是部门的名字，这里就可以使用中文了。</small>
                                                </div>
                                                <div class="form-group">
                                                    <label>备注</label>
                                                    <input type="text" class="form-control" v-model="depRemark">
                                                    <small
                                                        class="form-text text-muted">这里是备注，可以不写，也可以写一些东西，比如部门的作用。</small>
                                                </div>
                                                <button class="btn btn-success" @click="updateDep"
                                                    v-show="alreadySelect">保存修改</button>
                                                <button class="btn btn-danger" @click="deleteDep"
                                                    v-show="alreadySelect">删除该部门</button>
                                                <button class="btn btn-primary" @click="insertDep"
                                                    v-show="addSonDep">确认添加</button>
                                                <button class="btn btn-info" @click="showAddSonDep"
                                                    v-show="alreadySelect">添加子部门</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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


<script>
    var pageName = "departmentManage";
    var pageUrl = "/app/" + pageName + "/";
    update_navs(pageName);
    var layer;
    layui.use(['layer'], function () { // 加载layui
        layer = layui.layer;
    });
    var treeview = $("#treeview").tree({ // 创建treview
        dataSource: '/app/' + pageName + '/departmentsJsonData',
        autoLoad: true,
        dataBound: function (e) {
            treeview.expandAll();
        }
    });
    var departmentDetailsFormVueObj = new Vue({ // vue对象创建
        el: "#department_details_form",
        data: {
            depId: "",
            upDepId: "",
            depNo: "",
            depName: "",
            depRemark: "",
            alreadySelect: false,
            addSonDep: false,
            formShow: false,
            deps: []
        },
        methods: {
            showAddSonDep: function (event) { // 显示添加子部门表单
                var upDepId = this.depId;
                clearFormData();
                this.addSonDep = true;
                this.upDepId = upDepId;
            },
            insertDep: function (event) { // 添加部门
                var data = getFormData();
                if (data.upDepId < 2) {
                    alertError("upDepIdError");
                } else if (data.depNo == "" || data.depName == "") {
                    alertError("nullError");
                } else {
                    depRequest("insertDep", data, "部门添加成功");
                }
            },
            updateDep: function (event) { // 修改部门
                var data = getFormData();
                if (data.upDepId < 2 || data.upDepId == data.depId) {
                    alertError("upDepIdError");
                } else if (data.depNo == "" || data.depName == "") {
                    alertError("nullError");
                } else {
                    depRequest("updateDep", data, "部门修改成功");
                }
            },
            deleteDep: function (event) { // 删除部门
                layer.confirm('注意！删除部门将会删除该部门下所有子部门！', {
                    title: "确定要删除该部门吗？",
                    btn: ['确定', '取消'],
                }, function (index) {
                    var depId = departmentDetailsFormVueObj.depId;
                    if (depId == "") {
                        alertError("Error");
                    } else {
                        depRequest("deleteDep", {
                            depId: depId
                        }, "部门删除成功");
                    }
                    layer.close(index);
                }, function (index) {
                    layer.close(index);
                });
            }
        },
        mounted() {
            loadSelect();
        }
    });

    function depRequest(path, data, msg) { // 通用request请求
        axios
            .post(pageUrl + path, data)
            .then(function (response) {
                var resData = response.data;
                if (resData.code == 1) {
                    layer.alert(msg, {
                        icon: 1,
                        title: "成功"
                    });
                    treeview.reload();
                    loadSelect();
                    clearFormData();
                    departmentDetailsFormVueObj.formShow = false;
                } else {
                    alertError(resData.msg);
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    function loadSelect() { // 加载select数据
        // ajax请求部门数据 用于select框
        axios
            .post(pageUrl + "departmentsData")
            .then(response => (departmentDetailsFormVueObj.deps = response.data))
            .catch(function (error) {
                console.log(error);
            });
    }

    function getFormData() { // 获取表单数据
        var data = {
            depId: departmentDetailsFormVueObj.depId,
            upDepId: departmentDetailsFormVueObj.upDepId,
            depNo: departmentDetailsFormVueObj.depNo,
            depName: departmentDetailsFormVueObj.depName,
            depRemark: departmentDetailsFormVueObj.depRemark,
        };
        return data;
    }

    function clearFormData() { // 清空表单数据
        departmentDetailsFormVueObj.depId = "";
        departmentDetailsFormVueObj.upDepId = "";
        departmentDetailsFormVueObj.depNo = "";
        departmentDetailsFormVueObj.depName = "";
        departmentDetailsFormVueObj.depRemark = "";
        departmentDetailsFormVueObj.alreadySelect = false;
        departmentDetailsFormVueObj.addSonDep = false;
    }
    treeview.on('select', function (e, node, id) { // 监听选择每部门
        var nodeData = treeview.getDataById(id);
        var depData = nodeData.obj;
        departmentDetailsFormVueObj.depId = depData.dep_id;
        departmentDetailsFormVueObj.upDepId = depData.up_dep_id;
        departmentDetailsFormVueObj.depNo = depData.dep_no;
        departmentDetailsFormVueObj.depName = depData.dep_name;
        departmentDetailsFormVueObj.depRemark = depData.dep_remark;
        departmentDetailsFormVueObj.alreadySelect = true;
        departmentDetailsFormVueObj.formShow = true;
    });
    treeview.on('unselect', function (e, node, id) { // 监听取消选择某部门
        clearFormData();
        departmentDetailsFormVueObj.formShow = false;
    });
</script>


</html>