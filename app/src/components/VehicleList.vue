<template>
    <div class="mt-4">
        <vehicle
            v-for="(vehicle, index) in filteredVehicles"
            :key="index"
            :name="vehicle.title"
            :decription="vehicle.description"
            :image="vehicle.image.path"
            :price="vehicle.price"
            :available="vehicle.available"
        />
    </div>
</template>

<script>
import Vehicle from '@/components/Vehicle'
export default {
    components: {
        Vehicle
    },
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