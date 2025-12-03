<script setup lang="ts">
import { defineEmits, defineProps } from 'vue';

const props = defineProps({
    
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
        class="w-full rounded-lg border-none bg-[#EAEaea] px-3 text-sm py-2 text-gray-700 placeholder-gray-400 transition-all focus:ring-2 focus:ring-blue-900 focus:outline-none"
        :class="{ 'ring-2 ring-red-500': error }"
    />
</template>
