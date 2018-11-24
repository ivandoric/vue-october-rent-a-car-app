<template>
    <div class="Vehicle rounded overflow-hidden mb-4 border p-4">
        <div class="flex">
            <div class="w-1/3">
                <div class="font-bold text-xl mb-2">{{ name }}</div>
            </div>

            <div class="bg-white w-1/3">
                <img :src="image" alt="Sunset in the mountains">
            </div>

            <div class="w-1/3 text-right">
                <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-lg font-semibold text-grey-darker mr-2">
                    ${{ price }}/day
                </span>
            </div>
        </div>
        <div class="flex justify-between border-t items-center mt-2 pt-4">
            <a href="#">More Details</a>
            <availability-badge :available="available" />
        </div>
    </div>
</template>

<script>
    import AvailabilityBadge from "@/components/AvailabilityBadge"
    export default {
        components: {AvailabilityBadge},
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
            },
            available: {
                type: Number,
                default: 1
            }
        }
    }
</script>