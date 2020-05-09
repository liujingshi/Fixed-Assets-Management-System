<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:93:"E:\code\git\Fixed-Assets-Management-System\www\public/../application/app\view\home\index.html";i:1589027669;s:80:"E:\code\git\Fixed-Assets-Management-System\www\application\common\view\base.html";i:1586071758;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>首页 - 高校固定资产管理系统</title>

    <link rel="stylesheet" href="/static/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="/static/layui/css/layui.css">
    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/gijgo/css/gijgo.min.css">
    <link rel="stylesheet" href="/static/common/common.css">
    <link rel="stylesheet" href="/static/common/ljspopup.css">
    <link rel="stylesheet" href="/static/css/main.css">

    
<style>
    .task-panel {
        width: 100%;
        height: 80px;
        border-radius: 5px;
        background: url(/static/images/task_panel_back.jpg) no-repeat;
        background-size: 100% 100%;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        margin-top: 20px;
        box-shadow: 0 1px 10px rgba(0, 0, 0, .3);
    }

    .task-panel-header {
        font-size: 14px;
        color: #fff;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .task-panel-body {
        font-size: 28px;
        font-weight: bolder;
        color: #fff;
        height: 40px;
        display: flex;
        align-items: flex-start;
        justify-content: center;
    }

    .left-pie {
        width: 100%;
        height: 200px;
        display: flex;
        flex-direction: column;
    }

    .left-pie-item,
    .right-pie-item {
        width: 100%;
        flex: 2;
        display: flex;
        flex-direction: column;
    }

    .right-pie-item {
        margin-top: 20px;
    }

    .left-pie-item-header,
    .right-pie-item-header {
        font-size: 12px;
        color: #999;
    }

    .right-pie-item-header {
        display: flex;
        align-items: center;
    }

    .right-pie-item-header>i {
        margin-right: 3px;
        font-size: 18px;
    }

    .left-pie-item-body,
    .right-pie-item-body {
        font-size: 18px;
        color: #616161;
        font-weight: bolder;
        margin-top: 5px;
    }

    .right-pie-item-body {
        padding-left: 20px;
    }

    .home-two-btn-div,
    .home-three-btn-div {
        width: 100%;
        display: flex;
        flex-direction: row;
        margin-bottom: 10px;
    }

    .home-two-btn {
        padding: 8px 26px;
        font-size: 14px;
        color: #c4c5c9;
        border-radius: 3px;
        cursor: pointer;
    }

    .home-two-btn-active {
        background: #d6e7f9;
        color: #668eff;
    }

    .home-three-btn {
        padding: 8px 16px;
        font-size: 14px;
        color: #555;
        cursor: pointer;
        border: 1px solid #ddd;
    }

    .home-three-btn:first-child {
        border-radius: 3px 0 0 3px;
        border-right: 0;
    }

    .home-three-btn:last-child {
        border-radius: 0 3px 3px 0;
        border-left: 0;
    }

    .home-three-btn-active {
        background: #668eff;
        color: #d6e7f9;
        border: #668eff;
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

    <div class="row row-header"></div>

    <!-- 第1行 -->
    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-2">
            <div class="task-panel">
                <div class="task-panel-header">待审批任务</div>
                <div class="task-panel-body">0</div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <div class="task-panel">
                <div class="task-panel-header">待签字任务</div>
                <div class="task-panel-body">0</div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <div class="task-panel">
                <div class="task-panel-header">维保到期资产</div>
                <div class="task-panel-body">0</div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <div class="task-panel">
                <div class="task-panel-header">保修资产数</div>
                <div class="task-panel-body">0</div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <div class="task-panel">
                <div class="task-panel-header">待确认调拨单</div>
                <div class="task-panel-body">0</div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-2">
            <div class="task-panel">
                <div class="task-panel-header">安全库存报警</div>
                <div class="task-panel-body">0</div>
            </div>
        </div>
    </div>

    <!-- 第2行 -->
    <div class="row">
        <div class="col-md-6">
            <div class="home-panel">
                <div class="home-panel-header">
                    <i class="las la-chart-pie"></i>
                    <span>资产概况</span>
                </div>
                <div class="home-panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div id="chart_pie_use" style="width: 100%; height:200px;"></div>
                                </div>
                                <div class="col-sm-6 visible-lg-block">
                                    <div class="left-pie">
                                        <div class="left-pie-item">
                                            <h3 class="text-primary">在用资产</h3>
                                        </div>
                                        <div class="left-pie-item">
                                            <div class="left-pie-item-header">资产数量</div>
                                            <div class="left-pie-item-body zy_num" ></div>
                                        </div>
                                        <div class="left-pie-item">
                                            <div class="left-pie-item-header">资产金额</div>
                                            <div class="left-pie-item-body">￥<span id="zy_price"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div id="chart_pie_unuse" style="width: 100%; height:200px;"></div>
                                </div>
                                <div class="col-sm-6 visible-lg-block">
                                    <div class="left-pie">
                                        <div class="left-pie-item">
                                            <h3 class="text-success">闲置资产</h3>
                                        </div>
                                        <div class="left-pie-item">
                                            <div class="left-pie-item-header">资产数量</div>
                                            <div class="left-pie-item-body xz_num"></div>
                                        </div>
                                        <div class="left-pie-item">
                                            <div class="left-pie-item-header">资产金额</div>
                                            <div class="left-pie-item-body">￥<span id="xz_price"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="home-panel">
                <div class="home-panel-header">
                    <i class="las la-chart-pie"></i>
                    <span>资产状态占比</span>
                </div>
                <div class="home-panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div id="chart_pie_state" style="width: 100%; height:200px;"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="right-pie-item">
                                        <div class="right-pie-item-header">
                                            <i class="las la-dot-circle text-success"></i>
                                            <span>闲置</span>
                                        </div>
                                        <div class="right-pie-item-body xz_num"></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="right-pie-item">
                                        <div class="right-pie-item-header">
                                            <i class="las la-dot-circle text-primary"></i>
                                            <span>在用</span>
                                        </div>
                                        <div class="right-pie-item-body zy_num"></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="right-pie-item">
                                        <div class="right-pie-item-header">
                                            <i class="las la-dot-circle text-danger"></i>
                                            <span>审批中</span>
                                        </div>
                                        <div class="right-pie-item-body" id="spz_num">0</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="right-pie-item">
                                        <div class="right-pie-item-header">
                                            <i class="las la-dot-circle text-warning"></i>
                                            <span>维修</span>
                                        </div>
                                        <div class="right-pie-item-body">0</div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="right-pie-item">
                                        <div class="right-pie-item-header">
                                            <i class="las la-dot-circle text-info"></i>
                                            <span>调拨中</span>
                                        </div>
                                        <div class="right-pie-item-body">0</div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="right-pie-item">
                                        <div class="right-pie-item-header">
                                            <i class="las la-dot-circle text-muted"></i>
                                            <span>报废</span>
                                        </div>
                                        <div class="right-pie-item-body">0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 第3行 -->
    <div class="row">
        <div class="col-md-12">
            <div class="home-panel">
                <div class="home-panel-header">
                    <i class="las la-chart-bar"></i>
                    <span>资产分类统计</span>
                </div>
                <div class="home-panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="home-two-btn-div">
                                <div class="home-two-btn home-two-btn-active" id="cate_num_btn">数量</div>
                                <div class="home-two-btn" id="cate_price_btn">金额</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="chart_bar_class" style="width: 100%; height:320px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 第4行 -->
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="home-panel">
                <div class="home-panel-header">
                    <i class="las la-chart-bar"></i>
                    <span>资产使用情况</span>
                </div>
                <div class="home-panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="home-two-btn-div">
                                <div class="home-two-btn home-two-btn-active">数量</div>
                                <div class="home-two-btn">金额</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="home-three-btn-div">
                                <div class="home-three-btn home-three-btn-active">最近一年</div>
                                <div class="home-three-btn">最近半年</div>
                                <div class="home-three-btn">最近三个月</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="chart_bar_use" style="width: 100%; height:320px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="home-panel">
                <div class="home-panel-header">
                    <i class="las la-chart-line"></i>
                    <span>耗材领用情况</span>
                </div>
                <div class="home-panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="home-two-btn-div">
                                <div class="home-two-btn home-two-btn-active">数量</div>
                                <div class="home-two-btn">金额</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="home-three-btn-div">
                                <div class="home-three-btn home-three-btn-active">最近一年</div>
                                <div class="home-three-btn">最近半年</div>
                                <div class="home-three-btn">最近三个月</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="chart_line_use" style="width: 100%; height:320px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 第5行 -->
    <div class="row">
        <div class="col-md-12">
            <div class="home-panel">
                <div class="home-panel-header">
                    <i class="las la-fighter-jet"></i>
                    <span>快捷操作</span>
                </div>
                <div class="home-panel-body">暂无</div>
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


<script src="/static/js/charts.js"></script>
<script>
    var pageName = 'home';
    var pageUrl = "/app/" + pageName + "/";
    update_navs(pageName);
    setLocal([], "首页");
    $(".home-two-btn").click(function () {
        $(this).parent().find(".home-two-btn").removeClass("home-two-btn-active");
        $(this).addClass("home-two-btn-active");
    });

    $(".home-three-btn").click(function () {
        $(this).parent().find(".home-three-btn").removeClass("home-three-btn-active");
        $(this).addClass("home-three-btn-active");
    });

    $.post(pageUrl + "topnum", {}, function (res) {
        var data = JSON.parse(res)
        $(".task-panel-body").eq(0).html(data.spz)
    })

    $(".task-panel-body").eq(0).click(() => {
        window.location.href = "/app/blapprove"
    })
</script>


</html>