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
		<view class="cu-card dynamic" v-for="(item, index) in bbs" :key="index" :data-bbsid="item.bbs_id" @tap="intoBBSinfo">
			<view class="cu-item shadow">
				<view class="cu-list menu-avatar">
					<view class="cu-item">
						<view class="cu-avatar round lg" style="background-image:url(../../static/logo.png);"></view>
						<view class="content flex-sub">
							<view>匿名用户</view>
							<view class="text-gray text-sm flex justify-between">
								{{item.bbs_time}}
							</view>
						</view>
					</view>
				</view>
				<view class="text-content">
					{{item.bbs_text}}
				</view>
			</view>
		</view>
		<view class="bottom">
			
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				bbs: []
			}
		},
		onShow: function() {
			uni.onSocketMessage((res) => {
				this.getMessage(JSON.parse(res.data))
			})
			getApp().sendSocket("selectBBS")
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
				} else if (msg == "bbs") {
					this.bbs = obj
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
			intoBBSinfo: function (e) {
				let id = e.currentTarget.dataset.bbsid
				uni.navigateTo({
					url: '/pages/home/bbsInfo?id=' + id
				})
			}
		}
	}
</script>

<style>
	.bottom {
		height: 100px;
	}
</style>
