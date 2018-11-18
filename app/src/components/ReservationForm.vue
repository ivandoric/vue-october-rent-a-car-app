<template>
    <div class="ReservationForm p-5 bg-white w-1/2">
        <input-select :label="'Pickup Location'" :options="locations" @onSelect="filterVehicles"/>
    </div>
</template>

<script>
    import InputSelect from '@/components/forms/InputSelect'
    import VehicleList from "@/components/VehicleList";

    export default {
        components: {
            VehicleList,
            InputSelect
        },

        computed: {
            locations() {
                return this.$store.getters.allLocations
            }
        },
        methods: {
            filterVehicles(value) {
                this.$store.dispatch('filterVehicles', +value)
            },
            filterVehiclesOnApi(value) {
                this.$store.dispatch('filterOnApi', +value)
            }
        }
    }
</script>
