<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

// State untuk toggle password visibility
const showPassword = ref(false);

// Inisialisasi Form Inertia
const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.submit(check(), {
        onFinish: () => form.reset('password'),
    });
};
import Logo from '../../../img/logo.png'
import LoginController from '@/actions/App/Http/Controllers/LoginController';
import { check } from '@/routes/login';
</script>

<template>
    <Head title="Login LMS" />

    <div class="min-h-screen flex flex-col items-center justify-start pt-10 bg-white font-sans">
        
        <div class="flex items-center gap-3 mb-8">
            <img 
                :src="Logo" 
                alt="Logo SMK Pasundan 2" 
                class="h-16 w-auto object-contain"
            />
            <div class="flex flex-col leading-tight text-black">
                <h1 class="text-xl font-bold tracking-wide">
                    SMK Pasundan 
                    <span class="text-[#C85200] text-2xl ml-1">2</span>
                </h1>
                <h2 class="text-xl font-bold tracking-wide">Bandung</h2>
            </div>
        </div>

        <div class="w-full max-w-sm p-8 bg-[#F5F5F5] rounded-[20px]">
            
            <div class="mb-8">
                <h3 class="text-lg font-bold text-black pb-2 border-b-2 border-gray-400 inline-block w-full">
                    Learning Management System
                </h3>
            </div>

            <form @submit.prevent="submit">
                
                <div class="mb-6">
                    <label for="email" class="block text-sm text-black mb-2 pl-1">
                        Email
                    </label>
                    <input 
                        id="email"
                        v-model="form.email"
                        type="text"
                        placeholder="email"
                        class="w-full px-5 py-3 bg-[#EAEaea] rounded-2xl text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-900 border-none transition-all"
                        :class="{ 'ring-2 ring-red-500': form.errors.email }"
                    />
                    <div v-if="form.errors.email" class="text-red-500 text-xs mt-1 pl-2">
                        {{ form.errors.email }}
                    </div>
                </div>

                <div class="mb-10">
                    <label for="password" class="block text-sm text-black mb-2 pl-1">
                        Password
                    </label>
                    <div class="relative">
                        <input 
                            id="password"
                            v-model="form.password"
                            :type="showPassword ? 'text' : 'password'"
                            placeholder="Password"
                            class="w-full px-5 py-3 bg-[#EAEaea] rounded-2xl text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-900 border-none transition-all"
                            :class="{ 'ring-2 ring-red-500': form.errors.password }"
                        />
                        
                        <button 
                            type="button"
                            @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none"
                        >
                            <svg v-if="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    <div v-if="form.errors.password" class="text-red-500 text-xs mt-1 pl-2">
                        {{ form.errors.password }}
                    </div>
                </div>

                <button 
                    type="submit" 
                    :disabled="form.processing"
                    class="w-full py-3 bg-[#0D1B6E] text-white font-bold text-sm rounded-full hover:bg-blue-900 transition-colors uppercase tracking-wider shadow-md"
                >
                    Sign In
                </button>

            </form>
        </div>
    </div>
</template>