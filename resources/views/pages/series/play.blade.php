<x-app-layout :title="'Play'" :show-navbar="false">
    <!-- Canvas for blurred background -->
    <canvas id="blur-canvas" class="absolute h-full w-full"></canvas>

    <!-- Main Video -->
    <video id="video-trigger" src="{{ route('series.stream', ['episodeId' => $episode->id]) }}" class="absolute object-contain" loop autoplay playsinline crossorigin="anonymous"></video>

    <!-- Header Controls -->
    <div class="absolute top-[38px] right-4 left-4 z-20 flex items-center gap-3">
        <a href="{{ route('series.show', $series->slug) }}" class="block p-[7px] bg-black/[15%] rounded-full backdrop-blur-[48px] w-fit">
            <img src="{{ asset('assets') }}/icons/back.svg" class="w-8 h-8" alt="back-icon" />
        </a>

        <h1 class="font-semibold tracking-[-0.41px]">{{ $episode->title }}</h1>
    </div>

    <!-- Play/Pause Button -->
    <button id="video-play-button"
            class="absolute invisible top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-30 hover:animate-pulse transition-opacity duration-300">
        <img src="{{ asset('assets') }}/icons/play.svg" alt="play-icon" class="w-[53px] h-[53px]" />
    </button>

    <!-- Action Button -->
    <div class="flex flex-col gap-4 right-4 top-1/2 -translate-y-1/2 z-30 absolute">
        <button id="list-episode"
                class="bg-black/[9%] p-3 rounded-full hover:animate-pulse transition-opacity duration-300">
            <img src="{{ asset('assets') }}/icons/list-episode.svg" alt="list-episode" class="w-8 h-8" />
        </button>
        <button class="bg-black/[9%] p-3 rounded-full hover:animate-pulse transition-opacity duration-300">
            <!-- <img src="{{ asset('assets') }}/icons/bookmark.svg" alt="bookmark" class="w-8 h-8" /> -->
            <img src="{{ asset('assets') }}/icons/bookmark-active.svg" alt="bookmark" class="w-8 h-8" />
        </button>
    </div>

    <!-- Video Progress Bar -->
    <div class="flex justify-center">
        <div class="flex fixed w-[355px] items-center gap-[6px] bottom-9">
            <div class="flex-1 relative">
                <div class="h-[6px] bg-white/20 rounded-full overflow-hidden">
                    <div id="progress-bar" class="h-full bg-secondary transition-all duration-150 ease-out" style="width: 0%">
                    </div>
                </div>
                <input type="range" id="progress-input" min="0" max="100" value="0"
                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
            </div>
            <div class="flex items-center gap-1">
                <span id="current-time" class="text-xs tracking-[-0.41px] font-medium text-white">00:00</span>
                <span class="text-xs tracking-[-0.41px] font-medium text-white">/</span>
                <span id="duration-time" class="text-xs tracking-[-0.41px] font-medium text-white">00:00</span>
            </div>
        </div>
    </div>
</x-app-layout>
