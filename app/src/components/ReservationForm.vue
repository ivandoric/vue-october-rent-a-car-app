<template>
    <div class="ReservationForm p-5 bg-white w-1/2">
        <input-select :label="'Pickup Location'" :options="locations"/>
    </div>
</template>

<script>
    import InputSelect from '@/components/forms/InputSelect'

    export default {
        components: {
            InputSelect
        },

        computed: {
            locations() {
                return this.$store.getters.allLocations
            }
        }
    }
</script>
