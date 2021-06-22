<template>
    <div id="contain">
        <div v-if="showNiquel">
            <vue-roleta v-on:winner="winner" v-on:loser="loser" />
        </div>
        <div v-else>
            <vue-header />
            <vue-form method="POST" action="http/satisfaction.php" v-on:complete="completed" />
        </div>
    </div>
</template>
<script>
    import VueHeader from '../@common/Header';
    import VueRoleta from '../roleta';
    import VueForm from './Form';
    export default {
        components: {
            VueHeader,
            VueRoleta,
            VueForm,
        },
        data() {
            return {
                content: {},
                showNiquel: false,
            };
        },
        methods: {
            completed(content) {
                this.content = content;
                this.showNiquel = true;
            },
            loser(value) {
                this.showNiquel = false;
            },
            winner(value) {
                this.submit();
                this.showNiquel = false;
            },
            submit() {
                axios.post('http/winner.php', this.content)
                     .then(response => response.data)
                     .then(response => {
                         console.log(response);
                     }).catch(error => {
                         console.log(error);
                     });
            }
        }
    }
</script>

<style>
    div#contain {
        background-color: #0049a9;
    }
</style>