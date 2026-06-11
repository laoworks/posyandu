<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sistem Posyandu Buano') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased">
        <div class="min-h-screen lg:grid lg:grid-cols-[1.1fr_520px]">
            <div class="hidden bg-[#3f37c9] lg:flex lg:flex-col lg:justify-between lg:p-10 xl:p-14">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3 text-white">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl border border-white/20 bg-white/10 text-lg font-semibold">P</span>
                    <span>
                        <span class="block text-xs font-semibold uppercase tracking-[0.28em] text-white/70">Buano</span>
                        <span class="block text-base font-semibold">Sistem Posyandu</span>
                    </span>
                </a>

                <div class="max-w-xl text-white">
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-white/70">Pelayanan Posyandu</p>
                    <h1 class="mt-4 text-4xl font-semibold leading-tight xl:text-5xl">
                        Pendataan ibu dan anak yang lebih rapi, ringan, dan mudah dipantau.
                    </h1>
                    <p class="mt-5 text-base leading-8 text-white/80">
                        Halaman masuk ini dipakai oleh kader posyandu, bidan desa, dan orang tua untuk mengakses data balita, jadwal pelayanan, riwayat imunisasi, serta hasil penimbangan secara terpusat.
                    </p>

                    <div class="mt-8 grid gap-4 md:grid-cols-3">
                        <div class="border border-white/15 bg-white/10 p-4 backdrop-blur-sm">
                            <p class="text-xs uppercase tracking-[0.24em] text-white/60">Kader</p>
                            <p class="mt-2 text-sm leading-6 text-white/85">Kelola user, balita, jadwal, dan laporan posyandu.</p>
                        </div>
                        <div class="border border-white/15 bg-white/10 p-4 backdrop-blur-sm">
                            <p class="text-xs uppercase tracking-[0.24em] text-white/60">Bidan Desa</p>
                            <p class="mt-2 text-sm leading-6 text-white/85">Input layanan pemeriksaan, penimbangan, dan imunisasi.</p>
                        </div>
                        <div class="border border-white/15 bg-white/10 p-4 backdrop-blur-sm">
                            <p class="text-xs uppercase tracking-[0.24em] text-white/60">Orang Tua</p>
                            <p class="mt-2 text-sm leading-6 text-white/85">Lihat data anak, riwayat layanan, dan jadwal kegiatan.</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between border-t border-white/15 pt-6 text-sm text-white/70">
                    <p>Desa Buano, Kecamatan Huamual Belakang</p>
                    <a href="{{ url('/') }}" class="transition hover:text-white">Kembali ke beranda</a>
                </div>
            </div>

            <div class="flex min-h-screen items-center justify-center px-5 py-8 sm:px-8 lg:px-10">
                <div class="w-full max-w-md">
                    <div class="mb-8 lg:hidden">
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#3f37c9] text-lg font-semibold text-white">P</span>
                            <span>
                                <span class="block text-xs font-semibold uppercase tracking-[0.24em] text-[#3f37c9]">Buano</span>
                                <span class="block text-base font-semibold text-slate-800">Sistem Posyandu</span>
                            </span>
                        </a>
                    </div>

                    <div class="border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                        {{ $slot }}
                    </div>

                    <footer class="mt-6 flex flex-col gap-2 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                        <p>&copy; {{ date('Y') }} Sistem Posyandu Buano</p>
                        <a href="{{ url('/') }}" class="text-slate-600 transition hover:text-[#3f37c9]">Kembali ke beranda</a>
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
