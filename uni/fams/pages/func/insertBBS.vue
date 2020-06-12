<template>
	<view>
		<form>
			<view class="cu-form-group margin-top">
				<textarea maxlength="-1" @input="textareaAInput" placeholder="请输入帖子内容"></textarea>
			</view>
			<view class="padding flex flex-direction">
				<button class="cu-btn bg-green lg" @tap="send">发布帖子</button>
			</view>
		</form>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				text: ""
			}
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
				if (msg == "insertBBSSuccess") {
					uni.showToast({
						icon: "success",
						title: "发布成功"
					})
				}
			},
			textareaAInput: function(e) {
				this.text = e.detail.value
			},
			send: function () {
				if (this.text != "") {
					getApp().sendSocket("insertBBS", {
						"bbs_text": this.text
					})
				}
			}
		}
	}
</script>

<style>

</style>
