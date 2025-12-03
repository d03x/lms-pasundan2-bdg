<script setup lang="ts">
import MaterialSymbolsCancelOutline from '@/icons/MaterialSymbolsCancelOutline.vue';
import { VueFinalModal } from 'vue-final-modal';

const props = defineProps<{
    modalID: string;
    title?: string;
    showClose?: boolean; // default nanti di bawah
}>();

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'clickOutside'): void;
}>();
</script>

<template>
    <VueFinalModal
        @click-outside="emit('clickOutside')"
        overlay-transition="vfm-fade"
        content-transition="vfm-slide-down"
        content-class="bg-white max-w-lg  mx-auto mt-12 rounded-md"
        :modal-id="props.modalID"
    >
        <header class="flex items-center justify-between border-b border-neutral-200 px-3 py-3">
            <span class="text-md font-semibold text-neutral-800">
                {{ props.title }}
            </span>
            <button @click="emit('close')" class="cursor-pointer text-neutral-500 hover:text-red-500">
                <MaterialSymbolsCancelOutline />
            </button>
        </header>
        <div class="p-3">
            <slot />
        </div>
    </VueFinalModal>
</template>
