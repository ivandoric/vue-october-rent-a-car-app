<template>
    <div>
        <h2>{{ vehicle.title }}</h2>
        <p>
            Price is: ${{ vehicle.price }}
        </p>
    </div>
</template>

<script>
    export default {
        computed: {
            vehicle() {
                return this.$store.getters.currentVehicle
            }
        },
        mounted() {
            this.$store.dispatch('getVehicle', this.$route.params.slug)
        }
    }
</script>