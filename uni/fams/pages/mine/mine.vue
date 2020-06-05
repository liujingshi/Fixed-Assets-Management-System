<template>
	<view>
		<view class="footer-bar">
			<view class="box">
				<view class="cu-bar tabbar bg-white">
					<view class="action text-gray" data-name="home" @tap="barTo">
						<view class="cuIcon-homefill"></view> 首页
					</view>
					<view class="action text-gray" data-name="func" @tap="barTo">
						<view class="cuIcon-similar"></view> 功能
					</view>
					<view class="action text-gray add-action" data-name="scan" @tap="barTo">
						<button class="cu-btn cuIcon-scan bg-green shadow"></button> 扫一扫
					</view>
					<view class="action text-gray" data-name="check" @tap="barTo">
						<view class="cuIcon-searchlist"></view> 盘点
					</view>
					<view class="action text-green" data-name="mine" @tap="barTo">
						<view class="cuIcon-my"></view> 我的
					</view>
				</view>
			</view>
		</view>
		<view v-if="!alreadyLogin">
			<view class="ls-card">
				<form v-if="!isWX">
					<view class="cu-form-group">
						<view class="title">手机号码</view>
						<input name="input" :value="phone" @input="setPhone"></input>
						<view class="cu-capsule radius">
							<view class='cu-tag bg-blue '>
								+86
							</view>
							<view class="cu-tag line-blue">
								中国大陆
							</view>
						</view>
					</view>
					<view class="cu-form-group">
						<view class="title">验证码</view>
						<input name="input" :value="code" @input="setCode"></input>
						<button class='cu-btn bg-green shadow' @tap="sendVcode">{{text}}</button>
					</view>
					<view>
						<button class="cu-btn bg-blue margin-tb-sm lg w100" @tap="login">注册/登录/绑定</button>
					</view>
				</form>
				<view v-if="isWX">
					<button class="cu-btn bg-green margin-tb-sm lg w100" open-type="getUserInfo" @getuserinfo="getUserInfo">授权登录</button>
				</view>
			</view>
		</view>
		<view v-if="alreadyLogin">
			<button class="cu-btn bg-blue margin-tb-sm lg ls-card w100" @tap="logout">退出</button>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				alreadyLogin: false,
				isWX: false,
				userInfo: null,
				userInfoServer: null,
				phone: "",
				code: "",
				text: "发送验证码"
			}
		},
		onShow: function() {
			if (getApp().getCode()) {
				this.alreadyLogin = true
			} else {
				this.alreadyLogin = false
			}
			uni.onSocketMessage((res) => {
				this.getMessage(JSON.parse(res.data))
			})
			this.isWX = uni.getSystemInfoSync().platform === 'devtools'
		},
		methods: {
			getMessage: function(data) {
				let msg = data.msg
				let obj = data.obj
				if (msg == "loginSuccess") {
					getApp().setCode(obj.loginCode)
					this.alreadyLogin = true
					uni.showToast({
						icon: 'success',
						title: '登陆成功'
					})
				} else if (msg == "loginError") {
					this.alreadyLogin = false
					getApp().delCode()
					uni.showToast({
						icon: 'none',
						title: '登陆失败'
					})
				} else if (msg == "bindPhone") {
					getApp().globalData.openid = obj.openid
					this.isWX = false
					uni.showToast({
						icon: 'none',
						title: '请绑定手机'
					})
				} else if (msg == "bindPhoneSuccess") {
					getApp().sendSocket("login", {
						"code": getApp().globalData.openid
					})
					uni.showToast({
						icon: 'success',
						title: '绑定成功'
					})
				} else if (msg == "vcode") {
					this.code = obj.vcode
				}
			},
			barTo: function(e) {
				let name = e.currentTarget.dataset.name
				if (name == "scan") {
					getApp().scan()
				} else {
					getApp().barTo(name)
				}
			},
			login: function() {
				let phone = this.phone
				let code = this.code
				getApp().sendSocket("login", {
					"code": phone,
					"vcode": code
				})
			},
			setPhone: function(e) {
				this.phone = e.detail.value
			},
			setCode: function(e) {
				this.code = e.detail.value
			},
			sendVcode: function(e) {
				if (this.text == "发送验证码") {
					getApp().sendSocket("sendVcode", {
						phone: this.phone
					})
					var s = 60
					this.text = `重新发送(${s})`
					var reSendTip = setInterval(() => {
						s = s - 1
						this.text = `重新发送(${s})`
						if (s <= 0) {
							clearInterval(reSendTip)
							this.text = "发送验证码"
						}
					}, 1000)
				}
			},
			logout: function() {
				getApp().sendSocket("logout")
				this.alreadyLogin = false
			}
		},
		oauth(value) {
			uni.login({
				provider: value,
				success: (res) => {
					uni.getUserInfo({
						provider: value,
						success: (infoRes) => {
							let code = infoRes.code
							getApp().sendSocket("login", {
								"code": code
							})
						},
						fail() {
							uni.showToast({
								icon: 'none',
								title: '登陆失败'
							});
						}
					});
				},
				fail: (err) => {
					console.error('授权登录失败：' + JSON.stringify(err));
				}
			});
		},
		getUserInfo({
			detail
		}) {
			if (detail.userInfo) {
				this.userInfo = detail.userInfo
				getApp().globalData.userInfo = detail.userInfo
			} else {
				uni.showToast({
					icon: 'none',
					title: '登陆失败'
				});
			}
		},
	}
</script>

<style>

</style>
