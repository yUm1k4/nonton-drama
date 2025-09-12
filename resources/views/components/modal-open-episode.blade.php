<div id="open-episode-element" class=" hidden justify-center">
    <div class="bg-[#13131E] rounded-t-2xl p-4 shadow-custom-top w-full fixed z-50 bottom-0">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="p-1 bg-light/[11%] backdrop-blur-sm rounded-full">
                    <img src="{{ asset('assets') }}/icons/lock.svg" alt="lock" />
                </div>
                <h2 class="font-semibold">Buka Episode {{ $episode->episode_number }}</h2>
            </div>
            <button id="close-open-episode-element">
                <img src="{{ asset('assets') }}/icons/close.svg" alt="close" />
            </button>
        </div>

        <div class="mt-4">
            <div class="flex gap-6 text-sm">
                <div class="flex items-center gap-1">
                    <span>Harga Episode</span>
                    <img src="{{ asset('assets') }}/icons/coin.svg" alt="coin" />
                    <span>{{ $episode->unlock_cost }} Koin</span>
                </div>
                <div class="flex items-center gap-1">
                    <span>Koin Kamu</span>
                    <img src="{{ asset('assets') }}/icons/coin.svg" alt="coin" />
                    <span>{{ auth()->user()->wallet->coin_balance }} Koin</span>
                </div>
            </div>

            @if(auth()->user()->wallet->coin_balance >= $episode->unlock_cost)
                <div class="py-4 flex gap-2">
                    <button id="cancel-open-episode"
                            class="flex gap-2 items-center h-fit py-3 px-16 rounded-full font-medium text-white">
                        Batal
                    </button>
                    <form action="{{ route('series.unlock', ['slug' => $series->slug, 'episodeId' => $episode->id]) }}" method="post">
                        @csrf
                        <button type="submit" id="confirm-open-episode"
                                class="flex gap-2 items-center bg-secondary h-fit py-3 px-16 rounded-full font-bold text-[#1F0E0B]">
                            Ya, Buka
                        </button>

                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
