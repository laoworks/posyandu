<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Panel Orang Tua') - {{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body x-data="{ sidebarOpen: false }" class="h-screen overflow-hidden font-sans antialiased">
        <div class="h-screen bg-[#f8f9fc]">
            <div class="flex h-full">
                <div
                    x-cloak
                    x-show="sidebarOpen"
                    x-transition.opacity
                    @click="sidebarOpen = false"
                    class="fixed inset-0 z-30 bg-slate-900/40 lg:hidden"
                ></div>

                @include('layouts.partials.orangtua-sidebar')

                <div class="flex h-screen flex-1 flex-col overflow-hidden">
                    <header class="border-b border-slate-200 bg-white px-6 py-4 sm:px-8">
                        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                            <div class="flex items-start gap-3">
                                <button
                                    type="button"
                                    @click="sidebarOpen = true"
                                    class="inline-flex h-10 w-10 items-center justify-center border border-slate-300 text-slate-600 transition hover:border-[#3f37c9] hover:text-[#3f37c9] lg:hidden"
                                >
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M3 6h18" />
                                        <path d="M3 12h18" />
                                        <path d="M3 18h18" />
                                    </svg>
                                </button>

                                <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-[#3f37c9]">Halaman Orang Tua</p>
                                <h2 class="mt-1 text-[28px] font-semibold text-slate-800">@yield('page-title', 'Dashboard Orang Tua')</h2>
                                <p class="mt-1 text-sm text-slate-500">@yield('page-description', 'Lihat data anak, jadwal posyandu, dan riwayat layanan kesehatan.')</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="hidden text-right sm:block">
                                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-slate-400">Login Sebagai</p>
                                    <p class="mt-1 text-sm font-medium text-slate-700">{{ auth()->user()->name ?? 'Orang Tua' }}</p>
                                </div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="inline-flex items-center gap-2 rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:border-[#3f37c9] hover:text-[#3f37c9]"
                                    >
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                            <path d="m16 17 5-5-5-5" />
                                            <path d="M21 12H9" />
                                        </svg>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </header>

                    <main class="flex-1 overflow-y-auto px-6 py-7 sm:px-8">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>
