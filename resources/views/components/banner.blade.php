<section class="relative">
    <div id="slider-hero"
         class="flex overflow-x-auto rounded-[19px] shadow-lg aspect-video snap-x snap-mandatory scroll-smooth">
        <div id="slide-hero-1" class="relative flex-shrink-0 w-full overflow-hidden snap-start">
            <img src="{{ asset('assets') }}/images/banner.png" alt="Banner Image" class="object-cover object-center w-full h-auto" />
            <div class="absolute bottom-[26px] z-10 left-[9.5px]">
                <p class="font-semibold text-[19px]">
                    Pernikahan Rahasia Bersamanya?
                </p>
                <a href="#" class="flex items-center gap-1 mt-2 p-[5px] bg-black/[37%] w-fit rounded-full">
                    <img src="{{ asset('assets') }}/icons/play.svg" alt="" />
                    <p class="mr-1">Tonton Sekarang</p>
                </a>
            </div>
        </div>
        <div id="slide-hero-2" class="relative flex-shrink-0 w-full overflow-hidden snap-start">
            <img src="{{ asset('assets') }}/images/top-choice-1.png" alt="Banner Image"
                 class="object-cover object-center w-full h-auto" />
            <div class="absolute bottom-[26px] z-10 left-[9.5px]">
                <p class="font-semibold text-[19px]">Pertarungan Abadi?</p>
                <a href="#" class="flex items-center gap-1 mt-2 p-[5px] bg-black/[37%] w-fit rounded-full">
                    <img src="{{ asset('assets') }}/icons/play.svg" alt="" />
                    <p class="mr-1">Tonton Sekarang</p>
                </a>
            </div>
        </div>
        <div id="slide-hero-3" class="relative flex-shrink-0 w-full overflow-hidden snap-start">
            <img src="{{ asset('assets') }}/images/trending-2.png" alt="Banner Image"
                 class="object-cover object-center w-full h-auto" />
            <div class="absolute bottom-[26px] z-10 left-[9.5px]">
                <p class="font-semibold text-[19px]">Drama Cina Terbaru?</p>
                <a href="#" class="flex items-center gap-1 mt-2 p-[5px] bg-black/[37%] w-fit rounded-full">
                    <img src="{{ asset('assets') }}/icons/play.svg" alt="" />
                    <p class="mr-1">Tonton Sekarang</p>
                </a>
            </div>
        </div>
    </div>
    <div id="slider-hero-nav"
         class="absolute z-10 flex gap-[2.48px] p-1 bg-[#282828]/[17%] backdrop-blur-[29px] rounded-full top-3 right-0.5">
        <button data-slide="0"
                class="h-[5px] w-[5px] bg-white transition-all duration-300 rounded-full opacity-75 hover:opacity-100 cursor-pointer"></button>
        <button data-slide="1"
                class="h-[5px] w-[5px] bg-white transition-all duration-300 rounded-full opacity-75 hover:opacity-100 cursor-pointer"></button>
        <button data-slide="2"
                class="h-[5px] w-[5px] bg-white transition-all duration-300 rounded-full opacity-75 hover:opacity-100 cursor-pointer"></button>
    </div>

    <div
        class="absolute w-full h-[135px] bg-[linear-gradient(178.6deg,_rgba(20,19,33,0)_12.03%,_#141321_92.52%)] -bottom-[5px]">
    </div>
</section>
