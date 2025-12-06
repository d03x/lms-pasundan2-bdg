<script setup lang="ts">
import KelasItems from '@/components/pilih-kelas.vue';
import PageTitle from '@/layouts/page-title.vue';
import { materi } from '@/routes/guru';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <PageTitle title="Materi" subtitle="List materi silahkan pilih perkelas" />
    <KelasItems :kelas="$page.props.kelas">
        <template #link="slotProps">
            <Link
                :href="materi({ kelas_kode: slotProps.item.id_kelas })"
                class="mt-3 block rounded-lg bg-orange-500 p-2 text-center text-xs font-semibold text-white shadow"
            >
                Pilih Kelas
            </Link>
        </template>
    </KelasItems>
</template>
