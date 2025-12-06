<template>
    <div v-if="title || subtitle" class="py-2  mb-3 mt-2 rounded-md">
        <h1
            class="text-lg font-semibold text-neutral-700 leading-tight"
        >
            {{ title }}
        </h1>

        <p
            v-if="subtitle"
            class="text-xs text-neutral-500 mt-0.5"
        >
            {{ subtitle }}
        </p>
    </div>
</template>

<script setup lang="ts">
defineProps<{
    title: string;
    subtitle?: string;
}>();
</script>
