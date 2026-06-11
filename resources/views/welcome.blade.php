<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Sistem Posyandu Buano') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-50 font-sans text-slate-900 antialiased">
        <div class="min-h-screen">
            <header class="border-b border-slate-200 bg-white">
                <div class="mx-auto flex w-full max-w-7xl items-center justify-between px-5 py-4 sm:px-6 lg:px-8">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#3f37c9] text-lg font-semibold text-white">P</span>
                        <span>
                            <span class="block text-xs font-semibold uppercase tracking-[0.24em] text-[#3f37c9]">Buano</span>
                            <span class="block text-base font-semibold text-slate-800">Sistem Posyandu</span>
                        </span>
                    </a>

                    @if (Route::has('login'))
                        <nav class="flex items-center gap-3">
                            @auth
                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="inline-flex items-center justify-center border border-[#3f37c9] px-4 py-2 text-sm font-medium text-[#3f37c9] transition hover:bg-[#3f37c9] hover:text-white"
                                >
                                    Dashboard
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="inline-flex items-center justify-center border border-slate-300 px-4 py-2 text-sm font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-800"
                                >
                                    Login
                                </a>

                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="inline-flex items-center justify-center border border-[#3f37c9] bg-[#3f37c9] px-4 py-2 text-sm font-medium text-white transition hover:bg-[#352ead]"
                                    >
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </header>

            <main>
                <section class="mx-auto grid w-full max-w-7xl gap-10 px-5 py-12 sm:px-6 lg:grid-cols-[1.2fr_0.8fr] lg:px-8 lg:py-16">
                    <div class="space-y-8">
                        <div class="space-y-5">
                            <p class="text-sm font-semibold uppercase tracking-[0.28em] text-[#3f37c9]">Sistem Informasi Posyandu</p>
                            <h1 class="max-w-3xl text-4xl font-semibold leading-tight text-slate-800 sm:text-5xl">
                                Pendataan balita, layanan kesehatan, dan jadwal posyandu dalam satu sistem yang lebih rapi.
                            </h1>
                            <p class="max-w-2xl text-base leading-8 text-slate-600">
                                Sistem ini membantu kader posyandu, bidan desa, dan orang tua memantau data balita, riwayat penimbangan, imunisasi, jadwal kegiatan, serta laporan layanan secara lebih mudah.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <a
                                href="{{ route('login') }}"
                                class="inline-flex items-center justify-center border border-[#3f37c9] bg-[#3f37c9] px-5 py-3 text-sm font-medium text-white transition hover:bg-[#352ead]"
                            >
                                Masuk ke Sistem
                            </a>
                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="inline-flex items-center justify-center border border-slate-300 px-5 py-3 text-sm font-medium text-slate-600 transition hover:border-slate-400 hover:text-slate-800"
                                >
                                    Daftar Orang Tua
                                </a>
                            @endif
                        </div>

                        <div class="grid gap-4 md:grid-cols-3">
                            <div class="border border-slate-200 bg-white p-5 shadow-sm">
                                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Kader Posyandu</p>
                                <p class="mt-3 text-sm leading-7 text-slate-600">Mengelola data user, balita, jadwal kegiatan, dan laporan layanan.</p>
                            </div>
                            <div class="border border-slate-200 bg-white p-5 shadow-sm">
                                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Bidan Desa</p>
                                <p class="mt-3 text-sm leading-7 text-slate-600">Mencatat pemeriksaan, penimbangan, serta imunisasi balita secara berkala.</p>
                            </div>
                            <div class="border border-slate-200 bg-white p-5 shadow-sm">
                                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Orang Tua</p>
                                <p class="mt-3 text-sm leading-7 text-slate-600">Melihat data anak, jadwal kegiatan, dan riwayat layanan yang sudah tercatat.</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div class="border border-slate-200 bg-white p-6 shadow-sm">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[#3f37c9]">Layanan Utama</p>
                            <div class="mt-5 space-y-4">
                                <div class="border border-slate-200 p-4">
                                    <p class="text-sm font-semibold text-slate-800">Pendataan Balita</p>
                                    <p class="mt-1 text-sm leading-6 text-slate-500">Data identitas anak dan orang tua tersimpan lebih terstruktur.</p>
                                </div>
                                <div class="border border-slate-200 p-4">
                                    <p class="text-sm font-semibold text-slate-800">Riwayat Layanan</p>
                                    <p class="mt-1 text-sm leading-6 text-slate-500">Penimbangan dan imunisasi dapat dipantau kembali kapan saja.</p>
                                </div>
                                <div class="border border-slate-200 p-4">
                                    <p class="text-sm font-semibold text-slate-800">Jadwal Posyandu</p>
                                    <p class="mt-1 text-sm leading-6 text-slate-500">Informasi jadwal kegiatan mendatang tampil dalam satu tempat.</p>
                                </div>
                            </div>
                        </div>

                        <div class="border border-slate-200 bg-white p-6 shadow-sm">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-500">Informasi Layanan</p>
                            <div class="mt-5 space-y-4 text-sm text-slate-600">
                                <div class="border border-slate-200 p-4">
                                    <p class="font-medium text-slate-800">Akses Sesuai Peran</p>
                                    <p class="mt-1 leading-6">Setiap pengguna akan diarahkan ke halaman kerja sesuai perannya setelah berhasil masuk.</p>
                                </div>
                                <div class="border border-slate-200 p-4">
                                    <p class="font-medium text-slate-800">Data Tersusun Rapi</p>
                                    <p class="mt-1 leading-6">Riwayat balita, hasil layanan, dan jadwal kegiatan tersimpan dalam satu sistem yang mudah dicari.</p>
                                </div>
                                <div class="border border-slate-200 p-4">
                                    <p class="font-medium text-slate-800">Pemantauan Berkala</p>
                                    <p class="mt-1 leading-6">Orang tua, kader, dan bidan dapat memantau layanan posyandu secara lebih teratur.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <footer class="border-t border-slate-200 bg-white">
                <div class="mx-auto flex w-full max-w-7xl flex-col gap-4 px-5 py-6 text-sm text-slate-500 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">
                    <div>
                        <p class="font-medium text-slate-700">Sistem Posyandu Buano</p>
                        <p class="mt-1">Mendukung pendataan dan pelayanan posyandu agar lebih teratur, cepat, dan mudah dipantau.</p>
                    </div>
                    <p>&copy; {{ date('Y') }} Desa Buano. Semua hak cipta dilindungi.</p>
                </div>
            </footer>
        </div>
    </body>
</html>
