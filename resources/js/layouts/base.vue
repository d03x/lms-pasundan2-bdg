<script setup lang="ts">
import { saveFcmToken } from '@/actions/App/Http/Controllers/NotifServiceController';
import '@vuepic/vue-datepicker/dist/main.css';
import axios from 'axios';
import { initializeApp } from 'firebase/app';
import { getMessaging, getToken, onMessage } from 'firebase/messaging';
import { onMounted } from 'vue';
import { ModalsContainer } from 'vue-final-modal';
import 'vue-final-modal/style.css';
import { toast, Toaster } from 'vue-sonner';
import 'vue-sonner/style.css';

// Firebase config
const firebaseConfig = {
    apiKey: 'AIzaSyBC8OjU6vxFqVHzMsY6Pt3iwFOuUEIhc-E',
    authDomain: 'apiyt-332805.firebaseapp.com',
    projectId: 'apiyt-332805',
    storageBucket: 'apiyt-332805.firebasestorage.app',
    messagingSenderId: '898047629674',
    appId: '1:898047629674:web:6703f1ccad4f02c86ded13',
};

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

// ======================================
// REQUEST PERMISSION
// ======================================
async function requestPermission() {
    if (!('Notification' in window)) {
        return toast.error('Browser tidak mendukung Notifications');
    }
    const permission = await Notification.requestPermission();
    if (permission === 'granted') {
        await getFcmToken();
    }
}

// ======================================
// GET TOKEN
// ======================================
async function getFcmToken() {
    try {
        const swReg = await navigator.serviceWorker.register('/firebase-messaging-sw.js');
        const token = await getToken(messaging, {
            vapidKey: 'BJsJW68L2SBlEQ7OiZprKb8GDx0f9Pz86ad19HyV-uSUnyH30HaKN-pMPbsKrU55O458LXO8vxY1EiU8DhBBtPI',
            serviceWorkerRegistration: swReg,
        });
        axios.post(saveFcmToken().url, { token });
        console.log(token);
    } catch (err) {
        console.error('FCM ERROR:', err);
        toast.error('Gagal mendapatkan FCM token');
    }
}

onMounted(async () => {
    await requestPermission();
});
// ======================================
// LISTEN PESAN SAAT TAB AKTIF
// ======================================
onMessage(messaging, (payload) => {
    console.log('Foreground message:', payload);
    toast.success(payload.notification?.title + ' - ' + payload.notification?.body,{
        position : "top-center"
    });
});
</script>

<template>
    <slot />
    <ModalsContainer />
    <Toaster :rich-colors="true" />
</template>
