<template>
	<view>
		<form>
			<view class="cu-form-group">
				<view class="title">资产编号</view>
				<input disabled="true" name="input" :value="assetInfo.as_no"></input>
			</view>
			<view class="cu-form-group">
				<view class="title">资产名称</view>
				<input name="input" :value="assetInfo.as_name" data-value="as_name" @input="setValue"></input>
			</view>
			<view class="cu-form-group">
				<view class="title">资产价格</view>
				<input name="input" :value="assetInfo.as_price" data-value="as_price" @input="setValue"></input>
			</view>
			<view class="cu-form-group">
				<view class="title">资产分类</view>
				<picker @change="setCate" :value="cate_index" :range="category" range-key="cate_name">
					<view class="picker">
						{{category[cate_index].cate_name}}
					</view>
				</picker>
			</view>
			<view class="cu-form-group">
				<view class="title">资产状态</view>
				<input disabled="true" name="input" :value="assetInfo.sta_name"></input>
			</view>
			<view class="cu-form-group">
				<view class="title">入库时间</view>
				<input disabled="true" name="input" :value="assetInfo.as_import_time"></input>
			</view>
			<view class="cu-form-group">
				<view class="title">资产地点</view>
				<picker @change="setLocal" :value="local_index" :range="local" range-key="local_name">
					<view class="picker">
						{{local[local_index].local_name}}
					</view>
				</picker>
			</view>
			<view class="cu-bar bg-white margin-top">
				<view class="action">
					资产图片
				</view>
			</view>
			<view class="cu-form-group">
				<view class="grid col-4 grid-square flex-sub">
					<view class="bg-img" v-if="assetInfo.as_image!=''">
						<image :src="requestUrl + 'image/' + assetInfo.as_image" mode="aspectFill"></image>
						<!-- <image :src="assetInfo.as_image" mode="aspectFill"></image> -->
						<view class="cu-tag bg-red" @tap.stop="DelImg">
							<text class='cuIcon-close'></text>
						</view>
					</view>
					<view class="solids" @tap="makeImage" v-if="assetInfo.as_image==''">
						<text class='cuIcon-cameraadd'></text>
					</view>
				</view>
			</view>
			<view class="margin-top ls-card">
				<button class="cu-btn bg-blue margin-tb-sm lg w100" @tap="save">保存</button>
			</view>
		</form>
		<crop ref="crop" :pictureSrc="photoSrc" @uploadF="uploadF"></crop>
	</view>
</template>

<script>
	
	import crop from '../../components/crop.vue'
	
	export default {
		data() {
			return {
				assetInfo: null,
				category: null,
				local: null,
				cate_index: 0,
				local_index: 0,
				requestUrl: null,
				photoSrc: ""
			}
		},
		onLoad: function(options) {
			getApp().sendSocket("getAssetInfo", {
				no: options.no
			})
			getApp().sendSocket("getCategory")
			getApp().sendSocket("getLocal")
			this.requestUrl = getApp().globalData.requestUrl
		},
		onShow: function() {
			uni.onSocketMessage((res) => {
				this.getMessage(JSON.parse(res.data))
			})
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
				} else if (msg == "assetInfo") {
					this.assetInfo = obj
					this.setLocalIndex()
					this.setCateIndex()
				} else if (msg == "category") {
					this.category = obj
					this.setCateIndex()
				} else if (msg == "local") {
					this.local = obj
					this.setLocalIndex()
				} else if (msg == "assetImportSuccess") {
					uni.showToast({
						icon: "success",
						title: "保存成功"
					})
				}
			},
			setValue: function(e) {
				let name = e.currentTarget.dataset.value
				this.assetInfo[name] = e.detail.value
			},
			DelImg: function(e) {
				this.assetInfo.as_image = ""
			},
			makeImage: function(e) {
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
			setCate: function(e) {
				let cate_index = e.detail.value
				this.cate_index = cate_index
				this.assetInfo.cate_id = this.category[cate_index].cate_id
			},
			setLocal: function(e) {
				let local_index = e.detail.value
				this.local_index = local_index
				this.assetInfo.as_local_id = this.local[local_index].local_id
			},
			setLocalIndex: function() {
				if (this.assetInfo && this.local) {
					for (let i in this.local) {
						if (this.local[i].local_id == this.assetInfo.as_local_id) {
							this.local_index = i
							break
						}
					}
				}
			},
			setCateIndex: function() {
				if (this.assetInfo && this.category) {
					for (let i in this.category) {
						if (this.category[i].cate_id == this.assetInfo.cate_id) {
							this.cate_index = i
							break
						}
					}
				}
			},
			save: function() {
				getApp().sendSocket("assetImport", this.assetInfo)
			},
			uploadF: function (e) {
				getApp().uploadF(e, res => {
					this.assetInfo.as_image = res.data
				})
			}
		}
	}
</script>

<style>

</style>
