<template>
    <PageTitle title="Tambah Tugas" subtitle="Silahkan tambah tugas dengan memilih mata pelajaran dan kelas." />

    <div class="flex flex-col gap-3 rounded-xl bg-white p-4 shadow">
        <!-- MATA PELAJARAN -->
        <div>
            <label class="mb-1 block text-sm font-normal">Mata Pelajaran</label>
            <VueSelect
                v-if="$page.props.matpels.length > 1"
                placeholder="Pilih Mata Pelajaran"
                :options="$page.props.matpels"
                label="nama"
                :reduce="(item: any) => item.kode_matpel"
                v-model="form.matpel"
                class="w-full"
            />
        </div>

        <!-- JUDUL -->
        <div>
            <label class="mb-1 block text-sm font-normal">Judul Tugas</label>
            <Input placeholder="Judul Tugas" v-model="form.judul" />
        </div>

        <!-- CKEDITOR -->
        <div>
            <label class="mb-1 block text-sm font-normal">Deskripsi Tugas</label>
            <Ckeditor class="prose" :editor="ClassicEditor" v-model="form.deskripsi" :config="editorConfig" />
        </div>

        <!-- KELAS -->
        <div>
            <label class="mb-1 block text-sm font-normal">Kelas</label>
            <VueSelect
                placeholder="Pilih Kelas"
                :options="kelas"
                label="nama_kelas"
                :reduce="(item: Kelas) => item.id_kelas"
                :multiple="true"
                v-model="form.kelas"
                class="w-full"
            />
        </div>
    </div>
</template>

<script setup lang="ts">
import Input from '@/components/input.vue';
import PageTitle from '@/layouts/page-title.vue';
import VueSelect from 'vue-select';

import { Ckeditor } from '@ckeditor/ckeditor5-vue';
import {
    Autoformat,
    AutoImage,
    Autosave,
    BlockQuote,
    Bold,
    CKBox,
    CKBoxImageEdit,
    ClassicEditor,
    CloudServices,
    Code,
    CodeBlock,
    Emoji,
    Essentials,
    FontBackgroundColor,
    FontColor,
    FontFamily,
    FontSize,
    Heading,
    HorizontalLine,
    ImageBlock,
    ImageCaption,
    ImageInline,
    ImageInsert,
    ImageInsertViaUrl,
    ImageResize,
    ImageStyle,
    ImageTextAlternative,
    ImageToolbar,
    ImageUpload,
    Indent,
    IndentBlock,
    Italic,
    Link,
    LinkImage,
    List,
    ListProperties,
    MediaEmbed,
    Mention,
    Paragraph,
    PasteFromOffice,
    PictureEditing,
    Highlight,
    Strikethrough,
    Subscript,
    Superscript,
    Table,
    TableCaption,
    TableCellProperties,
    TableColumnResize,
    TableProperties,
    TableToolbar,
    TextTransformation,
    TodoList,
    Underline,
} from 'ckeditor5';
import 'ckeditor5/ckeditor5.css';

import { getKelasByMatpel } from '@/routes/guru';
import { Kelas } from '@/types';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { computed, ref, watch } from 'vue';

const kelas = ref([]);

const form = useForm({
    matpel: null,
    judul: '',
    deskripsi: '',
    kelas: [],
});

watch(
    () => form.matpel,
    async ($e) => {
        if (!$e) return;
        const res = await axios.post(getKelasByMatpel().url, { matpel_kode: $e });

        kelas.value = res.data ?? [];
        form.reset('kelas');
    },
);

// CKEditor config
const editorConfig = computed(() => ({
    licenseKey: 'GPL',
    height: 500,
    plugins: [
        Autoformat,
        AutoImage,
        Autosave,
        BlockQuote,
        Bold,
        CKBox,
        CKBoxImageEdit,
        CloudServices,
        Emoji,
        Essentials,
        Subscript,
        Heading,
        ImageBlock,
        ImageCaption,
        ImageInline,
        ImageInsert,
        ImageInsertViaUrl,
        ImageResize,
        ImageStyle,
        ImageTextAlternative,
        ImageToolbar,
        ImageUpload,
        Indent,
        IndentBlock,
        Italic,
        Link,
        LinkImage,
        List,
        ListProperties,
        MediaEmbed,
        Mention,
        Paragraph,
        PasteFromOffice,
        PictureEditing,
        Table,
        TableCaption,
        TableCellProperties,
        TableColumnResize,
        TableProperties,
        TableToolbar,
        TextTransformation,
        TodoList,
        Underline,
        FontBackgroundColor,
        FontColor,
        FontFamily,
        FontSize,
        Highlight,
        HorizontalLine,
        CodeBlock,
        Strikethrough,
        Code,
        Superscript,
    ],
    toolbar: [
        'undo',
        'redo',
        '|',
        'heading',
        '|',
        'fontSize',
        'fontFamily',
        'fontColor',
        'fontBackgroundColor',
        '|',
        'bold',
        'italic',
        'underline',
        'strikethrough',
        'subscript',
        'superscript',
        'code',
        '|',
        'emoji',
        'horizontalLine',
        'link',
        'insertImage',
        'ckbox',
        'mediaEmbed',
        'insertTable',
        'highlight',
        'blockQuote',
        'codeBlock',
        '|',
        'bulletedList',
        'numberedList',
        'todoList',
        'outdent',
        'indent',
    ],
}));
</script>
