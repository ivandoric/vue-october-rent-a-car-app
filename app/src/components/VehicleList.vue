<template>
    <div>
        <h2>Vehicle list</h2>

        <ul v-for="(vehicle, index) in vehicles" :key="index">
            <li>
                {{ vehicle.title }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    computed: {
        vehicles() {
            return this.$store.getters.allVehicles
        }
    },
    mounted() {
        this.$store.dispatch('getVehicles')
    }
}
</script>