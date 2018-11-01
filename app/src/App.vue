<template>
    <div id="app">
        <nav-bar/>
        <router-view/>
    </div>
</template>

<script>
    import NavBar from '@/components/NavBar'

    export default {
        components: {
            NavBar
        },

        mounted() {
            this.$store.dispatch('getLocations')
        }
    }
</script>
