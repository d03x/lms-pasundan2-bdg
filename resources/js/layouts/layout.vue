<script setup lang="ts">
import Base from './base.vue';
import Header from './header/header.vue';
import 'vue-select/dist/vue-select.css';
</script>

<template>
    <Base>
        <!-- begin:header -->
        <Header />
        <!-- end:header -->
        <div class="container px-2 mb-4 lg:px-0 mx-auto">
            <slot />
        </div>
    </Base>
</template>
