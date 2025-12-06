export interface Auth {
    user: User;
}
type Kelas = {
    nama_kelas?:string,
    id_kelas?: any,
    jumlah_siswa?:number,
}
export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    tugas : any[],
    info_kelas : any,
    search_current_terms:any,
    matpels: Matpels[];
    materials : any[],
    materi : any,
    kelas : Kelas[],
};
export interface Matpels {
    kode_matpel: string;
    nama: string;
    kategori: string;
    matpel_kode: string;
    guru_nip: string;
    kelas_id: string;
    created_at: string;
    updated_at: string;
    nama_guru: string;
    nama_kelas: string;
    nama_matpel: string;
    nip: string;
    jenis_kelamin: string;
    status: string;
    gelar_depan: string;
    gelar_belakang: string;
    user_id: number;
}

export interface User {
    id: number;
    role: string;
    nama: string;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    kelas?: {
        nama: string;
        id: string;
    };
}
