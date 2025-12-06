<script setup lang="ts">
import NotFoundVector from '@/icons/NotFoundVector.vue';

</script>

<template>
       <div
            class="flex min-h-[260px] w-full flex-col items-center justify-center rounded-xl border border-neutral-200 bg-white px-4 py-6 text-center"
        >
            <NotFoundVector class="h-32 w-32 opacity-80" />

            <h1 class="mt-3 text-base font-medium text-neutral-700">
                <slot name="title"/>
            </h1>
            
            <p class="mt-1 max-w-[260px] text-xs text-neutral-500">
                <slot name="description"/>
            </p>
        </div>
</template>