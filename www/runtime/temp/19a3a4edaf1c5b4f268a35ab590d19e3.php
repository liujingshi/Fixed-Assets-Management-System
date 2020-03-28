<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:96:"E:\code\git\Fixed-Assets-Management-System\www\public/../application/login\view\index\index.html";i:1585365126;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>登录 - 固定资产管理系统</title>

    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="/static/css/login.css">

</head>

<body>

    <div class="container">

        <div class="row">
            <h1 class="text-primary page-title">固定资产管理系统</h1>
        </div>

        <div class="row">

            <div class="col-lg-4 col-md-4 col-sm-3"></div>
            <div class="col-lg-4 col-md-4 col-sm-6 tab">

                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="nav-item">
                        <a href="#phone" class="nav-link active" aria-controls="phone" role="tab" data-toggle="tab">手机号登录</a>
                    </li>
                    <li role="presentation" class="nav-item">
                        <a href="#wechat" class="nav-link" aria-controls="wechat" role="tab" data-toggle="tab">微信登录</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="phone">
                        <form class="phone-login" @submit.prevent="do_login">
                            <div class="form-group">
                                <label for="username">手机号</label>
                                <input type="text" class="form-control" id="username" placeholder="请输入手机号">
                            </div>
                            <div class="form-group">
                                <label for="verify">验证码</label>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-6">
                                        <input type="text" class="form-control" id="verify" placeholder="请输入验证码">
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                        <img class="verify-img" src="<?php echo captcha_src(); ?>" alt="验证码">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="code">短信验证码</label>
                                <div class="row">
                                    <div class="col-sm-7 col-xs-7">
                                        <input type="text" class="form-control" id="code" placeholder="请输入短信验证码">
                                    </div>
                                    <div class="col-sm-5 col-xs-5">
                                        <button @click="send" type="button"
                                            class="btn btn-outline-dark">发送验证码</button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">登录</button>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="wechat">
                        <div class="wechat-login">
                            <img src="/static/images/login_qr.jpg" alt="微信登录二维码">
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-4 col-sm-3"></div>

        </div>

    </div>

</body>

<script src="/static/jquery/jquery-3.4.1.min.js"></script>
<script src="/static/layer/layer.js"></script>
<script src="/static/vue/vue.min.js"></script>
<script src="/static/vue/axios.min.js"></script>
<script src="/static/bootstrap/js/bootstrap.min.js"></script>
<script src="/static/js/login.js"></script>

</html>
