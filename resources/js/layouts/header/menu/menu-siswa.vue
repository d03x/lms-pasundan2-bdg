<script setup lang="ts">
import {  showMateri } from '@/actions/App/Http/Controllers/MateriController';
import HugeiconsTaskDaily01 from '@/icons/HugeiconsTaskDaily01.vue';
import MaterialSymbolsMarkdownPaste from '@/icons/MaterialSymbolsMarkdownPaste.vue';
import MaterialSymbolsMenuBookOutlineRounded from '@/icons/MaterialSymbolsMenuBookOutlineRounded.vue';
import SolarSquareAcademicCap2Bold from '@/icons/SolarSquareAcademicCap2Bold.vue';
import MenuItem from './menu-item.vue';
import CodiconCommentDiscussionSparkle from '@/icons/CodiconCommentDiscussionSparkle.vue';
import TugasSiswaController from '@/actions/App/Http/Controllers/TugasSiswaController';
</script>

<template>
    <MenuItem label="Akademik" href="/" :has-dropdown="true" :icon="SolarSquareAcademicCap2Bold">
        <MenuItem label="Materi" :href="showMateri()" :icon="MaterialSymbolsMenuBookOutlineRounded" />
        <MenuItem label="Tugas" :href="TugasSiswaController()" :icon="HugeiconsTaskDaily01" />
        <MenuItem label="Absensi" href="/" :icon="MaterialSymbolsMarkdownPaste" />
    </MenuItem>
</template>
