<script setup lang="ts">
import { computed } from 'vue'

const props = defineProps({
  type: {
    type: String,
    default: 'button'
  },
  loading: {
    type: Boolean,
    default: false
  },
  disabled: {
    type: Boolean,
    default: false
  },
  full: {
    type: Boolean,
    default: false
  },
  variant: {
    type: String,
    default: 'primary' // primary | secondary | danger dll bisa kamu tambah
  }
})

const classes = computed(() => {
  const base =
    "px-3 py-2.5 cursor-pointer rounded-md font-medium text-sm transition-all focus:outline-none"

  const variants: Record<string, string> = {
    primary: "bg-blue-900 text-white hover:bg-blue-800",
    secondary: "bg-gray-300 text-gray-700 hover:bg-gray-400",
    danger: "bg-red-600 text-white hover:bg-red-500"
  }

  const disabledClass =
    props.disabled || props.loading
      ? "opacity-50 cursor-not-allowed"
      : ""

  const width = props.full ? "w-full" : ""

  return `${base} ${variants[props.variant]} ${disabledClass} ${width}`
})
</script>

<template>
  <button
    :type="type as any"
    :disabled="disabled || loading"
    :class="classes"
  >
    <span v-if="loading">Loading...</span>
    <span v-else><slot /></span>
  </button>
</template>
