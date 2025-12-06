<script setup lang="ts">
import KelasCard from '@/components/kelas-card.vue';
import { Kelas } from '@/types';
defineProps<{
    kelas: Kelas[];
}>();
</script>

<template>
    <div v-if="kelas.length > 0">
        <div class="grid grid-cols-5 gap-3">
            <component v-for="item in kelas">
                <KelasCard :nama_kelas="item.nama_kelas" :jumlah_siswa="item.jumlah_siswa">
                    <slot name="link" :item="item" />
                </KelasCard>
            </component>
        </div>
    </div>
    <div v-else>Anda tidak ada mengajar di kelasmanapun</div>
</template>
