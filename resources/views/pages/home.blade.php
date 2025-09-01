<x-app-layout title="Home">
    <header class="flex mx-[19px] flex-col gap-6">
        @auth
            <div class="flex justify-between">
                <div class="flex items-center gap-3 p-1 rounded-full bg-light/[.08] backdrop-blur-[48px]">
                    <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" class="object-cover object-center border-2 rounded-full w-9 h-9"
                         alt="Profile Picture" />
                    <p class="mr-2 font-medium">Hi, {{ auth()->user()->name }} 👋</p>
                </div>
                <div class="flex items-center p-[10px] rounded-full gap-3 bg-light/[.08] backdrop-blur-[48px]">
                    <img src="{{ asset('assets/icons/gift.svg') }}" alt="Gift Icon" />
                </div>
            </div>
        @endauth

        <x-banner :banners="$banners" />

        <x-search />
    </header>

    <main class="mt-8">
        <x-trending :series="$trendingSeries" />

        <x-top-choices :series="$topChoiceSeries" />

        <x-short-dramas />
    </main>

    @push('scripts')
        <script>
            const swiper = new Swiper('.mySwiper', {
                slidesPerView: 'auto',
                spaceBetween: 10,
            });
        </script>
    @endpush
</x-app-layout>
