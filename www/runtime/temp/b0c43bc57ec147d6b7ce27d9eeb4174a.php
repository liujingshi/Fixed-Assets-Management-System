<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:100:"E:\code\git\Fixed-Assets-Management-System\www\public/../application/app\view\assetimport\index.html";i:1590812303;s:80:"E:\code\git\Fixed-Assets-Management-System\www\application\common\view\base.html";i:1586071758;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>资产入库 - 高校固定资产管理系统</title>

    <link rel="stylesheet" href="/static/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/gijgo/css/gijgo.min.css">
    <link rel="stylesheet" href="/static/common/common.css">
    <link rel="stylesheet" href="/static/common/ljspopup.css">
    <link rel="stylesheet" href="/static/css/main.css">

    
<style>
    .form-image {
        height: 100px;
    }
    .crop-mask {
        position: absolute;
        top: 0px;
        left: 0px;
        right:0px;
        background-color: #777;
        filter:progid:DXImageTransform.Microsoft.Alpha(style=3,opacity=25,finishOpacity=75);
        opacity: 0.6;
    }
    #cropimage {
        position: absolute;
        top: 0;
        left: 0;
    }
</style>


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
                    <i class="las la-sign-in-alt"></i>
                    <span>资产入库</span>
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
        <input type="hidden" v-model="asId">
        <div class="form-group">
            <label>资产编号</label>
            <input readonly type="text" class="form-control" v-model="asNo">
            <small class="form-text text-muted">资产编号是资产的唯一标识，由系统自动生成。无需手动填写。</small>
        </div>
        <div class="form-group">
            <label>资产名称<b style="color: red;">*</b></label>
            <input type="text" class="form-control" v-model="asName">
            <small class="form-text text-muted">资产名称。</small>
        </div>
        <div class="form-group">
            <label>分类<b style="color: red;">*</b></label>
            <select class="form-control" v-model="cateId">
                <option v-for="item in cates" :value="item.cate_id" v-html="item.cate_name"></option>
            </select>
            <small class="form-text text-muted">资产分类，只可以在已有资产分类里面选择，资产分类管理在（资产管理->设置->资产分类）。</small>
        </div>
        <div class="form-group">
            <label>资产入库时间<b style="color: red;">*</b></label>
            <input type="text" id="datetime" autocomplete="off" class="form-control" v-model="asImportTime">
            <small class="form-text text-muted">选择资产入库的时间。</small>
        </div>
        <div class="form-group">
            <label>资产价格</label>
            <input type="text" class="form-control" v-model="asPrice">
            <small class="form-text text-muted">资产的价格。</small>
        </div>
        <div class="form-group">
            <label>资产地点</label>
            <select class="form-control" v-model="asLocalId">
                <option v-for="item in locals" :value="item.local_id" v-html="item.local_name"></option>
            </select>
            <small class="form-text text-muted">这个地点需要使用移动端GPS定位，也可以选择一个已有地点。</small>
        </div>
        <div class="form-group">
            <label>资产图片</label>
            <div class="form-row">
                <div class="col">
                    <input type="hidden" v-model="asImage">
                    <input type="file" class="form-control-file" accept="image/jpeg, image/png" id="asImage">
                </div>
                <div class="col">
                    <img :src="'/image/' + asImage" class="form-image">
                </div>
            </div>
            <small class="form-text text-muted">可以上传也可以使用移动端拍照。</small>
        </div>
        <div class="form-group">
            <label>资产二维码</label>
            <div>
                <img :src="'/qrcode/' + asQrcode" class="form-image">
            </div>
            <small class="form-text text-muted">系统自动生成，无需多虑。</small>
        </div>
        <button class="btn btn-success" @click="edit" v-show="editS">保存修改</button>
        <button class="btn btn-danger" @click="del" v-show="editS">删除</button>
        <button class="btn btn-primary" @click="add" v-show="addS">确认添加</button>
    </form>
</div>
<div id="crop" style="display: none;">
    <div class="crop-mask"></div>
    <img id="cropimage" src="">
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
        <button class="layui-btn btn btn-primary" lay-event="adds">批量生成资产</button>
        <button class="layui-btn btn btn-success" lay-event="downloadqrcode">下载选中资产的二维码</button>
    </div>
