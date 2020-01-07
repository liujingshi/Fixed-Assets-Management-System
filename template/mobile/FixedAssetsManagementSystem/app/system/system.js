mui.ready(function () {
	mui.init({})
	mui.plusReady(function () {
	    app.init()
		mui(".header").on("tap", ".menu", function () {
			app.showMenu()
		})
	})
})