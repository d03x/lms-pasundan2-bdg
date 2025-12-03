<script setup lang="ts">
import MateriController, { showMateri } from '@/actions/App/Http/Controllers/MateriController';
import HugeiconsTaskDaily01 from '@/icons/HugeiconsTaskDaily01.vue';
import HugeiconsTeaching from '@/icons/HugeiconsTeaching.vue';
import IcBaselineRemoveRedEye from '@/icons/IcBaselineRemoveRedEye.vue';
import MaterialSymbolsCheckCircleUnreadOutline from '@/icons/MaterialSymbolsCheckCircleUnreadOutline.vue';
import MaterialSymbolsLightBook5Rounded from '@/icons/MaterialSymbolsLightBook5Rounded.vue';
import SolarNotebookBold from '@/icons/SolarNotebookBold.vue';
import { view } from '@/routes/siswa/materi';
import { Link,router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
const matpelCurrent = ref<string|null>(null)
function selectMatpel(e : Event){
    const target = (e as any).target.value;
    router.visit(showMateri({
        query : {
            matpel_id : target,
        }
    }).url)
}
</script>

<template>
    <div class="py-4">
        <h1 class="text-xl font-bold text-neutral-700">Materi</h1>
        <p class="text-sm">Halaman ini menyajikan materi pada masing masing mata pelajaran</p>
    </div>
    <select @change="selectMatpel" class="mb-3 rounded outline-none border-neutral-200 shadow border-sm text-sm bg-white p-1 py-1.5 cursor-pointer text-neutral-600">
        <option class="text-sm" value="" disabled :selected="!matpelCurrent">Pilih Mata Pelajaran</option>
        <option :selected="matpelCurrent === 'n983248742397423'" value="n983248742397423" class="text-sm">Teknik Kendaraan Ringan (4)</option>
        <option :selected="matpelCurrent === '1'" value="1" class="text-sm">Teknologi Dasar Otomotif (39)</option>
        <option :selected="matpelCurrent === '2'" value="2" class="text-sm">Pemeliharaan Mesin Kendaraan Ringan</option>
        <option :selected="matpelCurrent === '4'" value="4" class="text-sm">Pemeliharaan Sasis & Pemindah Tenaga</option>
        <option :selected="matpelCurrent === '3'" value="3" class="text-sm">Pemeliharaan Kelistrikan Kendaraan Ringan</option>
    </select>

    <div class="grid grid-cols-1 gap-3 lg:grid-cols-3">
        <div v-for="i in 4">
            <div class="rounded-lg  shadow hover:translate-y-1 cursor-pointer transition-all bg-white p-4">
                <h1>
                    <SolarNotebookBold class="text-red-500"/>
                    <p> Materi #{{ i }}: Pemeliharaan Mesin Kendaraan Ringan dan optimasi bahan bakar pada motor</p>
                </h1>
                <div class="mt-2 flex flex-col space-y-1 text-sm">
                    <div class="flex items-center text-xs text-neutral-600">
                        <HugeiconsTeaching />
                        <span class="ml-1 block">Prof. Ardiansyah,S.Kom,M.Kom</span>
                    </div>
                    <div class="flex items-center text-xs text-neutral-600">
                        <MaterialSymbolsLightBook5Rounded />
                        <span class="ml-1 block">Komputer Dan Dasar Jaringan</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="flex items-center text-xs text-neutral-600">
                            <HugeiconsTaskDaily01 />
                            <span class="ml-1 block">1 Tugas</span>
                        </div>
                        <MaterialSymbolsCheckCircleUnreadOutline class="text-green-600" />
                    </div>
                </div>
                <Link :href="view({id:i})" class="mt-3 justify-center gap-2 text-neutral-800 cursor-pointer w-full items-center flex rounded-lg bg-orange-500 px-1 py-2 text-sm">
                    <IcBaselineRemoveRedEye/>
                    <span>Lihat Materi</span>
                </Link>
            </div>
        </div>
    </div>
</template>
