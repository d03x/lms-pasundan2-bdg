<script setup lang="ts">
import { cn } from '@/lib/utils';
import { defineEmits, defineProps } from 'vue';

const props = defineProps({
    class: {
        type: String,
        default: '',
    },
    modelValue: {
        type: String,
        default: '',
    },
    id: {
        type: String,
        default: '',
    },
    type: {
        type: String,
        default: 'text',
    },
    placeholder: {
        type: String,
        default: '',
    },
    error: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(['update:modelValue']);

const updateValue = (e: Event) => {
    emit('update:modelValue', (e.target as HTMLInputElement).value);
};
</script>

<template>
    <input
        :id="id"
        :type="type"
        :placeholder="placeholder"
        :value="modelValue"
        @input="updateValue"
        :class="
            cn(
                'w-full rounded border-none px-3 py-2 text-sm text-gray-700 placeholder-gray-400 ring-1 ring-neutral-200 transition-all focus:ring-2 focus:ring-blue-900 focus:outline-none',
                props.class,
                error && 'ring-2 ring-red-500',
            )
        "
    />
</template>
