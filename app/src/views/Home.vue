<template>
    <div class="home">
        <div class="HeroBlock bg-grey h-screen">
            <div class="container flex justify-center items-center h-screen">
                <reservation-form/>
            </div>
        </div>
    </div>
</template>

<script>
import CustomButton from '@/components/Button'
import VehicleList from '@/components/VehicleList'
import ReservationForm from '@/components/ReservationForm'

export default {
    name: 'Home',
    components: {
        CustomButton,
        VehicleList,
        ReservationForm
    }
}
</script>
