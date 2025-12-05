<script setup lang="ts">
import { deleteMateri, publishMateri, tambahMateri } from '@/actions/App/Http/Controllers/GuruMateriController';
import Button from '@/components/button.vue';
import Modal from '@/components/modal.vue';
import CarbonEventSchedule from '@/icons/CarbonEventSchedule.vue';
import CiTriangleWarning from '@/icons/CiTriangleWarning.vue';
import IcBaselineDelete from '@/icons/IcBaselineDelete.vue';
import MaterialSymbolsAddCircleOutline from '@/icons/MaterialSymbolsAddCircleOutline.vue';
import MaterialSymbolsCheckCircleUnreadOutline from '@/icons/MaterialSymbolsCheckCircleUnreadOutline.vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { useVfm } from 'vue-final-modal';
import { toast } from 'vue-sonner';
const page = usePage();
const matpelSelected = ref<string | null>((page.props.kode_matpel as string) ?? null);
watch(matpelSelected, () => {
    if (matpelSelected) {
        router.visit('?kode_matpel=' + matpelSelected.value);
    }
});
const vfm = useVfm();
const modalID = 'modalViewData';
function openModalTambah() {
    vfm.open(modalID);
}
function close() {
    vfm.close(modalID);
}
async function deleteMateriItem(id: string) {
    if (confirm('Apakah anda yakin')) {
        const del = await router.delete(
            deleteMateri({
                materi_id: id,
            }).url,
        );
    }
}
async function publishMateriItem(id: string) {
    if (confirm('Apakah anda yakin')) {
        const del = await router.patch(publishMateri().url, {
            id : id
        });
    }
}
watch(page, (e) => {
    if (page.props.errors.success) {
        toast.success(page.props.errors.success as string, {
            position: 'top-right',
        });
    } else if (page.props.errors.gagal) {
        toast.error(page.props.errors.success as string, {
            position: 'top-right',
        });
    }
});
</script>

<template>
    <Modal @close="close" :modalID="modalID" title="Tambah Data">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni maxime officia impedit quod, iure ipsa animi dolore ducimus, deleniti nostrum
        doloribus vel aut cum saepe tenetur a magnam neque nemo?
    </Modal>
    <div class="mt-4 flex items-center space-x-3">
        <Link
            :href="
                tambahMateri({
                    kelas_kode: $page.props.kelas_kode as string,
                })
            "
            class="flex cursor-pointer items-center space-x-1 rounded bg-orange-500 p-2 px-3 text-xs text-white shadow"
        >
            <MaterialSymbolsAddCircleOutline />
            <span>Tambah Materi</span>
        </Link>
        <select v-model="matpelSelected" class="rounded border border-neutral-300 bg-white px-2 py-1 text-sm">
            <option disabled :selected="true">--Pilih Matpel---</option>
            <option
                v-for="value in $page.props.matpels"
                :selected="value.kode_matpel === $page.props.kode_matpel"
                :key="value.kode_matpel"
                :value="value.kode_matpel"
            >
                {{ value.nama }}
            </option>
        </select>
    </div>
    <table v-if="($page.props.matpel_kode || $page.props?.materials) && $page.props?.materials.length > 0" class="cool-table mt-4 bg-white">
        <thead class="cool-head">
            <tr>
                <th>NO</th>
                <th>Judul</th>
                <th>Tanggal Publish / Publish</th>
                <th>Total File Materi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="cool-body text-xs">
            <tr v-if="$page.props.materials.length > 0" v-for="materi in $page.props.materials">
                <td>
                    {{ materi.nomor_materi }}
                </td>

                <td>
                    <p class="line-clamp-1">
                        {{ materi.title }}
                    </p>
                </td>
                <td class="flex items-center justify-between space-x-2">
                    <p class="line-clamp-1">{{ materi.publish_date }}</p>
                    <div>
                        <span v-if="materi.is_published" class="flex items-center justify-center rounded-full text-[15px] text-green-700">
                            <MaterialSymbolsCheckCircleUnreadOutline />
                        </span>
                        <span v-else class="flex items-center justify-center rounded-full text-[15px]">
                            <CarbonEventSchedule />
                        </span>
                    </div>
                </td>
                <td>
                    <div class="text-center font-semibold text-red-500  underline">{{ materi.jumlahFileMateri }}</div>
                </td>
                <td class="flex justify-center items-center space-x-2">
                    <Button @click="() => deleteMateriItem(materi.id)" class="bg-red-500 p-1 hover:bg-red-700 rounded-full">
                        <IcBaselineDelete />
                    </Button>
                    <Button v-if="!materi.is_published" @click="() => publishMateriItem(materi.id)" class="font-normal px-2 rounded-full py-1 text-xs">
                        Publish
                    </Button>
                </td>
            </tr>
        </tbody>
    </table>
    <div v-else>
        <div class="mt-2 flex items-center space-x-1 rounded-md border border-red-200 bg-red-100 p-3 text-sm text-red-500">
            <CiTriangleWarning />
            <p>Silahkan pilih matpel dulu kang!</p>
        </div>
    </div>
</template>
