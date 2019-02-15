<template>
    <nav class="bg-grey-darkest">
        <div class="container flex items-center justify-between flex-wrap p-6">
            <div class="flex items-center flex-no-shrink text-white mr-6">
                <span class="font-bold text-3xl tracking-tight">Trotter</span>
            </div>
            <div class="block lg:hidden">
                <button class="flex items-center px-3 py-2 border rounded text-teal-lighter border-teal-light hover:text-white hover:border-white">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                    </svg>
                </button>
            </div>
            <div class="ml-auto">
                <div class="text-lg lg:flex-grow">
                    <router-link to="/" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-white mr-4 text-pink no-underline">Home</router-link>
                    <router-link to="/about" class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-white mr-4 text-pink no-underline">About</router-link>
                    <button class="block mt-4 lg:inline-block lg:mt-0 text-teal-lighter hover:text-white mr-4 text-pink no-underline" @click="logout">Logout</button>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        methods: {
            logout() {
                this.$store.dispatch('logout')
            }
        }
    }
</script>
