var showerID = ""
mui.ready(function () {
	mui.init({})
	mui.plusReady(function () {
		app.init()
		window.addEventListener("setShowerID", setShowerID)
		window.addEventListener("showerReturn", showerReturn)
	})
	function setShowerID(event) {
		showerID = event.detail.id
	}
	function showerReturn() {
		plus.webview.getWebviewById(showerID).setStyle({
			left: "0%",
			transition: {
				duration: 150
			}
		})
	}
})