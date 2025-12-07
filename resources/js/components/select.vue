<script setup lang="ts">
import VueSelect from 'vue-select';
import { cn } from '@/lib/utils';
import 'vue-select/dist/vue-select.css';
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    modelValue: {
        type: [String, Number, Array, Object, null],
        default: null,
    },
    options: {
        type: Array,
        default: () => [],
    },
    label: {
        type: String,
        default: null,
    },
    reduce: {
        type: Function,
        default: null,
    },
    multiple: {
        type: Boolean,
        default: false,
    },
    placeholder: {
        type: String,
        default: '',
    },
    class: {
        type: String,
        default: '',
    },
    error: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(['update:modelValue']);
</script>

<template>
    <VueSelect
        :options="options"
        :label="label"
        :reduce="reduce"
        :multiple="multiple"
        :placeholder="placeholder"
        :modelValue="modelValue"
        @update:modelValue="emit('update:modelValue', $event)"
        :class="
            cn(
                'custom-vselect w-full text-sm',
                props.class,
            )
        "
    />
</template>

<style scoped>
/* Base wrapper */
.custom-vselect .vs__dropdown-toggle {
    border: none !important;
    border-radius: 0.5rem; /* 8px */
    padding: 6px 10px !important;
    background: white !important;
    ring: 1px solid #e5e7eb !important;
    min-height: 38px;
    transition: all 0.2s;
    box-shadow: none;
    font-size: 0.875rem;
    color: #374151;
}

/* Ring neutral */
.custom-vselect .vs__dropdown-toggle {
    border: none !important;
    box-shadow: 0 0 0 1px #e5e7eb;
}

/* Focus ring biru */
.custom-vselect .vs__dropdown-toggle:focus,
.custom-vselect .vs__dropdown-toggle.vs__dropdown-toggle--focused {
    box-shadow: 0 0 0 2px #1e3a8a !important;
}

/* Placeholder */
.custom-vselect .vs__placeholder {
    color: #9ca3af !important;
    font-size: 0.875rem;
}

/* Selected text */
.custom-vselect .vs__selected {
    font-size: 0.875rem;
    color: #374151;
}

/* Clear + Dropdown arrow */
.custom-vselect .vs__actions svg {
    fill: #6b7280;
}

/* Dropdown menu */
.custom-vselect .vs__dropdown-menu {
    border-radius: 0.5rem;
    border: 1px solid #e5e7eb;
    box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
    font-size: 0.875rem;
}

/* Option */
.custom-vselect .vs__dropdown-option {
    padding: 6px 10px;
}

.custom-vselect .vs__dropdown-option--selected {
    background: #e0f2fe !important;
    color: #1e3a8a !important;
}

.custom-vselect .vs__dropdown-option--highlight {
    background: #bfdbfe !important;
}
</style>
