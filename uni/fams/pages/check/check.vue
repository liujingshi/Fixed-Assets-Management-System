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
					<view class="action text-green" data-name="check" @tap="barTo">
						<view class="cuIcon-searchlist"></view> 盘点
					</view>
					<view class="action text-gray" data-name="mine" @tap="barTo">
						<view class="cuIcon-my"></view> 我的
					</view>
				</view>
			</view>
		</view>
		<view class="cu-list menu sm-border  margin-top">
			<view class="cu-item arrow" v-for="(item,index) in checks" :key="index" :data-cid="item.c_id" @tap="intoCheck">
				<view class="content">
					<text class="cuIcon-circlefill text-grey"></text>
					<text class="text-grey">{{item.c_title}}</text>
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				checks: null
			}
		},
		onShow: function() {
			uni.onSocketMessage((res) => {
				this.getMessage(JSON.parse(res.data))
			})
			getApp().sendSocket("getChecks")
		},
		methods: {
			getMessage: function(data) {
				uni.hideLoading()
				let msg = data.msg
				let obj = data.obj
				if (msg == "loginError") {
					getApp().delCode()
					uni.redirectTo({
						url: "/pages/mine/mine"
					})
				} else if (msg == "checks") {
					this.checks = obj
				}
			},
			intoCheck: function (e) {
				let cid = e.currentTarget.dataset.cid
				uni.navigateTo({
					url: "/pages/check/checkList?id=" + cid
				})
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
