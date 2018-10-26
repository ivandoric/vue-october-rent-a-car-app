<template>
    <div class="home">
        <custom-button dark/>
        <custom-button/>
        <vehicle-list />
    </div>
</template>

<script>
import CustomButton from '@/components/Button'
import VehicleList from '@/components/VehicleList'

export default {
    name: 'Home',
    components: {
        CustomButton,
        VehicleList
    }
}
</script>
