<template>
    <section id="question" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5">
                    <h2 class="text-uppercase text-center text-secondary">Sua opinião é importante para que possamos continuar a atender suas expectativas.</h2>
                </div>
                <div class="col-12 mb-5">
                    <p class="mb-2 question">Você considerou o conteúdo apresentado importante para o desenvolvimento de seu negócio?</p>
                    <div class="d-flex align-items-center mb-1">
                        <input type="radio" name="question_01" id="question_01_sim" value="Sim" v-model="value.question_1">
                        <label for="question_01_sim" class="text-uppercase ml-2">Sim</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="radio" name="question_01" id="question_01_nao" value="Não" v-model="value.question_1">
                        <label for="question_01_nao" class="text-uppercase ml-2">Não</label>
                    </div>
                    <span class="text-danger" v-for="(error, index) in fail.errors.question_1" v-bind:key="index">
                        {{ error }}
                    </span>
                </div>
                <div class="col-12 mb-5">
                    <p class="mb-2 question">A duração do evento foi:</p>
                    <div class="d-flex align-items-center mb-1">
                        <input type="radio" name="question_02" id="question_02_longa" value="Longa" v-model="value.question_2">
                        <label for="question_02_longa" class="text-uppercase ml-2">Longa</label>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <input type="radio" name="question_02" id="question_02_ideal" value="Ideal" v-model="value.question_2">
                        <label for="question_02_ideal" class="text-uppercase ml-2">Ideal</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="radio" name="question_02" id="question_02_curta" value="Curta" v-model="value.question_2">
                        <label for="question_02_curta" class="text-uppercase ml-2">Curta</label>
                    </div>
                    <span class="text-danger" v-for="(error, index) in fail.errors.question_2" v-bind:key="index">
                        {{ error }}
                    </span>
                </div>
                <div class="col-12 mb-5">
                    <p class="mb-2 question">O assunto abordado foi:</p>
                    <div class="d-flex align-items-center mb-1">
                        <input type="radio" name="question_03" id="question_03_muito-interessante" value="Muito interessante" v-model="value.question_3">
                        <label for="question_03_muito-interessante" class="text-uppercase ml-2">Muito interessante</label>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <input type="radio" name="question_03" id="question_03_relevante" value="Relevante" v-model="value.question_3">
                        <label for="question_03_relevante" class="text-uppercase ml-2">Relevante</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="radio" name="question_03" id="question_03_fora-do-contexto" value="Fora do contexto" v-model="value.question_3">
                        <label for="question_03_fora-do-contexto" class="text-uppercase ml-2">Fora do contexto</label>
                    </div>
                    <span class="text-danger" v-for="(error, index) in fail.errors.question_3" v-bind:key="index">
                        {{ error }}
                    </span>
                </div>
                <div class="col-12 mb-5">
                    <p class="mb-2 question">Com qual frequência gostaria de ter eventos como esse?</p>
                    <div class="d-flex align-items-center mb-1">
                        <input type="radio" name="question_04" id="question_04_a-cada-3-meses" value="A cada 3 meses" v-model="value.question_4">
                        <label for="question_04_a-cada-3-meses" class="text-uppercase ml-2">A cada 3 meses</label>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <input type="radio" name="question_04" id="question_04_a-cada-6-meses" value="A cada 6 meses" v-model="value.question_4">
                        <label for="question_04_a-cada-6-meses" class="text-uppercase ml-2">A cada 6 meses</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="radio" name="question_04" id="question_04_1-vez-por-ano" value="1 vez por ano" v-model="value.question_4">
                        <label for="question_04_1-vez-por-ano" class="text-uppercase ml-2">1 Vez por ano</label>
                    </div>
                    <span class="text-danger" v-for="(error, index) in fail.errors.question_4" v-bind:key="index">
                        {{ error }}
                    </span>
                </div>
                <div class="col-12 mb-5">
                    <p class="mb-2 question">Existe alguma demanda ou oportunidade próxima de negócio (troca de parque, upgrade de base, etc)?</p>
                    <div class="d-flex align-items-center mb-1">
                        <input type="radio" name="question_05" id="question_05_sim" value="Sim" v-model="value.question_5">
                        <label for="question_05_sim" class="text-uppercase ml-2 mr-3">Sim</label>
                        <input type="text" name="question_05_other" id="question_05_other" v-model="value.question_5_other" placeholder="Qual?" v-if="(value.question_5 == 'Sim')">
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="radio" name="question_05" id="question_05_nao" value="Não" v-model="value.question_5">
                        <label for="question_05_nao" class="text-uppercase ml-2">Não</label>
                    </div>
                    <span class="text-danger" v-for="(error, index) in fail.errors.question_5" v-bind:key="index">
                        {{ error }}
                    </span>
                </div>
                <div class="col-12">
                    <label class="mb-3" for="question_06">
                        <p class="question">Que assuntos gostaria que fossem abordados em um próximo encontro?</p>
                    </label>
                    <textarea id="question_06" class="d-block w-100" v-model="value.question_6"></textarea>
                    <span class="text-danger" v-for="(error, index) in fail.errors.question_6" v-bind:key="index">
                        {{ error }}
                    </span>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    props: {
        value: {
            type: Object,
            required: true,
        },
        fail: {
            type: Object,
            required: true,
        }
    },
    created() {
        
    }
}
</script>
<style lang="scss" scoped>
    @import '../../../sass/includes/vars';
    h2{
        font-size: 2.5em;
        line-height: 1;
        @media (max-width: 1199px){
            font-size: 2em;
        }
        @media (max-width: 767px){
            font-size: 1.5em;
        }
    }
    .question{
        font-family: 'ProximaNova-Bold', sans-serif;
        font-size: 1.3em;
        line-height: 1.2;
        @media (max-width: 575px){
            font-size: 1.2em;
        }
    }
    input{
        position: relative;
        &::before{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 13px;
            height: 13px;
            border: 1px solid map-get($theme-colors, "secondary");
            border-radius: 50%;
            background-color: map-get($colors, "white");
            z-index: 1;
        }
        &::after{
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0px;
            height: 0px;
            transform: translate(-50%, -50%);
            z-index: 2;
            border-radius: 50%;
            background-color: map-get($theme-colors, "secondary");
            transition: all .3s;
        }
        &:checked{
            &::after{
                width: 13px;
                height: 13px;
            }
        }
    }
    textarea{
        height: 200px;
        resize: none;
        outline: none;
        border: 1px solid map-get($theme-colors, "dark");
        padding: 8px;
        &:focus{
            box-shadow: 0 0 5px rgba(map-get($theme-colors, "dark"), 1);
        }
    }
</style>