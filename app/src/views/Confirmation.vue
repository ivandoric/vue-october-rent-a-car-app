<template>
    <div class="container pt-8" >
        <div class="rounded overflow-hidden shadow-lg p-8">
            <h2 class="mb-0">Is this information correct</h2>
            <ul class="my-8">
                <li>Name: <strong>{{ user.name }}</strong></li>
                <li>Surname: <strong>{{ user.surname }}</strong></li>
                <li>Vehicle: <strong>{{ vehicle.title }}</strong></li>
                <li>Pickup: <strong>{{ pickup.formatted }}</strong></li>
                <li>Drop Off: <strong>{{ dropoff.formatted }}</strong></li>
            </ul>
        </div>
    </div>
</template>

<script>
    import {DateTime} from 'luxon'

    export default {
        computed: {
            user() {
                return this.$store.getters.user
            },
            vehicle() {
                return this.$store.getters.currentVehicle
            },
            pickup() {
                return {
                    original: this.$store.getters.pickupDate,
                    formatted: DateTime.fromISO(this.$store.getters.pickupDate).toFormat('dd/MM/yyyy')
                }
            },
            dropoff() {
                return {
                    original: this.$store.getters.dropOffDate,
                    formatted: DateTime.fromISO(this.$store.getters.dropOffDate).toFormat('dd/MM/yyyy')
                }
            }
        }
    }
</script>
