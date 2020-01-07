mui.ready(function() {
	var webviews = ["home", "approve", "asset", "assetcheck", "hc", "system"]
	var homeWebview = "home"
	mui.init({})
	mui.plusReady(function() {
		setTimeout(function() {
			mui.preload({
				url: '../menu/menu.html',
				id: 'menu',
				styles: {
					left: '-100%',
					width: '100%',
					zindex: 9997
				}
			})
			app.init()
			for (var i in webviews) {
				mui.preload({
					url: '../' + webviews[i] + '/' + webviews[i] + '.html',
					id: webviews[i]
				})
			}
			setTimeout(function () {
				plus.webview.getWebviewById(homeWebview).show()
				plus.webview.currentWebview().hide()
			}, 300)
		}, 300)
	})
})
