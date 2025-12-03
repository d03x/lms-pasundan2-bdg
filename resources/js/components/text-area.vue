<script setup lang="ts">
const props = defineProps({
  modelValue: {
    type: String,
    default: ''
  },
  id: {
    type: String,
    default: ''
  },
  placeholder: {
    type: String,
    default: ''
  },
  rows: {
    type: Number,
    default: 4
  },
  error: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['update:modelValue'])

const updateValue = (e: Event) => {
  emit('update:modelValue', (e.target as HTMLTextAreaElement).value)
}
</script>

<template>
  <textarea
    :id="id"
    :rows="rows"
    :placeholder="placeholder"
    :value="modelValue"
    @input="updateValue"
    class="w-full px-5 py-3 bg-[#EAEaea] rounded-2xl text-gray-700 placeholder-gray-400 
           focus:outline-none focus:ring-2 focus:ring-blue-900 border-none transition-all resize-none"
    :class="{ 'ring-2 ring-red-500': error }"
  ></textarea>
</template>
