<?php
namespace app\app\model;

class Constant {

    // 用户登录状态session的key
    public const USERLOGINSTATUS = "USERLOGINSTATUS";

    // 用户id session的key
    public const USERID = "USERID";

    // 用户已经登录状态
    public const USERLOGIN = "LOGIN";

    // 用户没有登录或登出状态
    public const USERLOGOUT = "LOGOUT";

    // 用户未登录时提示的文字
    public const PLEASELOGIN = "请先登录";

    // 无权限时提示的文字
    public const POWERERROR = "权限不足";

    // 登录页面path
    public const LOGINPATH = "/login/home/index";

    // 主页面path
    public const HOMEPATH = "/app/home/index";

    /**
     * 数据库操作类namespace
     */
    public const DBNAMESPACE = "app\\common\\model\\";

}
