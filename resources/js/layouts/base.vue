<script setup lang="ts">
import { ModalsContainer } from 'vue-final-modal';
import 'vue-final-modal/style.css'
import { Toaster } from 'vue-sonner';
import 'vue-sonner/style.css'
  import '@vuepic/vue-datepicker/dist/main.css'
</script>

<template>
    <slot/>
    <ModalsContainer/>
    <Toaster :rich-colors="true"/>
</template>