<script setup lang="ts">
import PageTitle from '@/layouts/page-title.vue';
import ListKelas from './tugas/ListKelas.vue';
import ListTugas from './tugas/ListTugas.vue';
</script>

<template>
    <ListKelas v-if="$page.props.kelas" />
    <ListTugas v-else-if="$page.props.tugas"/>
</template>
