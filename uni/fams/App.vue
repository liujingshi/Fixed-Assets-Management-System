<script>
	export default {
		onLaunch: function() {
			this.connectWebSocket()
			this.bindSocket()
		},
		methods: {
			connectWebSocket: function() {
				uni.showLoading({
					title: "正在连接服务器..."
				})
				uni.onSocketOpen(() => {
					uni.hideLoading()
					uni.showToast({
						icon: "success",
						title: "连接成功"
					})
					this.globalData.socketConnectStatus = true
					this.loginSocket()
				})
				uni.onSocketError(() => {
					uni.hideLoading()
					uni.showToast({
						icon: "none",
						title: "连接失败"
					})
				})
				uni.connectSocket({
					url: this.globalData.socketUrl
				})
			},
			bindSocket: function() {
				uni.onSocketClose(() => {
					this.globalData.socketConnectStatus = false
				})
			},
			reConnectSocket: function(msg, obj) {
				uni.showLoading({
					title: "正在重新连接..."
				})
				uni.onSocketOpen(() => {
					uni.hideLoading()
					uni.showToast({
						icon: "success",
						title: "连接成功"
					})
					this.globalData.socketConnectStatus = true
					this.loginSocket()
					setTimeout(() => {
						this.sendSocket(msg, obj)
					}, 1000)
				})
				uni.onSocketError(() => {
					uni.hideLoading()
					uni.showToast({
						icon: "none",
						title: "连接失败"
					})
				})
				uni.closeSocket({
					complete: () => {
						uni.connectSocket({
							url: this.globalData.socketUrl
						})
					}
				})
			},
			loginSocket: function() {
				if (this.getCode()) {
					this.sendSocket("login", {
						code: this.getCode()
					})
				}
			},
			sendSocket: function(msg, obj = "") {
				if (this.globalData.socketConnectStatus) {
					let sendContent = JSON.stringify({
						msg: msg,
						obj: obj
					})
					uni.sendSocketMessage({
						data: sendContent
					})
					console.log("sendMessage:", sendContent)
				} else {
					this.reConnectSocket(msg, obj)
				}
			},
			setCode: function(value) {
				uni.setStorageSync("code", value)
			},
			getCode: function() {
				return uni.getStorageSync("code")
			},
			delCode: function() {
				return uni.removeStorageSync("code")
			},
			scan: function() {
				uni.scanCode({
					onlyFromCamera: true,
					success: (res) => {
						// console.log(res)
						// uni.showToast({
						// 	title: res.result
						// })
						if (res.result.length < 100) {
							uni.showToast({
								title: "扫码失败请重试"
							})
						} else {
							uni.navigateTo({
								url: "/pages/scan/scan?no=" + res.result
							})
						}
					}
				})
			},
			barTo: function(name) {
				uni.redirectTo({
					url: "/pages/" + name + "/" + name
				})
			}
		},
		globalData: {
			userInfo: null,
			userInfoServer: null,
			openid: null,
			phone: null,
			socketConnectStatus: false,
			requestUrl: "http://www.ljs.com/",
			socketUrl: "ws://192.168.1.119:8888"
		}
	}
</script>

<style>
	@import "colorui/main.css";
	@import "colorui/icon.css";

	.footer-bar {
		width: 100%;
		position: fixed;
		left: 0;
		bottom: 0;
		margin-bottom: 0;
	}

	.w100 {
		width: 100%;
	}

	.ls-card {
		width: 95%;
		margin: 20rpx auto 0;
	}
</style>
