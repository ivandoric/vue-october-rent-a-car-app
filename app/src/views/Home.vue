<template>
    <div class="home">
        <custom-button dark/>
        <custom-button/>
    </div>
</template>

<script>
import axios from 'axios'
import CustomButton from '@/components/Button'

export default {
    name: 'Home',
    components: {
        CustomButton
    },
    mounted() {
        axios.get('http://api.vue-rentacar.localhost/vehicles').then(response => {
            console.log(response.data)
        })
    }
}
</script>
