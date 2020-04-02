# 固定资产管理系统

* [固定资产管理系统](http://fa.requisiteui.com/pc/login.html)

* [固定资产管理系统移动端](http://fa.requisiteui.com/mobile/index.html)

* [高校固定资产管理系统的设计与实现](https://github.com/liujingshi/Fixed-Assets-Management-System)

---

* 文件夹介绍

| 文件夹 | 作用 |
|:-----|:-----|
|template|模板文件夹，界面设计，前端html|
|template/common|公共文件夹，放置公用js/css/font|
|template/mobile|移动端文件夹，放置移动端html模板|
|template/pc|PC端文件夹，放置PC端html模板|
|---|---|
|document|文档文件夹，相关材料，论文等|
|document/start|开题文档文件夹，放置开题报告、英文文献等|
|document/middle|中期文档文件夹，放置中期文档等|
|document/end|结题文档文件夹，放置论文等|
|---|---|
|www|PC端ThinkPHP目录|

* 所用框架

  * 前端

    * [Bootstrap v4.3.1](https://v4.bootcss.com/)

    * [ECharts v4.5.0](https://www.echartsjs.com/zh/index.html)

    * [jQuery v3.4.1](https://jquery.com/)

    * [Line Awesome v1.3.0](https://icons8.com/line-awesome)

    * [Vue v2.6.11](https://vuejs.org/)

    * [Layer v3.1.1](http://layer.layui.com/)

    * [MUI v3.7.2](https://dev.dcloud.net.cn/mui/)

  * 后端

    * [ThinkPHP v5.0.24](http://www.thinkphp.cn/)

* 自制组件

  * ljsPopup 模仿Mac风格的弹出层组件

  ``` javascript
  /**
   * 直接调用函数ljspopup();
   * 即可弹出
   */
  ljspopup();

  /**
   * 也可以传入具体参数
   * 所有参数均可选
   */
  ljspopup({
    el: "#id", // 内容元素选择器，也可以直接传入html，默认无
    title: "标题", // 标题，默认无
    width: 400, // 宽度（数值），默认自动适应
    height: 300, // 高度（数值），默认自动适应
    top: 200, // 距离顶端距离（数值），默认居中
    left: 300, // 距离左侧距离（数值），默认居中
    min: true, // true|false，是否可以最小化，默认是
    max: true, // true|false，是否可以最大化，默认是
    mask: true, // true|false，是否显示遮罩层，默认是
    move: true, // true|false，是否可以移动，默认是
  });

* Visual Studio Code 插件列表

| 插件名称 | 插件作用 |
|:----|:----|
|Auto Close Tag|自动闭合HTML/XML标签|
|Auto Rename Tag|自动完成另一侧标签的同步修改|
|Beautify|格式化代码|
|Bracket Pair Colorizer|给括号加上不同的颜色|
|HTML CSS Support|智能提示CSS类名以及id|
|HTML Snippets|智能提示HTML标签，以及标签含义|
|JavaScript (ES6) code snippets|ES6语法智能提示，以及快速输入|
|jQuery Code Snippets|jQuery代码智能提示|
|Markdown Preview Enhanced|实时预览markdown|
|markdownlint|markdown语法纠错|
|open in browser|右键快速在浏览器中打开html文件|
|Path Intellisense|自动提示文件路径|
|Vetur|Vue多功能集成插件|
|Material Icon Theme|vscode图标主题|
|filesize|在底部状态栏显示当前文件大小|
|CSS Peek|追踪CSS定义|
|Minify|压缩合并JS、CSS文件，生成min文件|
|Window Colors|每个VSCode窗口都可以独特地自动着色|
|live server|开启本地服务器|

* 更新日志

| 日期 | 内容 |
|:----|:----|
|之前|登录页面，后台框架|
|2019-12-31 02:04:30|后台首页|
|2019-12-31 14:33:20|后台左侧多级导航利用Vue输出，更新了用户信息页和消息页面|
|2020-01-01 13:45:10|新的一年就更新几个vscode插件和二级导航开启关闭动画|
|2020-01-03 00:34:40|更新了写了一天的弹出层组件，模仿Mac风格，初步完成，应该还有bug，由于写了一天脑袋有点乱，所以想不起来bug是啥了|
|2020-01-04 16:03:30|添加了移动端，添加了Bootstrap Table|
|2020-01-05 19:50:20|修改了左侧导航，有点小bug，创建了大量页面，内容没写|
|2020-01-07 21:02:30|编写了手机APP界面，但是突然间ADB连接不上Android模拟器了，就先停了|
|2020-01-08 18:55:30|写了手机端扫描二维码功能|
|2020-01-10 23:27:20|更新了ThinkPHP|
|2020-04-02 17:24:30|好久没push了 一直在本地|
|2020-04-02 17:25:40|更新了数据库操作类和Controller，一个页面一个Controller，一个表一个class，通过python代码自动创建文件|
