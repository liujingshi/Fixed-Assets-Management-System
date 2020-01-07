var app = {

	me: null,
	menu: null,

	init: function() {
		me = plus.webview.currentWebview()
		menu = plus.webview.getWebviewById("menu")
		window.addEventListener("swiperight", this.showMenu)
		window.addEventListener("swipeleft", this.hideMenu)
	},

	showMenu: function() {
		if (!this.menu.isVisible()) {
			this.menu.show('none', 0, function() {
				this.menu.setStyle({
					left: "0%",
					transition: {
						duration: 150
					}
				})
				this.me.setStyle({
					left: "100%",
					transition: {
						duration: 150
					}
				})
			})
			mui.fire(this.menu, 'setShowerID', {id: this.me.id})
		}
	},

	hideMenu: function() {
		if (this.menu.isVisible()) {
			this.menu.setStyle({
				left: "-100%",
				transition: {
					duration: 150
				}
			})
			if (this.me.id != this.menu.id) {
				this.me.setStyle({
					left: "0%",
					transition: {
						duration: 150
					}
				})
			} else {
				mui.fire(this.menu, 'showerReturn')
			}
			this.menu.hide()
		}
	}

}
