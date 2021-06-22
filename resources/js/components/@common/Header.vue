<template>
	<header id="banne">
		<div class="row py-5">
			<div class="col-12 d-flex justify-content-center">
				<img class="img-fluid" src="public/img/logo-evento.png" alt="">
			</div>
		</div>
	</header>
</template>
<script>
</script>
<style lang="scss" scoped>
	@import '../../../sass/includes/vars';
	header{
		background-color: map-get($theme-colors, "secondary");
		position: relative;
		overflow: hidden;
		img{
			&.bg{
				position: absolute;
				left: 15px;
				top: -80px;
				min-width: 66vw;
				min-height: 545px;
				@media (max-width: 1199px){
					min-width: 58vw;
				}
				@media (max-width: 991px){
					min-width: 50vw;
				}
			}
			&.triangle{
				position: absolute;
				bottom: 0;
				right: -20px;
				max-width: 45vw;
			}
		}
		h1{
			line-height: 1;
			font-size: 3em;
			@media (max-width: 575px){
				font-size: 2.8em;
			}
		}
	}
</style>