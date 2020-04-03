<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:99:"E:\code\git\Fixed-Assets-Management-System\www\public/../application/app\view\department\index.html";i:1585895257;s:80:"E:\code\git\Fixed-Assets-Management-System\www\application\common\view\base.html";i:1585894895;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>高校固定资产管理系统</title>

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
                                            <div id="treeview"></div>
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
    update_navs('department');
    var json = [{
            text: 'Parent 1',
            children: [{
                    text: 'Child 1',
                    children: [{
                            text: 'Grandchild 1'
                        },
                        {
                            text: 'Grandchild 2'
                        }
                    ]
                },
                {
                    text: 'Child 2'
                }
            ]
        },
        {
            text: 'Parent 2'
        },
        {
            text: 'Parent 3'
        },
        {
            text: 'Parent 4'
        },
        {
            text: 'Parent 5'
        }
    ];
    var treeview = $("#treeview").tree({
        dataSource: json
    });
</script>


</html>