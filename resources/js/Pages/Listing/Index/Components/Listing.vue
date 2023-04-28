<template>
  <Box>
    <div>
      <Link :href="route('listings.show', listing.id)">
        <div class="flex items-center gap-1">
          <Price :price="listing.price" class="text-2xl font-bold" />
          <div class="text-xs text-gray-500">
            <Price :price="monthlyPayment" />pm
          </div>
        </div>
        <ListingSpace :listing="listing" class="text-lg" />
        <ListingAddress :listing="listing" class="text-gray-500" />
      </Link>
    </div>
  </Box>
</template>

<script setup>

import Price from '@/Components/Price.vue'
import ListingAddress from '@/Components/ListingAddress.vue'
import Box from '@/Components/UI/Box.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import { Link } from '@inertiajs/vue3'
import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'


const  props = defineProps({
  listing: Object,
})

const { monthlyPayment } = useMonthlyPayment(props.listing.price, 2.5, 25)


</script>

<style scoped>

</style>
