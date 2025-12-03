<template>
    <div class="flex items-center space-x-3">
        <img class="aspect-square w-14 lg:w-20" :src="Logo" alt="" />
        <div class="flex flex-col">
            <h1 class="text-xs text-neutral-300 lg:text-sm">Learning Management System</h1>
            <h2 class="text-sm font-bold lg:text-lg">SMK Pasundan 2 Bandung</h2>
        </div>
    </div>
</template>
<script setup lang="ts">
import Logo from '../../../img/logo.png';
</script>