</script>
<script>
    var pageName = "assetimport";
    var pageUrl = "/app/" + pageName + "/";
    update_navs(pageName);
    setLocal(["资产管理"], "资产入库");
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    /* ============================================================================================================================= */
    var layer, table, laydate, popupObj;
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
                vueObj.asImportTime = value;
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
                        field: 'as_no',
                        title: '资产编号',
                        width: "20%"
                    }, {
                        field: 'as_name',
                        title: '资产名称',
                        width: "15%"
                    }, {
                        field: 'sta_name',
                        title: '资产状态',
                        width: "10%"
                    }, {
                        field: 'cate_name',
                        title: '资产分类',
                        width: "10%"
                    }, {
                        field: 'as_price',
                        title: '资产价格',
                        width: "10%"
                    }, {
                        field: 'as_import_time',
                        title: '资产入库时间',
                        width: "15%"
                    }, {
                        field: 'local_name',
                        title: '资产地点',
                        width: "15%"
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
                        title: "资产管理"
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
                case 'adds':
                    layer.prompt({
                        title: '输入要生成资产的数量',
                        formType: 0
                    }, function (pass, index) {
                        layer.close(index);
                        commonRequest("inserts", {
                            num: pass
                        }, "批量生成成功")
                    });
                    break;
                case 'downloadqrcode':
                    var checkStatus = table.checkStatus('table'),
                        data = checkStatus.data;
                    $.post("/utils/download/qrcode", {
                        data: JSON.stringify(data)
                    }, function (data) {
                        window.open(window.location.origin + data, '_blank');
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
            vueObj.asId = data.as_id;
            vueObj.asNo = data.as_no;
            vueObj.asName = data.as_name;
            vueObj.cateId = data.cate_id;
            vueObj.asPrice = data.as_price;
            vueObj.asImportTime = data.as_import_time;
            vueObj.asLocalId = data.as_local_id;
            vueObj.asImage = data.as_image;
            vueObj.asQrcode = data.as_qrcode;
            vueObj.editS = true;
            popupObj = ljspopup({
                el: "#popup",
                title: "资产管理"
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
            asId: "",
            asNo: "",
            asName: "",
            cateId: "",
            asPrice: "",
            asImportTime: "",
            asLocalId: "",
            asImage: "",
            asQrcode: "",
            editS: true,
            addS: true,
            cates: [],
            locals: []
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
                .post("/app/Assetcategory/categorysData")
                .then(response => (this.cates = response.data))
                .catch(function (error) {
                    console.log(error);
                });
            axios
                .post("/app/Assetimport/localsData")
                .then(response => (this.locals = response.data))
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
        var loading = layer.load(1, {shade: [0.1,'#000']});
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
            asId: vueObj.asId,
            asNo: vueObj.asNo,
            asName: vueObj.asName,
            cateId: vueObj.cateId,
            asPrice: vueObj.asPrice,
            asImportTime: vueObj.asImportTime,
            asLocalId: vueObj.asLocalId,
            asImage: vueObj.asImage
        };
        return data;
    }

    function clearFormData() { // 清空表单数据
        vueObj.asId = "";
        vueObj.asNo = "";
        vueObj.asName = "";
        vueObj.cateId = "";
        vueObj.asPrice = "";
        vueObj.asImportTime = "";
        vueObj.asLocalId = "";
        vueObj.asImage = "";
        vueObj.asQrcode = "";
        vueObj.editS = false;
        vueObj.addS = false;
    }

    function croppingImage() { // 截取图片

    }

    $("#asImage").on('change', function () { // 监听文件选择并上传
        var formData = new FormData();
        formData.append("image", $("#asImage")[0].files[0]);
        $.ajax({
            url: '/utils/upload/image',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response == "error") {
                    layer.alert({
                        icon: 2,
                        title: "上传失败"
                    });
                } else {
                    $("#cropimage").attr("src", "/image/" + response);
                    let croppopup = ljspopup({
                        el: "#crop",
                        title: "截取图片",
                        width: 300,
                        height: 438,
                        min: false,
                        max: false,
                        mask: false,
                        move: false
                    });
                    // vueObj.asImage = response;
                }
            }
        });
    });
</script>


</html>