@php
    $menuItems = [
        [
            'label' => 'Dashboard',
            'route' => route('orangtua.dashboard'),
            'active' => request()->routeIs('orangtua.dashboard'),
            'icon' => 'dashboard',
        ],
        [
            'label' => 'Data Anak',
            'route' => route('orangtua.anak.index'),
            'active' => request()->routeIs('orangtua.anak.*'),
            'icon' => 'child',
        ],
        [
            'label' => 'Riwayat Imunisasi',
            'route' => route('orangtua.imunisasi.index'),
            'active' => request()->routeIs('orangtua.imunisasi.*'),
            'icon' => 'shield',
        ],
        [
            'label' => 'Riwayat Penimbangan',
            'route' => route('orangtua.penimbangan.index'),
            'active' => request()->routeIs('orangtua.penimbangan.*'),
            'icon' => 'chart',
        ],
        [
            'label' => 'Jadwal Posyandu',
            'route' => route('orangtua.jadwal.index'),
            'active' => request()->routeIs('orangtua.jadwal.*'),
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
                <path d="M9 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                <path d="M18 9a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                <path d="M3 20a6 6 0 0 1 12 0" />
                <path d="M15 20a5 5 0 0 1 6 0" />
            </svg>
        </div>
        <div>
            <p class="text-[11px] font-semibold uppercase tracking-[0.24em] text-[#3f37c9]">Orang Tua</p>
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
                        @elseif ($item['icon'] === 'child')
                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="6" r="3" />
                                <path d="M16 20v-5l2-2" />
                                <path d="M8 20v-5l-2-2" />
                                <path d="M10 10l2 2 2-2" />
                                <path d="M12 12v8" />
                            </svg>
                        @elseif ($item['icon'] === 'shield')
                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M12 3l7 4v5c0 5-3.5 8-7 9-3.5-1-7-4-7-9V7l7-4Z" />
                                <path d="m9.5 12 1.5 1.5 3.5-4" />
                            </svg>
                        @elseif ($item['icon'] === 'chart')
                            <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M3 3v18h18" />
                                <path d="m7 14 4-4 3 3 5-7" />
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
            <p class="mt-2 text-sm font-medium text-slate-700">{{ auth()->user()->name ?? 'Orang Tua' }}</p>
            <p class="mt-1 text-sm text-slate-500">Melihat jadwal dan perkembangan anak.</p>
        </div>
    </div>
</aside>
