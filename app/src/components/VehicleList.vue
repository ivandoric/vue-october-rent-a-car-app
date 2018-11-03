<template>
    <div>
        <ul v-for="(vehicle, index) in vehicles" :key="index" v-if="!filtered">
            <li>
                {{ vehicle.title }}
            </li>
        </ul>
        <ul v-for="(vehicle, index) in filteredVehicles" :key="index" v-if="filtered">
            <li>
                {{ vehicle.title }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        filtered: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        vehicles() {
            return this.$store.getters.allVehicles
        },
        filteredVehicles() {
            return this.$store.getters.filterdVehicles
        }
    }
}
</script>