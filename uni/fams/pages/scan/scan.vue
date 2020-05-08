<template>
	<view>
		<view class="cu-list menu card-menu margin-top">
			<view class="cu-item">
				<view class="content">
					<text class="cuIcon-circlefill text-blue"></text>
					<text class="text-blue">{{assetInfo.as_no}}</text>
				</view>
			</view>
			<view class="cu-item">
				<view class="content">
					<text class="cuIcon-newshotfill text-purple"></text>
					<text class="text-purple">{{assetInfo.as_name}}</text>
				</view>
			</view>
			<view class="cu-item">
				<view class="content">
					<text class="cuIcon-moneybagfill text-orange"></text>
					<text class="text-orange">{{assetInfo.as_price}}</text>
				</view>
			</view>
			<view class="cu-item">
				<view class="content">
					<text class="cuIcon-tagfill text-green"></text>
					<text class="text-green">{{assetInfo.cate_name}}</text>
				</view>
			</view>
			<view class="cu-item">
				<view class="content">
					<text class="cuIcon-attentionfill text-pink"></text>
					<text class="text-pink">{{assetInfo.sta_name}}</text>
				</view>
			</view>
			<view class="cu-item">
				<view class="content">
					<text class="cuIcon-countdownfill text-grey"></text>
					<text class="text-grey">{{assetInfo.as_import_time}}</text>
				</view>
			</view>
			<view class="cu-item">
				<view class="content">
					<text class="cuIcon-locationfill text-brown"></text>
					<text class="text-brown">{{assetInfo.local_name}}</text>
				</view>
			</view>
		</view>
		<view v-if="canAction" class="ls-card margin-top">
			<view class="grid col-5 padding-sm">
				<view class="margin-tb-sm text-center" v-if="assetInfo.sta_no == 'XZ'">
					<button class="cu-btn round bg-blue shadow" @tap="borrow">领用</button>
				</view>
				<view class="margin-tb-sm text-center" v-if="isMe">
					<button class="cu-btn round bg-orange shadow" @tap="lend">归还</button>
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				assetInfo: null,
				canAction: false,
				isMe: false
			}
		},
		onLoad: function(options) {
			getApp().sendSocket("getAssetInfo", {no: options.no})
			getApp().sendSocket("isMe", {no: options.no})
			if (options.action && options.action == "true") {
				this.canAction = true
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
				if (msg == "assetInfo") {
					this.assetInfo = obj
				} else if (msg == "isMe") {
					this.isMe = true
				} else if (msg == "borrowSuccess") {
					uni.showToast({
						icon: "success",
						title: "领用成功"
					})
					this.canAction = false
				} else if (msg == "lendSuccess") {
					uni.showToast({
						icon: "success",
						title: "归还成功"
					})
					this.canAction = false
				}
			},
			borrow: function () {
				getApp().sendSocket("assetBorrow", {as_no: this.assetInfo.as_no})
			},
			lend: function () {
				getApp().sendSocket("assetLend", {as_no: this.assetInfo.as_no})
			}
		}
	}
</script>

<style>

</style>
