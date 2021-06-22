<template>
    <section id="zebra">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center py-4">
                    <img src="public/img/logo-evento.png" alt="" class="img-fluid">
                    <h1 class="sr-only">Zebra máquina de sorteio</h1>
                </div>
                <div class="col-12">
                    <div id="box" class="d-flex flex-wrap justify-content-between">
                        <div class="item d-flex align-items-center justify-content-center">
                            <item v-bind:source="one" alt="sao-paulo"/>
                        </div>
                        <div class="item d-flex align-items-center justify-content-center">
                            <div class="value">
                                <item v-bind:source="two" alt="sao-paulo"/>
                            </div>
                        </div>
                        <div class="item d-flex align-items-center justify-content-center">
                            <div class="value">
                                <item v-bind:source="three" alt="sao-paulo"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 py-3 d-flex align-items-center justify-content-center">
                    <button class="text-uppercase d-block" id="jogar" v-on:click.prevent="start" v-bind:disabled="buttonBlock">
                        Jogar
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import Item from './Item';
export default {
    name: 'roleta',
    components: {
        Item,
    },
    mounted() {
        swal({
            icon: 'info',
            button: 'Ok, entendi',
            title: `Hora de testar a sua sorte!`,
            text: 'Clique no botão jogar e concorra a prêmios',
        });
        axios({
            url: 'http/getOrderNumber.php',
            method: 'GET',
        }).then(response => response.data)
          .then(response => {
              this.orderNumber = response.orderNumber
          }).catch(error => {
              this.orderNumber = 0
          })
    },
    data() {
        return {
            orderNumber: 0,
            divider: 30,
            tryIt: 0,
            buttonBlock: false,
            indexes: {
                one: 0,
                two: 0,
                three: 0,
            },
            images: [
                'public/img/01.png',
                'public/img/02.png',
                'public/img/03.png',
                'public/img/04.png',
            ]
        }
    },
    methods: {
        async run(max, time) {
            let $this = this;
            this.buttonBlock = true;
            return await new Promise(function(resolve, reject) {
                for(let i = 0; i < max; i++) {
                    setTimeout(() => {
                        $this.indexes.one = $this.sorted(0, $this.images.length - 1);
                        $this.indexes.two = $this.sorted(0, $this.images.length - 1);
                        $this.indexes.three = $this.sorted(0, $this.images.length - 1);
                        if(max == (i+1)) {
                            resolve();
                        }
                    }, i * time);
                }
            });
        },
        start() {
            this.run(50, 100).then(() => {
                if( this.orderNumber % 10 == 0 ) {
                    this.indexes.one = 3
                    this.indexes.two = 3
                    this.indexes.three = 3
                    swal({
                        icon: 'success',
                        text: 'Você ganhou um prêmio!'
                    }).then(() => {
                        this.$emit('winner', true);
                    });
                } else {
                    swal({
                        icon: 'error',
                        text: 'Que pena você não ganhou'
                    }).then(() => {
                        this.$emit('loser', false);
                    });
                }
            }).then(() => {
                this.buttonBlock = false;
            })
        },
        sorted(min, max) {
            return Math.floor(Math.random() * ((max + 1) - min)) + min;
        }
    },
    computed: {
        one() {
            return this.images[this.indexes.one];
        },
        two() {
            return this.images[this.indexes.two];
        },
        three() {
            return this.images[this.indexes.three];
        }
    },
}
</script>
<style lang="scss">
    section#zebra{
        min-height: 100vh;
        background-size: 100% 100%;
        background-repeat: no-repeat;
        #box{
            background-size: 100% 100%;
            background-repeat: no-repeat;
            padding: 32px;
            .item{
                background-size: 100% 100%;
                background-repeat: no-repeat;
                height: 350px;
                width: 30%;
                @media (max-width: 767px) {
                    width: 100%;
                    height: 200px;
                    &:not(:first-child){
                        margin-top: 16px;
                    }
                }
                .value{
                    width: 200px;
                    height: 200px;
                    position: relative;
                    @media (max-width: 991px) {
                        width: 150px;
                        height: 150px;
                    }
                    img{
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        max-width: 95%;
                        max-height: 95%;
                        object-fit: contain;
                    }
                }
            }
        }
        button{
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: none;
            background-color: #ff0000;
            color: #fff;
            font-weight: bold;
            box-shadow: 0 2px #999;
            outline: none;
            transition: background-color .3s;
            position: relative;
            z-index: 2;
            &:hover{
                background-color: lighten(#ff0000, 10%)
            }
            &:active{
                transform: translateY(4px);
                box-shadow: 0 0px #666;
            }
        }
    }
</style>