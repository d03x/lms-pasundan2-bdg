<script setup lang="ts">
import { showMateri } from '@/actions/App/Http/Controllers/MateriController';
import VideoPlayer from '@/components/video-player.vue';
import FormkitDatetime from '@/icons/FormkitDatetime.vue';
import HugeiconsTeaching from '@/icons/HugeiconsTeaching.vue';
import MaterialSymbolsLightBook5Rounded from '@/icons/MaterialSymbolsLightBook5Rounded.vue';
import NotFoundVector from '@/icons/NotFoundVector.vue';
import { Link, usePage } from '@inertiajs/vue3';
const page = usePage().props;
</script>

<template>
    <div v-if="page.materi" class="bg-white px-3 pt-2 lg:px-8 lg:py-5">
        <h1 class="text-lg font-semibold capitalize text-neutral-700 lg:text-xl">
            {{ page.materi.title }}
        </h1>
        <div class="mt-2 flex flex-col space-y-1 text-sm">
            <div class="flex items-center text-xs text-neutral-600">
                <HugeiconsTeaching />
                <span class="ml-1 block">
                    {{ page.materi.nama_guru }}
                </span>
            </div>
            <div class="flex items-center text-xs text-neutral-600">
                <MaterialSymbolsLightBook5Rounded />
                <span class="ml-1 block">
                    {{ page.materi.nama_matpel }}
                </span>
            </div>
              <div class="flex items-center text-xs text-neutral-600">
                <FormkitDatetime />
                <span class="ml-1 block">
                    {{ page.materi.created_at }}
                </span>
            </div>
        </div>
        <hr class="my-3 text-neutral-300" />
        <div class="flex flex-col space-y-4">
            <div class="overflow-hidden rounded">
                <VideoPlayer 
                    :yt-id="page.materi.youtube_id"
                    />
            </div>
            <div>
                <h2 class="text-sm font-semibold">Description:</h2>
                <p class="text-sm tracking-normal leading-relaxed">
                    {{ page.materi.description }}
                </p>
            </div>
            
            <div class="overflow-x-auto pb-4">
                <h2 class="text-sm font-semibold">Link Materi:</h2>
                <ul class="space-y-2 text-xs text-blue-500 lg:space-y-0 lg:text-sm">
                    <li v-for="i in JSON.parse(page.materi.file_materi)" class="flex flex-col lg:flex-row lg:items-center lg:gap-1">
                        <span class="text-neutral-700">[Buku Otomotif 1]</span>
                        <a
                            class="transition-all hover:ring-1 lg:px-1 lg:hover:text-red-500"
                            href="https://drive.google.com/file/d/1jfTZCwMTQLWng72IsvMg21jvqViZSfod/view"
                            >
                             {{ i }}
                            </a
                        >
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div v-else class="bg-white text-center p-5 min-h-[400px] flex items-center flex-col justify-center">
        <NotFoundVector/>
        <div class="text-sm  mt-3">
            <h1>Opps! Materi tidak ditemukan atau anda tidak ada aksess</h1>
            <Link class="font-bold mt-3 block text-primary hover:text-red-400" :href="showMateri()">Kembali!</Link>
        </div>
    </div>
</template>
