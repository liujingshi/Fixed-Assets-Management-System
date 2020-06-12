<template>
	<view>
		<view class="cu-card dynamic">
			<view class="cu-item shadow">
				<view class="cu-list menu-avatar">
					<view class="cu-item">
						<view class="cu-avatar round lg" style="background-image:url(../../static/logo.png);"></view>
						<view class="content flex-sub">
							<view>匿名用户</view>
							<view class="text-gray text-sm flex justify-between">
								{{bbs.length > 0 ? bbs[0].bbs_time : "玩命加载中..."}}
							</view>
						</view>
					</view>
				</view>
				<view class="text-content">
					{{bbs.length > 0 ? bbs[0].bbs_text : "玩命加载中..."}}
				</view>
		
				<view class="cu-list menu-avatar comment solids-top">
					<view class="cu-item" v-for="(item, index) in bbs" v-if="index > 0" :key="index" :data-bbsid="item.bbs_id">
						<view class="cu-avatar round" style="background-image:url(../../static/logo.png);"></view>
						<view class="content">
							<view class="text-grey">匿名用户</view>
							<view class="text-gray text-content text-df">
								{{item.bbs_text}}
							</view>
							<view class="margin-top-sm flex justify-between">
								<view class="text-gray text-df">{{item.bbs_time}}</view>
							</view>
						</view>
					</view>
		
				</view>
			</view>
		</view>
		<form>
			<view class="cu-form-group margin-top">
				<textarea maxlength="-1" @input="textareaAInput" placeholder="请输入回复内容"></textarea>
			</view>
			<view class="padding flex flex-direction">
				<button class="cu-btn bg-green lg" @tap="send">回复帖子</button>
			</view>
		</form>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				bbs: [],
				id: 0,
				text: ""
			}
		},
		onLoad: function(options) {
			this.id = options.id
			getApp().sendSocket("selectRecovery", {id: options.id})
		},
		onShow: function() {
			uni.onSocketMessage((res) => {
				this.getMessage(JSON.parse(res.data))
			})
		},
		methods: {
			getMessage: function(data) {
				uni.hideLoading()
				let msg = data.msg
				let obj = data.obj
				if (msg == "recovery") {
					this.bbs = obj
				} else if (msg == "recoveryBBSSuccess") {
					uni.showToast({
						icon: "success",
						title: "回复成功"
					})
					getApp().sendSocket("selectRecovery", {id: this.id})
				}
			},
			textareaAInput: function(e) {
				this.text = e.detail.value
			},
			send: function () {
				if (this.text != "") {
					getApp().sendSocket("recoveryBBS", {
						"up_bbs_id": this.id,
						"bbs_text": this.text
					})
				}
			}
		}
	}
</script>

<style>

</style>
