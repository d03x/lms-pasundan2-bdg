<template>
      <div v-if="title || subtitle" class="py-4">
        <h1 class="text-xl font-bold text-neutral-700">{{ title }}</h1>
        <p v-if="title" class="text-sm">
            {{ subtitle }}
        </p>
    </div>
</template>
<script setup lang="ts">
defineProps<{
    title:string,
    subtitle?:string,
}>()
</script>