<template>
	<view>
		<view class="footer-bar">
			<view class="box">
				<view class="cu-bar tabbar bg-white">
					<view class="action text-green" data-name="home" @tap="barTo">
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
					<view class="action text-gray" data-name="mine" @tap="barTo">
						<view class="cuIcon-my"></view> 我的
					</view>
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {

			}
		},
		onShow: function() {
			uni.onSocketMessage((res) => {
				this.getMessage(JSON.parse(res.data))
			})
		},
		methods: {
			getMessage: function(data) {
				let msg = data.msg
				let obj = data.obj
				if (msg == "loginError") {
					getApp().delCode()
					uni.redirectTo({
						url: "/pages/mine/mine"
					})
				}
			},
			barTo: function(e) {
				let name = e.currentTarget.dataset.name
				if (name == "scan") {
					getApp().scan()
				} else {
					getApp().barTo(name)
				}
			}
		}
	}
</script>

<style>

</style>
