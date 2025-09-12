<div id="list-episode-element" class="flex justify-center">
    <div class="bg-[#13131E] rounded-t-2xl p-4 shadow-custom-top w-full fixed z-40 bottom-0">
        <div class="">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl tracking-[-0.41px] font-semibold">
                    {{ $series->title }}
                </h2>
                <button id="close-list-episode-element">
                    <img src="{{ asset('assets') }}/icons/close.svg" alt="close" />
                </button>
            </div>

            <div class="mt-4">
                <p class="font-medium">Daftar Episode</p>
                <div class="mt-5 gap-[14px] flex flex-wrap">

                    @foreach($episodes as $episode)
                        @if($episode->is_unlocked_for_user)
                            <a href="{{ route('series.play', ['slug' => $series->slug, 'episodeId' => $episode->id]) }}"
                               class="unlock-drama w-12 h-12 bg-light/[11%] flex items-center justify-center rounded-lg">
                                <span>{{ $episode->episode_number }}</span>
                            </a>
                        @else
                            <a href="{{ route('series.play', ['slug' => $series->slug, 'episodeId' => $episode->id]) }}"
                               class="lock-drama drama w-12 h-12 bg-secondary/[12%] hover:bg-secondary hover:text-[#1F0E0B] flex items-center justify-center rounded-lg relative">
                                <span>{{ $episode->episode_number }}</span>
                                <div class="p-1 bg-light/[11%] backdrop-blur-sm rounded-full absolute -top-1 -right-1">
                                    <img src="{{ asset('assets') }}/icons/lock.svg" alt="lock" />
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
