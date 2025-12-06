<script setup lang="ts">
import ClarityUsersSolidBadged from '@/icons/ClarityUsersSolidBadged.vue';
import { Link } from '@inertiajs/vue3';
import { AnimatePresence, motion } from 'motion-v';
export type Method = 'get' | 'post' | 'put' | 'patch' | 'delete';
defineProps<{
    nama_kelas : undefined|string,
    jumlah_siswa?:number}>();
</script>

<template>
    <AnimatePresence>
        <motion.button
            :whileHover="{
                scale: 1,
            }"
            :whilePress="{ scale: 0.98 }"
            class="cursor-pointer w-full rounded bg-white p-5 text-left shadow transition-all hover:ring-1 hover:ring-neutral-400"
        >
            <h1 class="text-base font-semibold">{{ nama_kelas }}</h1>
            <div class="mt-2 flex items-center space-x-1 text-xs text-gray-700 hover:text-red-500">
                <span><ClarityUsersSolidBadged /> </span>
                <span>{{ jumlah_siswa }} Siswa</span>
            </div>
            <slot/>
        </motion.button>
    </AnimatePresence>
</template>
