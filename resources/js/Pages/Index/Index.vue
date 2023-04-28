<template>
  <div>Index</div>
  <Link href="/hello">Index Page</Link>
  <div>
    The message is {{ message }}
  </div>
</template>

<script setup>

import { Link } from '@inertiajs/vue3'
defineProps( {
  listing: Object,
})

</script>

<style scoped>

</style>
