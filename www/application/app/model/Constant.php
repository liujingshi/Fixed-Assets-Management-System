<?php
namespace app\app\model;

class Constant {

    // 用户登录状态session的key
    public const USERLOGINSTATUSSESSIONKEY = "USERLOGINSTATUS";

    // 用户登录状态cookie的key
    public const USERLOGINSTATUSCOOKIEKEY = "USERLOGINSTATUS";

    // 用户已经登录状态
    public const USERLOGIN = "LOGIN";

    // 用户没有登录或登出状态
    public const USERLOGOUT = "LOGOUT";

    // 用户未登录时提示的文字
    public const PLEASELOGIN = "请先登录";

    // 登录页面path
    public const LOGINPATH = "/login/home/index";

    // 主页面path
    public const HOMEPATH = "/app/home/index";

}
