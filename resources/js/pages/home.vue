<template>
    <div class="mt-4 bg-white p-4 text-center shadow">
        <h2 class="text-lg">Selamat datang, {{ $page.props.auth.user.nama }}</h2>
        <h2 class="text-sm">
            <span>Anda login sebagai</span> <b>{{ $page.props.auth.user.role }}</b>
            <span v-if="$page.props.auth.user.kelas"> Kelas <b>{{ $page.props.auth.user.kelas.nama }}</b></span>
        </h2>
    </div>
</template>
