<template>
    <img ref="placeholder" :src="`/images/icons/${this.icon}.svg`">
</template>

<script>
    'use strict'

    import SVGInjector from 'svg-injector'

    export default {
        props: {
            icon: String,
        },

        mounted() {
            SVGInjector(this.$refs.placeholder)
        }
    }
</script>
