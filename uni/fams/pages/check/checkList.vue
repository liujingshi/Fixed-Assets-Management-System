<template>
	<view>
		<view class="cu-list menu sm-border margin-top">
			<view class="cu-item arrow" v-for="(item,index) in checks" :key="index" :data-no="item.as_no" :data-ccid="item.c_c_id" @tap="check">
				<view class="content">
					<text :class="item.c_c_sta_no == 'DPD' ? 'text-red' : item.c_c_sta_no == 'SHZ' ? 'text-blue' : 'text-green'">
						<p>名称：{{item.as_name}}</p>
						<p>地点：{{item.local_name}}</p>
						<p>分类：{{item.cate_name}}</p>
						<p>状态：{{item.c_c_sta_name}}</p>
					</text>
				</view>
			</view>
		</view>
		<view class="look" v-if="look">
			<image :src="requestUrl + 'image/' + asset.as_image" class="look-img"></image>
			<view class="text-orange">
				请按照这张图片的角度进行拍照以及裁剪
			</view>
			<view class="padding flex flex-direction">
				<button class="cu-btn bg-green lg" @tap="start">开始拍照</button>
			</view>
		</view>
		<crop ref="crop" :pictureSrc="photoSrc" @uploadF="uploadF"></crop>
	</view>
</template>

<script>
	
	import crop from '../../components/crop.vue'
	
	export default {
		data() {
			return {
				checks: [],
				id: 0,
				no: "",
				look: false,
				asset: null,
				requestUrl: null,
				photoSrc: "",
				ccid: 0
			}
		},
		// onBackPress: function () {
		// 	if (this.$refs.crop.isShow) {
		// 		this.$refs.crop.isShow = false
		// 	}
		// 	return true;
		// },
		components: {
			crop
		},
		onLoad: function (options) {
			this.id = options.id
			getApp().sendSocket("getCheckList", {id: options.id})
			this.requestUrl = getApp().globalData.requestUrl
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
				if (msg == "checks") {
					this.checks = obj
				} else if (msg == "assetInfo") {
					if (this.no == obj.as_no) {
						this.asset = obj
						this.look = true
					} else {
						uni.showToast({
							title: "资产与二维码不符"
						})
					}
				} else if (msg == "checkSuccess") {
					uni.showToast({
						icon: "success",
						title: "盘点成功"
					})
					getApp().sendSocket("getCheckList", {id: this.id})
				}
			},
			check: function (e) {
				let no = e.currentTarget.dataset.no
				let ccid = e.currentTarget.dataset.ccid
				this.no = no
				this.ccid = ccid
				uni.scanCode({
					onlyFromCamera: true,
					success: (res) => {
						if (res.result.length < 100) {
							uni.showToast({
								title: "扫码失败请重试"
							})
						} else {
							this.checkQrcode(res.result)
						}
					}
				})
				// this.checkQrcode('eyJuIjozMSwicjEiOiJWeUVydldjTW1DWFJEb1FsY2ZxRnB4S2xEWXNVd1F5Sit0S05QVDhJbFRXMGJRUHFjTGhSSTRVMTI0U3hlaE9hV2kwQ3hrbzJpU2FVNVBkdklzZHpUendxcWVONTQwWlhNbmloU0FuV09FRTFTRnNZK2ZFZFB5bW5DYVVNd3FlMDdzeDBlTmVKSURqOWFpbElVeFJab0d2OFRudUU1VmIzaER0Z3RkM29IOU09IiwicjIiOiJTVEZ6Y21oUVV6ZHVWRTFUTTB0a2N6STVZV1ExVkU5SFVEVmpWM1ZGTVZaR1JEQjJVek5rSzFGRVJuaHJjR0ZtT0UxdGNWQnZSblJhZEhCUGQyNVJhQT09In0=')
			},
			checkQrcode: function (res) {
				getApp().sendSocket("getAssetInfo", {no: res})
			},
			start: function () {
				this.look = false
				uni.chooseImage({
					count: 1,
					sizeType: ["compressed"],
					// sourceType: ['camera'],
					success: res => {
						let path = res.tempFilePaths[0]
						this.photoSrc = path
						this.$refs.crop.isShow = true
						// this.assetInfo.as_image = path
					}
				})
			},
			uploadF: function (e) {
				getApp().uploadF(e, res => {
					this.checkAsset(res.data)
				})
			},
			checkAsset: function (res) {
				getApp().sendSocket("checkAsset", {
					ccid: this.ccid,
					cid: this.id,
					assetImage: this.asset.as_image,
					newImage: res
				})
			}
		}
	}
</script>

<style>
	.look {
		display: flex;
		flex-direction: column;
		position: fixed;
		z-index: 6666;
		background: #fff;
		width: 256px;
		left: calc(50% - 128px);
		top: calc(50% - 173px);
	}
	.look-img {
		width: 100%;
	}
</style>
