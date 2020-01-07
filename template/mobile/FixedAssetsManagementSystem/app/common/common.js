var app = {

	init: function() {
		window.addEventListener("swiperight", this.showMenu)
		window.addEventListener("swipeleft", this.hideMenu)
	},

	showMenu: function() {
		var menu = plus.webview.getWebviewById("menu")
		if (!menu.isVisible()) {
			menu.show('none', 0, function() {
				menu.setStyle({
					left: "0%",
					transition: {
						duration: 150
					}
				})
			})
			mui.fire(menu, 'setShowerID', {id: plus.webview.currentWebview().id})
		}
	},

	hideMenu: function() {
		var menu = plus.webview.getWebviewById("menu")
		if (menu.isVisible()) {
			menu.setStyle({
				left: "-100%",
				transition: {
					duration: 150
				}
			})
			setTimeout(function () {
				menu.hide()
			}, 200)	
		}
	}

}
