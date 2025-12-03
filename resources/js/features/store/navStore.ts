import { defineStore } from 'pinia';

export const useNavigationMenu = defineStore('useNavigationMenu', {
    state() {
        return {
            isOpen: false,
        };
    },
    actions: {
        toggleMenu() {
            this.isOpen = !this.isOpen;
        },
    },
});
