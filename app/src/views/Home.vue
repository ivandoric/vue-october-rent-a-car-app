<template>
    <div class="home">
        <div class="HeroBlock bg-grey">
            <div class="container flex justify-center items-center h-64">
                <reservation-form/>
            </div>
        </div>
        <div class="container">
            <vehicle-list />
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
