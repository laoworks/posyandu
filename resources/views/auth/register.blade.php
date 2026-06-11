<x-guest-layout>
    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[#3f37c9]">Pendaftaran</p>
        <h1 class="mt-3 text-2xl font-semibold text-slate-800">Buat akun orang tua</h1>
        <p class="mt-2 text-sm leading-7 text-slate-500">
            Pendaftaran mandiri diperuntukkan bagi orang tua. Setelah berhasil, akun akan langsung masuk ke dashboard orang tua.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="'Nama Lengkap'" />
            <x-text-input
                id="name"
                class="mt-2 block w-full border-slate-300 px-4 py-2.5 text-sm shadow-none focus:border-[#3f37c9] focus:ring-[#3f37c9]/20"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
                placeholder="masukkan nama lengkap"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="'Email'" />
            <x-text-input
                id="email"
                class="mt-2 block w-full border-slate-300 px-4 py-2.5 text-sm shadow-none focus:border-[#3f37c9] focus:ring-[#3f37c9]/20"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
                placeholder="masukkan email aktif"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="'Password'" />
            <x-text-input
                id="password"
                class="mt-2 block w-full border-slate-300 px-4 py-2.5 text-sm shadow-none focus:border-[#3f37c9] focus:ring-[#3f37c9]/20"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="buat password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="'Konfirmasi Password'" />
            <x-text-input
                id="password_confirmation"
                class="mt-2 block w-full border-slate-300 px-4 py-2.5 text-sm shadow-none focus:border-[#3f37c9] focus:ring-[#3f37c9]/20"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="ulangi password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="border border-slate-200 bg-slate-50 p-4 text-sm text-slate-600">
            <p class="font-medium text-slate-700">Catatan pendaftaran</p>
            <p class="mt-1 leading-6">Akun baru otomatis mendapat role <span class="font-medium text-slate-800">Orang Tua</span> dan tidak dipakai untuk akses kader atau bidan desa.</p>
        </div>

        <div class="space-y-4">
            <x-primary-button class="flex w-full items-center justify-center border border-[#3f37c9] bg-[#3f37c9] px-4 py-3 text-sm font-medium text-white shadow-sm transition hover:bg-[#352ead] focus:bg-[#352ead] focus:ring-[#3f37c9]/20 active:bg-[#352ead]">
                Daftar Sekarang
            </x-primary-button>

            <p class="text-center text-sm text-slate-500">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-medium text-[#3f37c9] transition hover:text-[#352ead]">
                    Masuk di sini
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
