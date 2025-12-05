import { initializeApp } from "firebase/app";
import { getMessaging } from "firebase/messaging";

const firebaseConfig = {
    apiKey: 'AIzaSyBC8OjU6vxFqVHzMsY6Pt3iwFOuUEIhc-E',
    authDomain: 'apiyt-332805.firebaseapp.com',
    projectId: 'apiyt-332805',
    storageBucket: 'apiyt-332805.firebasestorage.app',
    messagingSenderId: '898047629674',
    appId: '1:898047629674:web:6703f1ccad4f02c86ded13',
    measurementId: 'G-VDCZZQ0DZZ',
};
export const app = initializeApp(firebaseConfig);
export const messaging = getMessaging(app);

