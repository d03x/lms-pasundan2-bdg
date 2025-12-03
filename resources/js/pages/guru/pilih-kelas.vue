<script setup lang="ts">
import ClarityUsersSolidBadged from '@/icons/ClarityUsersSolidBadged.vue';
import PageTitle from '@/layouts/page-title.vue';
import { materi } from '@/routes/guru';
import { Link } from '@inertiajs/vue3';
import { AnimatePresence, motion } from 'motion-v';
</script>

<template>
    <PageTitle title="Materi" subtitle="List materi silahkan pilih perkelas" />
    <div v-if="$page.props.kelas.length > 0">
        <div class="grid grid-cols-5 gap-3">
            <AnimatePresence>
                <motion.button
                    :whileHover="{
                        scale: 1,
                    }"
                    :whilePress="{ scale: 0.98 }"
                    v-for="item in $page.props.kelas"
                    class="cursor-pointer rounded bg-white p-5 text-left shadow transition-all hover:ring-1 hover:ring-neutral-400"
                >
                    <h1 class="text-base font-semibold">{{ item.nama_kelas }}</h1>
                    <div class="mt-2 flex items-center space-x-1 text-xs text-gray-700 hover:text-red-500">
                        <span><ClarityUsersSolidBadged /> </span>
                        <span>{{ item.jumlah_siswa }} Siswa</span>
                    </div>
                    <Link
                        :href="
                            materi({
                                kelas_kode: item.id_kelas,
                            })
                        "
                        class="mt-3 block rounded-lg bg-orange-500 p-2 text-center text-xs font-semibold text-white shadow"
                        >Pilih Kelas</Link
                    >
                </motion.button>
            </AnimatePresence>
        </div>
    </div>
    <div v-else>
        Anda tidak ada mengajar di kelasmanapun
    </div>
</template>
