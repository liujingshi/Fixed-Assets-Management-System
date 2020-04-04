<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:101:"E:\code\git\Fixed-Assets-Management-System\www\public/../application/app\view\personmanage\index.html";i:1585993741;s:80:"E:\code\git\Fixed-Assets-Management-System\www\application\common\view\base.html";i:1585980709;}*/ ?>
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
    <form id="position_details_form" onsubmit="return false">
        <input type="hidden" v-model="posId">
        <div class="form-group">
            <label>职位编号<b style="color: red;">*</b></label>
            <input type="text" class="form-control" v-model="posNo">
            <small class="form-text text-muted">职位编号是职位的唯一标识，可以使用英文和数字的结合，也可以使纯英文和存数字，当然，下划线也是可以的，但是尽量不要使用中文。</small>
        </div>
        <div class="form-group">
            <label>职位名称<b style="color: red;">*</b></label>
            <input type="text" class="form-control" v-model="posName">
            <small class="form-text text-muted">职位名称就是职位的名字，这里就可以使用中文了。</small>
        </div>
        <div class="form-group">
            <label>备注</label>
            <input type="text" class="form-control" v-model="posRemark">
            <small class="form-text text-muted">这里是备注，可以不写，也可以写一些东西，比如职位的作用。</small>
        </div>
        <button class="btn btn-success" @click="updatePos" v-show="editPos">保存修改</button>
        <button class="btn btn-danger" @click="deletePos" v-show="editPos">删除该职业</button>
        <button class="btn btn-primary" @click="insertPos" v-show="addPos">确认添加</button>
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


<script>
    var pageName = 'personManage';
    var pageUrl = "/app/" + pageName + "/";
    update_navs(pageName);
    setLocal(["系统管理", "组织架构"], "人员管理");
</script>


</html>