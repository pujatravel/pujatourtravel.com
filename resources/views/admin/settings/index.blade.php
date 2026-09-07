@extends('admin.layouts.app')

@section('title', 'Pengaturan Website & Kontak')
@section('page-title', 'Pengaturan Profil Brand & Informasi Kontak')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <h3 class="font-display font-bold text-lg text-slate-900 border-b border-slate-100 pb-3">Informasi Brand & Kontak Resmi</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nama Perusahaan / Brand</label>
                    <input type="text" name="company_name" value="{{ old('company_name', $settings['company_name'] ?? 'PUJA TOUR & TRAVEL PANGANDARAN') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nomor WhatsApp CS (Tanpa +/Spasi)</label>
                    <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '6281234567890') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Nomor Telepon Hotline</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', $settings['phone_number'] ?? '+62 812-3456-7890') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Alamat Email Resmi</label>
                    <input type="email" name="email_address" value="{{ old('email_address', $settings['email_address'] ?? 'info@pujatourtravel.com') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Alamat Kantor Fisik di Pangandaran</label>
                <textarea name="office_address" rows="2" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">{{ old('office_address', $settings['office_address'] ?? 'Jl. Pantai Barat No. 88, Pangandaran, Jawa Barat 46396') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Jam Operasional Pelayanan</label>
                <input type="text" name="operational_hours" value="{{ old('operational_hours', $settings['operational_hours'] ?? 'Setiap Hari: 06.00 - 21.00 WIB') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
            </div>

            <h3 class="font-display font-bold text-lg text-slate-900 border-t border-b border-slate-100 py-3 mt-8">Tautan Media Sosial Resmi</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">Instagram URL</label>
                    <input type="url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url'] ?? 'https://instagram.com/pujatourtravel') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase">TikTok URL</label>
                    <input type="url" name="tiktok_url" value="{{ old('tiktok_url', $settings['tiktok_url'] ?? 'https://tiktok.com/@pujatourtravel') }}" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm bg-slate-50 focus:bg-white focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 outline-none">
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end">
                <button type="submit" class="px-8 py-3.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm transition">
                    Simpan Perubahan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
