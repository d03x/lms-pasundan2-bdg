<script setup lang="ts">
import Button from '@/components/button.vue';
import Input from '@/components/input.vue';
import TextArea from '@/components/text-area.vue';
import PageTitle from '@/layouts/page-title.vue';
</script>

<template>
    <PageTitle
        title="Tambah Materi"
        subtitle="Halaman ini untuk menambah materi baru, Silahkan isi"
    />
    <div class="container mx-auto">
        <div class="rounded bg-white p-5">
            <form class="flex flex-col space-y-3">
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col gap-2">
                        <Input placeholder="Judul Materi" />
                        <Input placeholder="Youtube ID" />
                        <TextArea placeholder="Deaskripsi Materi" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <Input placeholder="Judul Materi" />
                        <Input placeholder="Youtube ID" />
                        <TextArea placeholder="Deaskripsi Materi" />
                    </div>
                </div>
                <div>
                    <Button class="max-w-[120px]" type="submit">Simpan</Button>
                </div>
            </form>
        </div>
    </div>
</template>
