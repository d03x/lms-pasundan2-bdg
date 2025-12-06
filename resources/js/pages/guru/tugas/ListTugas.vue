<script setup lang="ts">
import Button from '@/components/button.vue';
import HugeiconsTaskDaily01 from '@/icons/HugeiconsTaskDaily01.vue';
import MaterialSymbolsCheckCircleUnreadOutline from '@/icons/MaterialSymbolsCheckCircleUnreadOutline.vue';
import NotFoundVector from '@/icons/NotFoundVector.vue';
import PageTitle from '@/layouts/page-title.vue';
import { usePage } from '@inertiajs/vue3';
import dayjs from 'dayjs';

interface Tugas {
    tugasID: string;
    title: string;
    deadline: string;
    nama_matpel: string;
}

const page = usePage();
const tugas = page.props.tugas as Tugas[];

const formatTanggal = (date: string) => {
    return dayjs(date).format('DD MMM YYYY HH:mm');
};
</script>

<template>
    <PageTitle
        :title="'Tugas ' + $page.props.info_kelas.nama"
        :subtitle="`List tugas untuk kelas ${$page.props.info_kelas.nama}. Silakan pilih per matpel.`"
    />

    <div class="mt-5 space-y-3">
        <div
            v-if="tugas.length > 0"
            v-for="i in tugas"
            :key="i.tugasID"
            class="group rounded-xl border border-neutral-200 bg-white p-4 shadow-sm transition-all hover:shadow-md sm:p-5"
        >
            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:gap-4">
                <!-- ICON -->
                <div class="w-fit rounded-lg bg-neutral-100 p-2 text-neutral-700 transition-colors group-hover:bg-neutral-200">
                    <HugeiconsTaskDaily01 class="text-2xl sm:text-3xl" />
                </div>

                <!-- CONTENT -->
                <div class="flex-1">
                    <h1 class="text-sm leading-snug font-semibold text-neutral-800 sm:text-base">
                        {{ i.title }}
                    </h1>

                    <h2 class="mt-0.5 text-[11px] text-neutral-500 sm:text-xs">Mata Pelajaran: {{ i.nama_matpel }}</h2>

                    <div class="mt-2 flex items-center gap-2">
                        <MaterialSymbolsCheckCircleUnreadOutline class="text-sm text-green-600" />
                        <span class="text-xs text-neutral-700">50% Mengumpulkan</span>
                    </div>

                    <div class="mt-1 text-[11px] text-neutral-500 sm:text-xs">
                        Deadline:
                        <span class="font-medium">{{ formatTanggal(i.deadline) }}</span>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="mt-3 sm:mt-0 sm:ml-auto">
                    <Button class="w-full px-3 py-1.5 text-xs sm:w-auto"> Periksa </Button>
                </div>
            </div>
        </div>
        <div
            v-else
            class="flex min-h-[260px] w-full flex-col items-center justify-center rounded-xl border border-neutral-200 bg-white px-4 py-6 text-center"
        >
            <NotFoundVector class="h-32 w-32 opacity-80" />

            <h1 class="mt-3 text-base font-medium text-neutral-700">Whoops! Belum Ada Tugas Saat Ini</h1>

            <p class="mt-1 max-w-[260px] text-xs text-neutral-500">Tugas akan muncul di sini jika guru sudah memberikan instruksi baru.</p>
        </div>
    </div>
</template>
