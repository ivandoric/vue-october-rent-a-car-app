<template>
    <div class="max-w-sm rounded overflow-hidden shadow-lg mb-4">
        <img class="w-full" :src="image" alt="Sunset in the mountains">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ name }}</div>
            <p class="text-grey-darker text-base" v-html="description" />
        </div>
        <div class="px-6 py-4">
            <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">
                ${{ price }}/day
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            name: {
                type: String,
                required: true
            },
            description: {
                type: String,
                default: ''
            },
            image: {
                type: String,
                default: null
            },
            price: {
                type: Number,
                default: null
            }
        }
    }
</script>