<template>
	<form class="mb-5" @submit.prevent="submit">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1 class="mb-5 w-100 text-center text-primary">
						ROLETA DA SORTE
					</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="retangulo py-5 px-2 px-sm-5">
						<img src="public/img/retangulo.png?ver=2" class="d-none d-md-block">
						<img src="public/img/retangulo-768.png?ver=2" class="d-none d-sm-block d-md-none">
						<img src="public/img/retangulo-450.png?ver=2" class="d-sm-none">
						<div class="px-md-5 py-2">
							<div class="row justify-content-between">
								<div class="col-12 col-md-6 col-xl-5 placeholder mb-4">
									<label for="nome" class="sr-only">Nome: *</label>
									<input autocomplete="off" type="text" id="nome" class="w-100" v-model="content.nome" required>
									<span class="text-primary" v-for="(error, index) in fail.errors.nome" v-bind:key="index">
										{{ error }}
									</span>
								</div>
								<div class="col-12 col-md-6 col-xl-5 placeholder mb-4">
									<label for="email" class="sr-only">E-mail: *</label>
									<input autocomplete="off" type="text" id="email" class="w-100" v-model="content.mail" required>
									<span class="text-primary" v-for="(error, index) in fail.errors.mail" v-bind:key="index">
										{{ error }}
									</span>
								</div>
								<div class="col-12 col-md-6 col-xl-5 placeholder">
									<label for="celular" class="sr-only">Celular: *</label>
									<vue-mask class="w-100" id="celular" v-model.lazy="content.celular" mask="(00) 00000-0000" v-bind:options="options" v-bind:raw="this.options.raw" required />
									<span class="text-primary" v-for="(error, index) in fail.errors.celular" v-bind:key="index">
										{{ error }}
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row mt-5 mb-5">
				<div class="col-12 d-flex justify-content-center">
					<button class="text-primary d-flex justify-content-center align-items-center" type="submit" name="enviar" v-bind:disabled="processing || disabled">
						<span class="spinner-border loading spinner-border-sm mr-2" role="status" aria-hidden="true" v-if="processing"></span>
						<span class="text-uppercase font-bebas">Enviar</span>
					</button>
				</div>
			</div>
		</div>
	</form>
</template>
<script>
	import vueMask from 'vue-jquery-mask';
	export default {
		props: {
			action: String,
			method: String,
		},
		data() {
			return {
				fail: {
					errors: {},
				},
				content: {
					nome: '',
					email: '',
					celular: '',
				},
				processing: false,
				options: {
					raw: false,
					onKeyPress: this.brPhoneOnKeyPress,
				},
			};
		},
		created() {
			
		},
		mounted() {
			$(document).ready(() => {
				$('.placeholder').placeholder();
			});
		},
		components: {
			vueMask,
		},
		computed: {
			params() {
				return {
					...this.content,
				};
			},
			disabled() {
				return false;
				// return !Boolean(this.content.nome.trim()) ||
				// 	   !Boolean(this.content.email.rim()) ||
				// 	   !Boolean(this.content.celular.trim()) ||
				// 	   !Boolean(this.content.telefone.trim());
			}
		},
		methods: {
			reset() {
				this.fail = {
					errors: {},
				};

				this.content = {
					nome: '',
					email: '',
					celular: '',
				};
			},
			error(error) {
				swal({
					icon: 'error',
					text: error.response.data.message,
				}).then(() => {
					this.fail = {...error.response.data};
				});
			},
			success(response) {
				swal({
					icon: 'success',
					text: response.data.message,
				}).then(() => {
					this.$emit('complete', this.content);
					this.reset();
				});
			},
			submit() {
				swal({
					icon: 'info',
					text: 'Confirmar o envio?',
					buttons: [ 'Não, Cancelar', 'Sim, confirmar' ]
				}).then(confirmation => {
					if(confirmation) {
						this.processing = true;
						axios({
							url: this.action,
							data: this.params,
							method: this.method,
						}).then(response => {
							this.success(response);
						}).catch(error => {
							this.error(error);
						}).finally(() => {
							this.processing = false;
						});
					}
				});
			},
            maskBrPhone(value) {
                return value.replace(/\D/g, '').length === 11 ?
                       '(00) 00000-0000' : '(00) 0000-00009';
            },
            brPhoneOnKeyPress(value, element, field, options) {
                field.mask(this.maskBrPhone.apply({}, arguments), options);
            },
		}
	}
</script>
<style lang="scss" scoped>
	@import '../../../sass/includes/vars';
	form{
		.retangulo{
			position: relative;
			img{
				position: absolute;
				z-index: 0;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
			}
			input{
				border: {
					top: none;
					left: none;
					right: none;
					bottom: 1px solid map-get($colors, "white");
				}
				color: map-get($colors, "white");
				background-color: transparent;
				outline: none;
				padding: 4px;
				&::placeholder{
					color: map-get($colors, "white");
					font-size: 20px;
				}
			}
		}
		button{
			font-family: 'ProximaNova-Bold', sans-serif;
			cursor: pointer;
			font-weight: bold;
			font-size: 20px;
			padding: 8px 64px;
			background-color: transparent;
			border: 1px solid map-get($theme-colors, "primary");
			transition: all .3s;
			@media (max-width: 767px){
				width: 100%;
			}
			&:hover{
				background-color: transparent;
			}
			&:disabled{
				cursor: not-allowed;
				background-color: transparent;
			}
		}
	}
</style>