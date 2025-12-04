<script setup lang="ts">
import { simpanMateri } from '@/actions/App/Http/Controllers/GuruMateriController';
import Button from '@/components/button.vue';
import Input from '@/components/input.vue';
import VideoPlayer from '@/components/video-player.vue';
import LinkMateriInputField from '@/features/link-materi-input-field/link-materi-input-field.vue';
import PageTitle from '@/layouts/page-title.vue';
import { getYouTubeVideoId } from '@/lib/utils';
import { useForm, usePage } from '@inertiajs/vue3';
import { VueDatePicker } from '@vuepic/vue-datepicker';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.bubble.css';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { computed, ref, watch } from 'vue';

import VueSelect from 'vue-select';
import { toast } from 'vue-sonner';
const page = usePage();
const data = useForm<{
    title?: string;
    youtube_id?: string;
    description?: string;
    kelas_ids?: any[];
    matpel?: any;
    file_materi: string[];
    publish_date?:string,
}>({
    title: '',
    publish_date:'',
    youtube_id: '',
    description: '',
    kelas_ids: page.props.active_kelas as string[],
    matpel: '',
    file_materi: [],
});
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
            data.reset('description', 'file_materi', 'kelas_ids', 'matpel', 'title', 'youtube_id');
        }
    },
);

const total_ref = ref<number[]>([1]);
let counter = 1;

function addFile() {
    counter++;
    if (counter > 10) {
        toast.warning('Hanya bisa menyimpan 10 link materi');
    } else {
        total_ref.value.push(counter);
        data.file_materi.push(''); // tambah 1 item kosong
    }
}

function removeFile(id: number, index: number) {
    const el = document.getElementById(`file-${id}`) as any;
    el.animate(
        [
            { opacity: 1, transform: 'translateY(0)' },
            { opacity: 0, transform: 'translateY(10px)' },
        ],
        { duration: 250, easing: 'ease' },
    ).onfinish = () => {
        total_ref.value.splice(index, 1);
        data.file_materi.splice(index, 1);
        if (counter <= 1) {
            toast.warning('Minimal harus ada 1 file materi');
        } else {
            counter--;
        }
    };
}
const getVideID = computed(() => {
    return getYouTubeVideoId(data.youtube_id as string) as string;
});
</script>

<template>
    <PageTitle title="Tambah Materi" subtitle="Halaman ini untuk menambah materi baru, Silahkan isi" />
    <div class="container mx-auto">
        <div class="rounded bg-white p-5">
            <form @submit.prevent="simpan" class="flex flex-col space-y-3">
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <div class="flex flex-col gap-2">
                        <Input v-model="data.title" placeholder="Judul Materi" />
                        <Input v-model="data.youtube_id" placeholder="Youtube ID" />
                        <VideoPlayer v-if="getVideID" :yt-id="getVideID" />
                        <div class="max-h-[400px] min-h-[120px]">
                            <QuillEditor
                                content-type="html"
                                toolbar="minimal"
                                theme="snow"
                                v-model:content="data.description"
                                placeholder="Deaskripsi Materi"
                            />
                        </div>
                        <LinkMateriInputField v-model="data.file_materi" />
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
                        <div>
                            <label class="mb-4 text-sm font-semibold text-neutral-600" for="">Jadwal Publish</label>
                            <VueDatePicker v-model="data.publish_date" />
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
