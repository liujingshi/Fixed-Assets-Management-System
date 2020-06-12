<template>
	<view class="picture-tailor" :class="{'picture-tailor-show':isShow}">
		<movable-area class="picture-area">
			<movable-view class="picture-view" :style="{width:img_width/img_scaling+'px',height:img_height/img_scaling+'px'}"
			 direction="all" :x="offsetX" :y="offsetY" scale="true" :scale-min="scaleMin" @change="movableChange" @scale="movableScale">
				<image :style="{width:img_width/img_scaling+'px',height:img_height/img_scaling+'px'}" :src="pictureSrc"></image>
			</movable-view>
		</movable-area>
		<view class="select-box"></view>
		<button class="button-view" @click="createImg">完成</button>
		<canvas canvas-id="picture-canvas" class="canvas-view"></canvas>
	</view>
</template>

<script>
	
	let tailorSize = 512; // 需要截取的尺寸240x240px，此变量要和样式中的240px和120px相对应，120px为此变量的一半，若要修改成其他值一定要一一对应
	let	newOffsetX = 0; // 拖动缩放完成后的X轴偏移量
	let newOffsetY = 0; // 拖动缩放完成后的Y轴偏移量
	
	export default {
		name: "crop",
		props: {
			// 图片路径
			pictureSrc: {
				type: String,
				required: true
			}
		},
		data() {
			return {
				offsetX: 0, // 图像初始化的X轴偏移量
				offsetY: 0, // 图像初始化的Y轴偏移量
				img_width: 0, // 图片真实宽度
				img_height: 0, // 图片真实高度
				img_scaling: 5, //图片初始化缩放比例
				scale: 1, // 拖动缩放完成后的图片缩放比例
				scaleMin: 0.1, // 最小缩放值
				isShow: false
			};
		},
		watch: {
			pictureSrc() {
				this.getImgInfo();
			}
		},
		methods: {
			// 显示组件
			onShow() {
				this.isShow = true;
			},
			// 隐藏组件
			onHide() {
				this.isShow = false;
			},
			// 初始化图片
			getImgInfo() {
				uni.getImageInfo({
					src: this.pictureSrc,
					success: (res) => {
						// 图片宽高
						this.img_width = res.width;
						this.img_height = res.height;
						// 屏幕可用宽高
						let sysInfo = uni.getSystemInfoSync();
						let windowWidth = sysInfo.windowWidth;
						let windowHeight = sysInfo.windowHeight;
						
						// 计算初始缩放比和最小缩放值
						if (this.img_width < tailorSize || this.img_height < tailorSize) { // 当图片宽或高小于240px时
							let count = this.img_width <= this.img_height ? this.img_width : this.img_height;
							this.img_scaling = count / tailorSize;
							this.scaleMin = 1;
						} else if (this.img_width > windowWidth && this.img_width <= this.img_height) { // 当图片宽度大于屏幕宽度并且图片宽度小于图片高度时
							this.img_scaling = this.img_width / windowWidth;
							this.scaleMin = tailorSize / windowWidth;
						} else {
							let count = this.img_width <= this.img_height ? this.img_width : this.img_height;
							this.scaleMin = tailorSize / count;
						}

						// 计算图片居中显示时的偏移量
						this.offsetX = -(this.img_width / this.img_scaling / 2 - tailorSize / 2);
						this.offsetY = -(this.img_height / this.img_scaling / 2 - tailorSize / 2);
						// 获取新的偏移量
						newOffsetX = this.offsetX;
						newOffsetY = this.offsetY;
					}
				})
			},
			// 计算拖动偏移量
			movableChange(e) {
				newOffsetX = e.detail.x
				newOffsetY = e.detail.y
			},
			// 计算缩放比例和偏移量
			movableScale(e) {
				newOffsetX = e.detail.x
				newOffsetY = e.detail.y
				this.scale = e.detail.scale;
			},
			// 截取图片
			createImg() {
				let ctx = uni.createCanvasContext("picture-canvas");
				ctx.drawImage(this.pictureSrc, newOffsetX, newOffsetY, this.img_width /
					this.img_scaling * this.scale,
					this.img_height / this.img_scaling * this.scale);
				ctx.draw(false, () => {
					uni.canvasToTempFilePath({
						// 截取图片尺寸
						destWidth: tailorSize / 2,
						destHeight: tailorSize / 2,
						canvasId: "picture-canvas",
						success: (res) => {
							// console.log(res.tempFilePath)
							// this.onHide();
							this.isShow = false
							this.$emit("uploadF", res.tempFilePath)
						}
					});
				});
			}
		}
	}
</script>

<style>
	.picture-tailor {
		position: fixed;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		width: 100%;
		height: 100%;
		background-color: #000000;
		transform: translateX(100%);
		transition: all 200ms ease;
		visibility: hidden;
	}

	.picture-tailor-show {
		transform: translateY(0) !important;
		visibility: visible;
	}

	/* 拖动域的位置和大小 */
	.picture-tailor .picture-area {
		width: 240px;
		height: 240px;
		position: absolute;
		/* 使其居中定位 */
		top: calc(50% - 120px);
		left: calc(50% - 120px);
	}

	/* 拖动控件的大小 */
	.picture-area .picture-view {
		min-width: 240px;
		min-height: 240px;
	}

	/* 中间选择框的大小，本意是视觉上模拟拖动域 */
	.select-box {
		position: absolute;
		top: calc(50% - 120px);
		left: calc(50% - 120px);
		width: 240px;
		height: 240px;
		box-sizing: border-box;
		/* border-radius: 50%; */
		border: #FFFFFF 1px solid;
		pointer-events: none;
	}

	.button-view {
		position: absolute;
		bottom: 20px;
		right: 20px;
		width: 60px;
		background-color: #007AFF;
		font-size: 14px;
		color: #FFFFFF;
	}

	/* 画布大小，画布大小就是截取的原始大小 */
	.canvas-view {
		width: 240px;
		height: 240px;
		visibility: hidden;
	}
</style>
