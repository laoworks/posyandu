@php
    $menuItems = [
        [
            'label' => 'Dashboard',
            'route' => route('bidan.dashboard'),
            'active' => request()->routeIs('bidan.dashboard'),
            'icon' => 'dashboard',
        ],
        [
            'label' => 'Data Balita',
            'route' => route('bidan.balita.index'),
            'active' => request()->routeIs('bidan.balita.*'),
            'icon' => 'users',
        ],
        [
            'label' => 'Penimbangan',
            'route' => route('bidan.penimbangan.index'),
            'active' => request()->routeIs('bidan.penimbangan.*'),
            'icon' => 'chart',
        ],
        [
            'label' => 'Imunisasi',
            'route' => route('bidan.imunisasi.index'),
            'active' => request()->routeIs('bidan.imunisasi.*'),
            'icon' => 'shield',
        ],
        [
            'label' => 'Jadwal Posyandu',
            'route' => route('bidan.jadwal-posyandu.index'),
            'active' => request()->routeIs('bidan.jadwal-posyandu.*'),
            'icon' => 'calendar',
        ],
    ];
@endphp

<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-40 flex w-64 shrink-0 transform flex-col border-r border-slate-200 bg-white transition duration-300 ease-in-out lg:static lg:w-60 lg:translate-x-0"
>
    <div class="flex h-16 items-center gap-3 border-b border-slate-200 px-5">
        <div class="flex h-10 w-10 items-center justify-center rounded-xl border border-[#3f37c9]/20 text-[#3f37c9]">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M4 19h16" />
                <path d="M9 19V8" />
                <path d="M15 19v-4" />
                <path d="M12 5h0" />
                <path d="M12 3v4" />
                <path d="M10 5h4" />
            </svg>
        </div>
        <div>
            <p class="text-[11px] font-semibold uppercase tracking-[0.24em] text-[#3f37c9]">Bidan Desa</p>
            <h1 class="text-sm font-semibold text-slate-800">Sistem Posyandu</h1>
        </div>

        <button
            type="button"
            @click="sidebarOpen = false"
            class="ml-auto inline-flex h-9 w-9 items-center justify-center border border-slate-300 text-slate-500 transition hover:border-[#3f37c9] hover:text-[#3f37c9] lg:hidden"
        >
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="m18 6-12 12" />
                <path d="m6 6 12 12" />
            </svg>
        </button>
    </div>

    <div class="flex flex-1 flex-col justify-between px-4 py-5">
        <nav class="space-y-1">
            @foreach ($menuItems as $item)
                <a
                    href="{{ $item['route'] }}"
                    class="{{ $item['active'] ? 'border-l-2 border-[#3f37c9] pl-3 text-[#3f37c9]' : 'border-l-2 border-transparent pl-3 text-slate-500 hover:text-slate-800' }} flex items-center gap-3 py-2.5 pr-2 text-[15px] font-medium transition"
                >
                    <span class="{{ $item['active'] ? 'text-[#3f37c9]' : 'text-slate-400' }} flex h-5 w-5 items-center justify-center">
                        @if ($item['icon'] === 'dashboard')
                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="3" y="3" width="8" height="8" rx="2" />
                                <rect x="13" y="3" width="8" height="5" rx="2" />
                                <rect x="13" y="10" width="8" height="11" rx="2" />
                                <rect x="3" y="13" width="8" height="8" rx="2" />
                            </svg>
                        @elseif ($item['icon'] === 'users')
                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2" />
                                <circle cx="9.5" cy="7" r="4" />
                                <path d="M20 8v6" />
                                <path d="M23 11h-6" />
                            </svg>
                        @elseif ($item['icon'] === 'stethoscope')
                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M6 3v6a6 6 0 0 0 12 0V3" />
                                <path d="M6 3H4" />
                                <path d="M20 3h-2" />
                                <path d="M12 15v2a4 4 0 0 0 8 0v-1a2 2 0 1 0-4 0v1" />
                            </svg>
                        @elseif ($item['icon'] === 'chart')
                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M3 3v18h18" />
                                <path d="m7 14 4-4 3 3 5-7" />
                            </svg>
                        @elseif ($item['icon'] === 'shield')
                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M12 3l7 4v5c0 5-3.5 8-7 9-3.5-1-7-4-7-9V7l7-4Z" />
                                <path d="m9.5 12 1.5 1.5 3.5-4" />
                            </svg>
                        @else
                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="3" y="5" width="18" height="16" rx="2" />
                                <path d="M16 3v4" />
                                <path d="M8 3v4" />
                                <path d="M3 11h18" />
                            </svg>
                        @endif
                    </span>
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="border-t border-slate-200 pt-4">
            <p class="text-xs uppercase tracking-[0.24em] text-slate-400">Akun</p>
            <p class="mt-2 text-sm font-medium text-slate-700">{{ auth()->user()->name ?? 'Bidan Desa' }}</p>
            <p class="mt-1 text-sm text-slate-500">Memantau pelayanan dan pemeriksaan harian.</p>
        </div>
    </div>
</aside>
