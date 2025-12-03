<template>
   <div class="flex  h-8 w-8 items-center justify-center rounded-full bg-neutral-800 cursor-pointer  text-xs ring-2  ring-neutral-400 font-semibold text-neutral-100">
      <div v-if="!avatar_uri && fallback">
        {{ fallback.charAt(0) }}
      </div>
   </div>
</template>
<script setup lang="ts">
defineProps<{
    avatar_uri? : string,
    fallback?:string,
}>()
</script>