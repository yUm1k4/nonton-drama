<x-auth-layout :title="'Login'">
    <div class="mb-[26px]">
        <h1 class="text-2xl font-bold">Login</h1>
        <p class="mt-2">Siap Lanjut Maraton Series? Masuk Dulu Yuk!</p>

        <form class="mt-8" action="{{ route('login.store') }}" method="POST">
            @csrf
            <div class="mt-5">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="Masukkan email"
                       class="bg-input/[.09] w-full p-[18px] focus:outline-none backdrop-blur-xl rounded-full mt-2" />
                @error('email')
                    <p class="mt-1 text-xs">{{ $message }}</p
                @enderror
            </div>
            <div class="mt-5">
                <label for="password">Password</label>
                <div class="relative mt-2">
                    <input id="password" name="password" type="password" placeholder="Masukkan kata sandi"
                           class="bg-input/[.09] w-full p-[18px] focus:outline-none backdrop-blur-xl rounded-full" />
                    <img src="{{ asset('assets') }}/icons/eye-slash.svg" alt="eye-slash-icon"
                         class="absolute -translate-y-1/2 cursor-pointer top-1/2 right-5" />
                    @error('password')
                        <p class="mt-1 text-xs">{{ $message }}</p
                    @enderror
                </div>
            </div>
            <button type="submit"
                    class="font-bold text-[#1F0E0B] bg-secondary w-full py-[14px] rounded-full mt-6 cursor-pointer">
                Masuk
            </button>
        </form>

        <p class="mt-8 text-xs text-center">
            Belum punya akun?
            <a href="{{ route('register') }}" class="underline text-secondary">Daftar di sini.</a>
        </p>
    </div>
</x-auth-layout>
