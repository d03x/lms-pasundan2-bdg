<script setup lang="ts">
import PageTitle from "@/layouts/page-title.vue";
import { usePage } from "@inertiajs/vue3";
import dayjs from "dayjs";

interface Tugas {
    tugasID: string;
    title: string;
    deadline: string;
    nama_matpel: string;
}

const page = usePage();
const tugas = page.props.tugas as Tugas[];

const formatTanggal = (date: string) => {
    return dayjs(date).format("DD MMM YYYY HH:mm");
};
</script>

<template>
    <PageTitle
        title="Tugas"
        subtitle="List tugas silahkan pilih perkelas"
    />

    <div class="mt-6 overflow-x-auto">
        <table class="min-w-full bg-white text-xs border border-neutral-200 rounded-xl shadow-sm">
            <thead>
                <tr class="bg-neutral-100/80 text-neutral-700">
                    <th class="px-4 py-3 text-left font-semibold border-b border-neutral-200">No</th>
                    <th class="px-4 py-3 text-left font-semibold border-b border-neutral-200">Judul</th>
                    <th class="px-4 py-3 text-left font-semibold border-b border-neutral-200">Mata Pelajaran</th>
                    <th class="px-4 py-3 text-left font-semibold border-b border-neutral-200">Deadline</th>
                </tr>
            </thead>

            <tbody>
                <tr
                    v-for="(item, index) in tugas"
                    :key="item.tugasID"
                    class="hover:bg-neutral-50 transition-colors border-b border-neutral-200"
                    :class="index % 2 === 0 ? 'bg-white' : 'bg-neutral-50/40'"
                >
                    <td class="px-4 py-3 text-neutral-700 w-12">
                        {{ index + 1 }}
                    </td>

                    <td class="px-4 py-3 font-medium text-neutral-800">
                        {{ item.title }}
                    </td>

                    <td class="px-4 py-3 text-neutral-700">
                        {{ item.nama_matpel }}
                    </td>

                    <td class="px-4 py-3 text-neutral-600">
                        {{ formatTanggal(item.deadline) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
