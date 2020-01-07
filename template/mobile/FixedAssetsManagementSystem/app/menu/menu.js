var showerID = ""
var data = [{
	name: "home",
	title: "首页",
	icon: "las la-home"
}, {
	name: "asset",
	title: "资产管理",
	icon: "las la-coins"
}, {
	name: "hc",
	title: "耗材管理",
	icon: "las la-ruler-combined"
}, {
	name: "assetcheck",
	title: "盘点管理",
	icon: "las la-calculator"
}, {
	name: "system",
	title: "系统管理",
	icon: "lab la-windows"
}, {
	name: "approve",
	title: "我的审批",
	icon: "las la-stamp"
}]
new Vue({
	el: ".menu-content",
	data: {
		data: data
	}
})
mui.ready(function () {
	mui.init({})
	mui.plusReady(function () {
		app.init()
		window.addEventListener("setShowerID", setShowerID)
		mui(".menu-content").on("tap", ".menu-item", function () {
			var webviewID = this.getAttribute("webview")
			plus.webview.getWebviewById(showerID).hide()
			plus.webview.getWebviewById(webviewID).show()
			app.hideMenu()
		})
		mui(document).on("tap", "#hide", function () {
			app.hideMenu()
		})
	})
	function setShowerID(event) {
		showerID = event.detail.id
	}
})