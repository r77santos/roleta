<template>
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-4 mt-5">
                <img src="public/img/logo-evento.png" alt="Bioma4me - Logo">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h1 class="w-100 text-center py-5 text-primary">
                    Lista de Ganhadores
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4 text-right">
                <button class="btn" name="enviar" v-on:click.prevent="getGanhadores">
                    <span class="text-uppercase font-bebas">Atualizar</span>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="table-responsive">
                    <table class="table text-primary">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Celular</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr scope="row" v-for="ganhador in ganhadores" v-bind:key="ganhador.id">
                                <td class="text-nowrap">{{ ganhador.nome }}</td>
                                <td class="text-nowrap">{{ ganhador.mail }}</td>
                                <td class="text-nowrap">{{ ganhador.celular }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            ganhadores: [],
        }
    },
    created() {
        this.getGanhadores();
    },
    mounted() {
        // this.$nextTick(function() {
        //     window.setInterval(() => {
        //         this.getGanhadores();
        //     }, 5000);
        // });
    },
    methods: {
        getGanhadores() {
            axios.get('http/ganhadores.php').then(({ data }) => {
               this.ganhadores = data;
            });
        }
    }
}
</script>