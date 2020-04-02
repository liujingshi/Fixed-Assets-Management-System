<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <title>跳转提示</title>
    <link rel="stylesheet" href="__STATIC__/bootstrap/css/bootstrap.min.css">
    <style>
        html,
        body {
            margin: 0;
            width: 100%;
            height: 100%;
            background: url(__IMAGES__/dump_bg.jpg) no-repeat;
            background-size: 100% 100%;
        }

        .card {
            width: 400px;
            height: 400px;
            background: rgba(248, 215, 218, .9);
            position: fixed;
            top: calc(50% - 200px);
            left: calc(50% - 200px);
            border: 1px solid #f5c6cb;
            color: #721c24;
            text-align: center;
        }

        .card-title {
            font-size: 40px;
            line-height: 200px;
        }

        .card-text {
            font-size: 20px;
        }

        .btn {
            width: 100%;
            margin-top: 40px;
        }

        .progress, .progress-bar {
            transition: all 0s;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo(strip_tags($msg));?></h5>
            <p class="card-text">页面将在<b id="wait"><?php echo($wait);?></b>s后自动跳转</p>
            <div class="progress">
                <div class="progress-bar bg-danger" id="pro" role="progressbar" style="width: 0%" aria-valuenow="0"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <a id="href" href="<?php echo($url);?>" class="btn btn-danger">立即前往</a>
        </div>
    </div>
</body>
<script>
    (function () {
        var wait = document.getElementById('wait'),
            href = document.getElementById('href').href,
            pro = document.getElementById('pro');
        var timeAll = wait.innerHTML * 100;
        var time = timeAll;
        var interval = setInterval(function () {
            time = time - 1;
            bfb = parseInt((timeAll - time) / timeAll * 100);
            if (bfb <= 100) {
                wait.innerHTML = parseInt(time/100);
                pro.setAttribute("style", "width: " + bfb + "%");
                pro.setAttribute("aria-valuenow", bfb);
            }
            if (time <= 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 10);
    })();
</script>

</html>