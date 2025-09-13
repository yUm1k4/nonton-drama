<x-app-layout title="Top Up Sukses">
    <div class="h-screen w-full px-9 flex flex-col items-center justify-center">
        <div class="bg-[#FBDA0514] p-4 rounded-full">
            <img src="{{ asset('assets') }}/icons/success.svg" alt="success-icon" />
        </div>
        <div class="flex flex-col items-center gap-3 mt-4">
            <span class="font-medium text-2xl">Success!</span>
            <span class="font-semibold text-2xl tracking-[-0.41px]">Top Up Koin Berhasil</span>
        </div>

        <a href="{{ session('after_payment_action.url') }}"
           class="flex gap-2 mt-[34px] justify-center items-center bg-secondary py-3 rounded-full">
            <div class="p-1 rounded-full flex-shrink-0 bg-[#1F0E0B]/[6%] backdrop-blur-sm">
                @if(session('after_payment_action.icon'))
                    <img src="{{ asset('assets') }}/icons/wallet.svg" class="" alt="Wallet icon" />
                @endif
            </div>
            <span class="font-bold text-[#1F0E0B]">{{ session('after_payment_action.text') }}</span>
        </a>
    </div>
    <!-- Background Section -->
    <div class="w-[139px] h-[139px] top-[50px] -right-[69px] rounded-full bg-[#30009B]/50 blur-3xl absolute"></div>
</x-app-layout>
