importScripts("https://www.gstatic.com/firebasejs/9.0.0/firebase-app-compat.js");
importScripts("https://www.gstatic.com/firebasejs/9.0.0/firebase-messaging-compat.js");

firebase.initializeApp({
    apiKey: 'AIzaSyBC8OjU6vxFqVHzMsY6Pt3iwFOuUEIhc-E',
    authDomain: 'apiyt-332805.firebaseapp.com',
    projectId: 'apiyt-332805',
    storageBucket: 'apiyt-332805.firebasestorage.app',
    messagingSenderId: '898047629674',
    appId: '1:898047629674:web:6703f1ccad4f02c86ded13',
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
    self.registration.showNotification(payload.notification.title, {
        body: payload.notification.body,
        icon: "/favicon.ico",
    });
});
