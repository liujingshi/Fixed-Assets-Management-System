mui.ready(function () {
	mui.init({})
	mui.plusReady(function () {
	    app.init()
		mui(".header").on("tap", ".menu", function () {
			app.showMenu()
		})
		mui(".footer").on("tap", "button", function () {
			app.scan()
		})
		window.addEventListener("scanOver", scanOver)
	})
	function scanOver(event) {
		var data = event.detail
		mui.alert(data.code, "扫描结果", "确定", function(){}, "div")
	}
})