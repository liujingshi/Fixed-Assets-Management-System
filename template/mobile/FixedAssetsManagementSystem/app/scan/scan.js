mui.ready(function () {
	mui.init({})
	var bc = null
	var openerID = ""
	mui.plusReady(function () {
	    app.init()
		bc = new plus.barcode.Barcode('scan')
		mui(document).on("tap", "#album", function () {
			bc.cancel()
			plus.gallery.pick(function (path) {
				plus.barcode.scan(path, function (type, code, file) {
					scanOver(type, code, file)
					hideMe()
				}, function (error) {
					mui.message("图片中未发现二维码")
					bc.start()
				})
			}, function (error) {
				bc.start()
			})
		})
		mui(document).on("tap", "#cancel", function () {
			bc.cancel()
			hideMe()
		})
		window.addEventListener("scan", scan)
	})
	function scan(event) {
		bc.start()
		bc.onmarked = function (type, code, file) {
			openerID = event.detail.openerID
			scanOver(type, code, file)
			hideMe()
		}
	}
	function hideMe() {
		plus.webview.currentWebview().hide('slide-out-left', 200)
	}
	function scanOver(type, code, file) {
		mui.fire(plus.webview.getWebviewById(openerID), 'scanOver', {
			type: type,
			code: code,
			file: file
		})
	}
})