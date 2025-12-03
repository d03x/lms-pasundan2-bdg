<template>
    <header style="background-image: url('https://edlink.id/assets/img/base.png');" class="z-50 h-24 bg-primary bg-cover bg-no-repeat bg-left text-primary-foreground lg:h-header">
        <div class="container relative z-50 mx-auto flex h-24 items-center justify-start px-2 lg:h-header lg:px-0">
            <Logo />
            <div class="text-netural-600 ml-auto">
                <Menu class="hidden" />
                <Avatar :fallback="$page.props.auth.user.name" />
            </div>
        </div>
    </header>
    <nav class="sticky top-0  z-50 bg-white/50 py-0.5 shadow backdrop-blur-md">
        <AppMenu />
    </nav>
</template>
<script setup lang="ts">
import Avatar from '@/components/avatar.vue';
import Logo from './logo.vue';
import Menu from './Menu.vue';
import AppMenu from './menu/app-menu.vue';
</script>
