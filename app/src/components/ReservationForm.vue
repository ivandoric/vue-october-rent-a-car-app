<template>
    <div class="ReservationForm p-5 bg-white flex items-end">
        <div class="mr-4">
            <input-select :label="'Pickup Location'" :options="locations" @onSelect="setLocation"/>
        </div>
        <div class="mr-4">
            <label for="">Pickup time</label>
            <datetime type="datetime" input-class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey mt-2" @input="setDate($event, 'pickup')"
                      :min-datetime="now"
            />
        </div>
        <div>
            <label for="">Drop off time</label>
            <datetime type="datetime" input-class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey mt-2" @input="setDate($event, 'dropoff')" :min-datetime="now"/>
        </div>
        <button class="bg-green text-white font-bold py-3 px-4 rounded ml-4" @click="filterVehicles">Filter vehicles</button>
    </div>
</template>

<script>
    import InputSelect from '@/components/forms/InputSelect'
    import VehicleList from "@/components/VehicleList";
    import { Datetime } from 'vue-datetime';

    export default {
        components: {
            VehicleList,
            InputSelect,
            Datetime
        },

        computed: {
            locations() {
                return this.$store.getters.allLocations
            },
            now() {
                const date = new Date(Date.now())
                return date.toISOString()
            }
        },
        methods: {
            filterVehicles() {
                this.$store.dispatch('filterVehicles')
            },
            filterVehiclesOnApi(value) {
                this.$store.dispatch('filterOnApi', +value)
            },
            setLocation(value) {
                this.$store.dispatch('setLocation', +value)
            },
            setDate(value, type) {
                this.$store.dispatch('setDates', {value, type})
            }
        }
    }
</script>
