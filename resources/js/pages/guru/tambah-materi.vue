<script setup lang="ts">
import { simpanMateri } from '@/actions/App/Http/Controllers/GuruMateriController';
import Button from '@/components/button.vue';
import Input from '@/components/input.vue';
import IcBaselineMinus from '@/icons/IcBaselineMinus.vue';
import MaterialSymbolsAddCircleOutline from '@/icons/MaterialSymbolsAddCircleOutline.vue';
import PageTitle from '@/layouts/page-title.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.bubble.css';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { ref, watch } from 'vue';

import VueSelect from 'vue-select';
import { toast } from 'vue-sonner';
const data = useForm<{
    title?: string;
    youtube_id?: string;
    description?: string;
    kelas_ids?: any[];
    matpel?: any;
    file_materi: string[];
}>({
    title: '',
    youtube_id: '',
    description: '',
    kelas_ids: [],
    matpel: '',
    file_materi: [],
});
const page = usePage();
async function simpan() {
    await data.submit(simpanMateri({ kelas_kode: page.props.kelas_kode as string }));
}
watch(
    () => [data.hasErrors, data.processing],
    (e) => {
        if (data.hasErrors && !(data.errors as any).success && !data.processing) {
            toast.error('Gagal!Tolong periksa inputan anda lagi!');
        } else if ((data.errors as any).success) {
            toast.success((data.errors as any).success);
            data.resetAndClearErrors();
            data.reset();
        }
    },
);

const total_ref = ref<number[]>([1]);
let counter = 1;

function addFile() {
    counter++;
    total_ref.value.push(counter);
    data.file_materi.push(''); // tambah 1 item kosong
}

function removeFile(id: number, index: number) {
    total_ref.value = total_ref.value.filter((v) => v !== id);
    data.file_materi.splice(index, 1); // hapus sesuai index input
}
</script>

<template>
    <PageTitle title="Tambah Materi" subtitle="Halaman ini untuk menambah materi baru, Silahkan isi" />
    <div class="container mx-auto">
        <div class="rounded bg-white p-5">
            <form @submit.prevent="simpan" class="flex flex-col space-y-3">
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col gap-2">
                        <Input v-model="data.title" placeholder="Judul Materi" />
                        <Input v-model="data.youtube_id" placeholder="Youtube ID" />
                        <div class="max-h-[400px] min-h-[120px]">
                            <QuillEditor
                                content-type="html"
                                toolbar="minimal"
                                theme="snow"
                                v-model:content="data.description"
                                placeholder="Deaskripsi Materi"
                            />
                        </div>
                        <div class="mt-11">
                            <label class="mb-4 text-sm font-semibold text-neutral-600">Link Materi</label>

                            <div class="flex flex-col space-y-2">
                                <div v-for="(id, index) in total_ref" :key="id" class="flex items-center gap-3">
                                    <Input
                                        class="bg-white text-xs ring-1 ring-neutral-400"
                                        type="text"
                                        v-model="data.file_materi[index]"
                                        placeholder="Masukkan link materi"
                                    />

                                    <div class="flex items-center gap-1">
                                        <Button @click="addFile">
                                            <MaterialSymbolsAddCircleOutline />
                                        </Button>

                                        <Button v-if="total_ref.length > 1" class="bg-red-500" @click="() => removeFile(id, index)">
                                            <IcBaselineMinus />
                                        </Button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div>
                            <label class="mb-4 text-sm font-semibold text-neutral-600" for="">Pilih Matpel</label>
                            <VueSelect
                                placeholder="Pilih Matpel"
                                v-model="data.matpel"
                                :options="$page.props.matpels"
                                index="kode_matpel"
                                label="nama"
                                :multiple="false"
                            />
                        </div>
                        <div>
                            <label class="mb-4 text-sm font-semibold text-neutral-600" for="">Pilih Kelas</label>
                            <VueSelect
                                placeholder="Pilih kelas"
                                v-model="data.kelas_ids"
                                :options="$page.props.kelas"
                                index="id_kelas"
                                label="nama_kelas"
                                :multiple="true"
                            />
                        </div>
                        <div >
                            <label class="mb-1 block text-sm font-semibold text-neutral-600" for="">NOMOR MATERI</label>
                            <Input class="max-w-xs" v-model="data.youtube_id" type="number" placeholder="Nomor Materi" />
                        </div>
                    </div>
                </div>
                <div>
                    <Button :disabled="data.processing" :loading="data.processing" class="max-w-[120px]" type="submit">Simpan</Button>
                </div>
            </form>
        </div>
    </div>
</template>
