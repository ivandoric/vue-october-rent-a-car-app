<template>
    <div class="container pt-8">
        <div class="rounded overflow-hidden shadow-lg p-8">
            <div class="mb-8">
                <img class="w-full" :src="vehicle.image.path">
            </div>
            <div class="flex">
                <div class="CarDetails w-1/2 p-8">
                    <div class="font-bold text-xl mb-2">{{ vehicle.title }}</div>
                    <p class="text-grey-darker text-base mb-4" v-html="vehicle.description" />


                    <h3 class="mb-4">Available in:</h3>
                    <span
                            class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2"
                            v-for="location in vehicle.locations"
                            :key="location.index"
                    >{{ location.title }}</span>
                </div>

                <div class="CarPrices w-1/2 p-8 border-l">

                    <ul class="mb-4">
                        <li><strong>By Day:</strong> ${{vehicle.price}} </li>
                        <li><strong>Reservation:</strong> {{dates.start}} - {{ dates.end }} </li>
                        <li><strong>Number of days:</strong> {{dates.daysBetween }} </li>
                        <li><strong>Price:</strong> ${{dates.price }} </li>
                    </ul>


                    <router-link
                            class="bg-green text-white font-bold py-3 px-4 rounded ml-4 inline-block"
                            :to="{ name: 'Reservation' }">Continue</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { DateTime } from 'luxon'
    export default {
        computed: {
            vehicle() {
                return this.$store.getters.currentVehicle
            },
            dates() {
                const start = DateTime.fromISO(this.$store.getters.pickupDate)
                const end = DateTime.fromISO(this.$store.getters.dropOffDate)
                const daysBetween = end.diff(start, ['days'])
                const price = this.vehicle.price * daysBetween.values.days
                return {
                    start: start.toFormat('dd/MM/yyyy'),
                    end: end.toFormat('dd/MM/yyyy'),
                    daysBetween: daysBetween.values.days,
                    price
                }
            }
        },
        beforeMount() {
            this.$store.dispatch('getVehicle', this.$route.params.slug)

            if(this.$store.getters.pickupDate === '') {
                this.$store.dispatch('setDates', {value: localStorage.getItem('pickup'), type: 'pickup'})
            }

            if(this.$store.getters.dropOffDate === '') {
                this.$store.dispatch('setDates', {value: localStorage.getItem('dropoff'), type: 'dropoff'})
            }

            console.log(this.dates)
        }
    }
</script>
