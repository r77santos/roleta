<template>
    <div class="value">
        <img v-bind:src="source" v-bind:alt="alt">
    </div>
</template>
<script>
    export default {
        name: "item",
        props: {
            alt: {
                default: '',
                type: String,
            },
            source: {
                type: String,
                required: true,
            }
        }
    }
</script>
<style lang="scss" scoped>
    .value{
        img{
            animation: styleopacity .5s linear;
        }
        @keyframes styleopacity{
            0%{
                opacity: 0;
            }
            100%{
                opacity: 1;
            }
        }
    }
</style>