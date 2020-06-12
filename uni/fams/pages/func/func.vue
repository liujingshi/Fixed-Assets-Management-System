<template>
	<view>
		<view class="footer-bar">
			<view class="box">
				<view class="cu-bar tabbar bg-white">
					<view class="action text-gray" data-name="home" @tap="barTo">
						<view class="cuIcon-homefill"></view> 首页
					</view>
					<view class="action text-green" data-name="func" @tap="barTo">
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
		<view>
			<view class="cu-list grid col-4">
				<view class="cu-item" v-for="(item,index) in cuIconList" :key="index" :data-act='item.action' @tap="action">
					<view :class="['cuIcon-' + item.cuIcon,'text-' + item.color]">
						<view class="cu-tag badge" v-if="item.badge!=0">
							<block v-if="item.badge!=1">{{item.badge>99?'99+':item.badge}}</block>
						</view>
					</view>
					<text>{{item.name}}</text>
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				cuIconList: null
			}
		},
		onShow: function() {
			uni.onSocketMessage((res) => {
				this.getMessage(JSON.parse(res.data))
			})
			getApp().sendSocket("getFuncList")
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
				} else if (msg == "funcList") {
					this.cuIconList = obj
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
			action: function (e) {
				let name = e.currentTarget.dataset.act
				if (name == "assetImport") {
					uni.scanCode({
						onlyFromCamera: true,
						success: (res) => {
							uni.navigateTo({
								url: "/pages/func/assetimport?no=" + res.result
							})
						}
					})
					// uni.navigateTo({
						// url: "/pages/func/assetimport?no=" + res.result,
						// url: "/pages/func/assetimport?no=eyJuIjo1LCJyMSI6ImNGcXEzOTFJOSt2TTRraGdhM2lTdk9JRG91XC9zWnJcL3ZhRHh4VVFsUk1lK3pQdnlsVlFWZ05JNHlvNmFUNkhaZUZIY1JVK1JVTkJcL2NxOTdiQWNTZVJHTDZwa1NDXC9PcnJXSlFVekxGMGptSXk4NVdjXC9PcFdoQnBkdkhcL1VXM2hUdnhWeGlybFF0ZWhzMFh1ZkxyUDRxSWJvbGswT2d4KzYxcVpDRk1rVnhcL1U9IiwicjIiOiJia3R1WkZGQlMwWnJlRVpLZDBwRWRtNUlTeTlyZUVOTVIxcFJRbWxyTjBaTFZFNU9kbmhuTXpseVJIbGpZVVpyTWpoMGQzaEhTbFp6WWtzd1pYWk9NQT09In0="
					// })
				} else if (name == "borrowlend") {
					uni.scanCode({
						onlyFromCamera: true,
						success: (res) => {
							uni.navigateTo({
								url: "/pages/scan/scan?no=" + res.result + "&action=true"
							})
						}
					})
				} else {
					uni.navigateTo({
						url: '/pages/func/' + name
					})
				}
			}
		}
	}
</script>

<style>

</style>
