<x-guest-layout>
    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[#3f37c9]">Masuk Akun</p>
        <h1 class="mt-3 text-2xl font-semibold text-slate-800">Selamat datang kembali</h1>
        <p class="mt-2 text-sm leading-7 text-slate-500">
            Masuk untuk melanjutkan pengelolaan layanan posyandu sesuai akses Anda sebagai kader posyandu, bidan desa, atau orang tua.
        </p>
    </div>

    <x-auth-session-status class="mt-4 border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="'Email'" />
            <x-text-input
                id="email"
                class="mt-2 block w-full border-slate-300 px-4 py-2.5 text-sm shadow-none focus:border-[#3f37c9] focus:ring-[#3f37c9]/20"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="masukkan email Anda"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between gap-3">
                <x-input-label for="password" :value="'Password'" />
                @if (Route::has('password.request'))
                    <a
                        class="text-sm font-medium text-[#3f37c9] transition hover:text-[#352ead]"
                        href="{{ route('password.request') }}"
                    >
                        Lupa password?
                    </a>
                @endif
            </div>
            <x-text-input
                id="password"
                class="mt-2 block w-full border-slate-300 px-4 py-2.5 text-sm shadow-none focus:border-[#3f37c9] focus:ring-[#3f37c9]/20"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="masukkan password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between gap-3">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-slate-300 text-[#3f37c9] shadow-sm focus:ring-[#3f37c9]/20"
                    name="remember"
                >
                <span class="ms-2 text-sm text-slate-600">Ingat saya</span>
            </label>

            <a href="{{ url('/') }}" class="text-sm text-slate-500 transition hover:text-slate-700">
                Kembali ke beranda
            </a>
        </div>

        <div class="border border-slate-200 bg-slate-50 p-4 text-sm text-slate-600">
            <p class="font-medium text-slate-700">Akses sistem</p>
            <p class="mt-1 leading-6">Akun akan otomatis diarahkan ke dashboard sesuai role yang terpasang pada user Anda.</p>
        </div>

        <div class="space-y-4">
            <x-primary-button class="flex w-full items-center justify-center border border-[#3f37c9] bg-[#3f37c9] px-4 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-[#352ead] focus:bg-[#352ead] focus:ring-[#3f37c9]/20 active:bg-[#352ead]">
                Masuk
            </x-primary-button>

            @if (Route::has('register'))
                <p class="text-center text-sm text-slate-500">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-medium text-[#3f37c9] transition hover:text-[#352ead]">
                        Daftar sebagai orang tua
                    </a>
                </p>
            @endif
        </div>
    </form>
</x-guest-layout>
