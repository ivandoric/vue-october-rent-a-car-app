<template>
    <div class="home"/>
</template>

<script>
import axios from 'axios'

export default {
    name: 'Home',
    mounted() {
        axios.get('http://api.vue-rentacar.localhost/vehicles').then(response => {
            console.log(response.data)
        })
    }
}
</script>
