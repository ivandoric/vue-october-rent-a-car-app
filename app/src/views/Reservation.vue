<template>
    <div class="container pt-8" >
        <div class="rounded overflow-hidden shadow-lg p-8">
            <div>
                <h2 class="mb-8">Reservation</h2>

                <form class="w-full max-w-md" @submit.prevent="saveUser">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="firstname">
                                First name
                            </label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="firstname" type="text" name="name" v-model="name">
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="lastname">
                                Surname
                            </label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="lastname" type="text" name="surname" v-model="surname">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="email">
                                Email
                            </label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="email" name="email" type="email" v-model="email">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="password">
                                Password
                            </label>
                            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="password" type="password" name="password" v-model="password">
                        </div>
                    </div>

                    <button class="bg-green text-white font-bold py-3 px-4 rounded ml-4 inline-block"> Register </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                surname: '',
                password: '',
                email: ''
            }
        },
        methods: {
            saveUser() {
                const user = new URLSearchParams()
                user.append('name', this.name)
                user.append('surname', this.surname)
                user.append('email', this.email)
                user.append('password', this.password)

                this.$store.dispatch('saveUser', user)
            }
        }
    }
</script>
