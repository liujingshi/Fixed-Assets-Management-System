<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:102:"E:\code\git\Fixed-Assets-Management-System\www\public/../application/app\view\assetcategory\index.html";i:1586482987;s:80:"E:\code\git\Fixed-Assets-Management-System\www\application\common\view\base.html";i:1586071758;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>资产分类管理 - 高校固定资产管理系统</title>

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
                    <i class="las la-th-list"></i>
                    <span>资产分类管理</span>
                </div>
                <div class="home-panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="table" lay-filter="table"></table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning alert-dismissible fade show" style="display: none;" role="alert">
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
    <form id="category_details_form" onsubmit="return false">
        <input type="hidden" v-model="cateId">
        <div class="form-group">
            <label>分类编号<b style="color: red;">*</b></label>
            <input type="text" class="form-control" v-model="cateNo">
            <small class="form-text text-muted">分类编号是分类的唯一标识，可以使用英文和数字的结合，也可以使纯英文和存数字，当然，下划线也是可以的，但是尽量不要使用中文。</small>
        </div>
        <div class="form-group">
            <label>分类名称<b style="color: red;">*</b></label>
            <input type="text" class="form-control" v-model="cateName">
            <small class="form-text text-muted">分类名称就是分类的名字，这里就可以使用中文了。</small>
        </div>
        <button class="btn btn-success" @click="updateCate" v-show="editCate">保存修改</button>
        <button class="btn btn-danger" @click="deleteCate" v-show="editCate">删除该分类</button>
        <button class="btn btn-primary" @click="insertCate" v-show="addCate">确认添加</button>
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
        <button class="layui-btn btn btn-info" lay-event="insertCate">添加新分类</button>
        <button class="layui-btn btn btn-danger" lay-event="deleteCates">删除选中分类</button>
    </div>
</script>
<script>
    var pageName = "assetcategory";
    var pageUrl = "/app/" + pageName + "/";
    update_navs(pageName);
    setLocal(["资产管理", "设置"], "资产分类管理");
    var layer, table, popupObj;
    var firstClick = true;
    layui.use(['layer', 'table'], function () { // 加载layui
        layer = layui.layer;
        table = layui.table;

        table.render({ // 创建表格
            elem: '#table',
            height: 'full-260',
            url: pageUrl + 'selectCate',
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
                        field: 'cate_no',
                        title: '分类编号',
                        width: "45%"
                    }, {
                        field: 'cate_name',
                        title: '分类名称',
                        width: "50%"
                    }
                ]
            ]
        });

        table.on('toolbar(table)', function (obj) { // 表头事件监听
            var checkStatus = table.checkStatus(obj.config.id);
            switch (obj.event) {
                case 'insertCate':
                    clearFormData();
                    categoryDetailsFormVueObj.addCate = true;
                    ljspopup({
                        el: "#popup",
                        title: "分类管理"
                    });
                    break;
                case 'deleteCates':
                    var checkStatus = table.checkStatus('table')
                        ,data = checkStatus.data;
                    layer.confirm('确定要删除选中的这'+data.length+'个分类吗？', {
                        title: "提醒",
                        btn: ['确定', '取消'],
                    }, function (index) {
                        cateRequest("deleteCates", {data: JSON.stringify(data)}, "分类删除成功");
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
            categoryDetailsFormVueObj.cateId = data.cate_id;
            categoryDetailsFormVueObj.cateNo = data.cate_no;
            categoryDetailsFormVueObj.cateName = data.cate_name;
            categoryDetailsFormVueObj.editCate = true;
            popupObj = ljspopup({
                el: "#popup",
                title: "分类管理"
            });
        });
    });

    var categoryDetailsFormVueObj = new Vue({ // vue对象创建
        el: "#category_details_form",
        data: {
            cateId: "",
            cateNo: "",
            cateName: "",
            editCate: true,
            addCate: true,
        },
        methods: {
            insertCate: function (event) { // 添加分类
                var data = getFormData();
                if (data.cateNo == "" || data.cateName == "") {
                    alertError("nullError");
                } else {
                    cateRequest("insertCate", data, "分类添加成功");
                }
            },
            updateCate: function (event) { // 修改分类
                var data = getFormData();
                if (data.cateNo == "" || data.cateName == "") {
                    alertError("nullError");
                } else {
                    cateRequest("updateCate", data, "分类修改成功");
                }
            },
            deleteCate: function (event) { // 删除分类
                layer.confirm('确定要删除该分类吗？', {
                    title: "提醒",
                    btn: ['确定', '取消'],
                }, function (index) {
                    var cateId = categoryDetailsFormVueObj.cateId;
                    if (cateId == "") {
                        alertError("Error");
                    } else {
                        cateRequest("deleteCate", {
                            cateId: cateId
                        }, "分类删除成功");
                    }
                    layer.close(index);
                }, function (index) {
                    layer.close(index);
                });
            }
        }
    });

    function cateRequest(path, data, msg) { // 通用request请求
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
                    if (path == "deleteCate") {
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
            cateId: categoryDetailsFormVueObj.cateId,
            cateNo: categoryDetailsFormVueObj.cateNo,
            cateName: categoryDetailsFormVueObj.cateName
        };
        return data;
    }

    function clearFormData() { // 清空表单数据
        categoryDetailsFormVueObj.cateId = "";
        categoryDetailsFormVueObj.cateNo = "";
        categoryDetailsFormVueObj.cateName = "";
        categoryDetailsFormVueObj.editCate = false;
        categoryDetailsFormVueObj.addCate = false;
    }
</script>


</html>