import Layout from '@/layouts/layout.vue';
import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';
import { DefineComponent } from 'vue';
export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

const define_layout = (layout: DefineComponent, name: string) => {
    if (name.includes('auth')) {
        return layout;
    }
    layout.default.layout = Layout;
    return layout;
};

export default define_layout;
