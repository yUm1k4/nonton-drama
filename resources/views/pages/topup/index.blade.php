<x-app-layout title="Top Up" :show-navbar="false">
    <div class="mx-[19px] pt-[39px]">
        <div class="flex items-center justify-between">
            <div class="flex-shrink-0">
                <a href="{{ url()->previous() }}" class="block p-[7px] bg-light/[8%] rounded-full backdrop-blur-[48px]">
                    <img src="{{ asset('assets') }}/icons/back.svg" alt="back-icon" />
                </a>
            </div>
            <span class="font-semibold tracking-[-0.41px] absolute left-1/2 transform -translate-x-1/2">Top Up Koin</span>
        </div>

        <form class="mt-[42px] grid grid-cols-3 gap-2" action="{{ route('topup.store') }}" method="POST">
            @csrf
            @foreach($coinPackages as $coinPackage)
                <div>
                    <input type="radio" id="coin-{{ $coinPackage->id }}" name="coin_package"
                           value="{{ $coinPackage->id }}" class="hidden peer" required />
                    <label for="coin-{{ $coinPackage->id }}"
                           class="bg-light/[9%] backdrop-blur-[48px] py-4 px-2 flex items-center justify-center rounded-[4px] flex-col gap-1 cursor-pointer border-2 border-transparent peer-checked:border-[#FBB105] peer-checked:border-2">
                        <div class="flex items-center gap-1 text-xs">
                            <img src="{{ asset('assets') }}/icons/coin.svg" alt="coin" />
                            <span class="text-[#FBB105]">
                                {{ $coinPackage->coin_amount }} Koin
                                @if($coinPackage->bonus_amount > 0)
                                    + {{ $coinPackage->bonus_amount }} Bonus
                                @endif
                            </span>
                        </div>
                        <span class="font-semibold text-xs">
                            Rp {{ number_format($coinPackage->price, 0, ',', '.') }}
                        </span>
                    </label>
                </div>
            @endforeach

            <div class="flex justify-center col-span-3 mt-4">
                <button type="submit"
                        class="w-full flex justify-center bg-secondary py-3 rounded-full font-bold text-[#1F0E0B]">Top Up</button>
            </div>
        </form>

        <!-- Background Section -->
        <div class="w-[139px] h-[139px] top-0 -right-[32px] rounded-full bg-[#30009B]/50 blur-3xl absolute"></div>

        <div class="w-[139px] h-[139px] bottom-[98px] -left-[37px] rounded-full bg-[#30009B]/50 blur-3xl absolute"></div>
    </div>

    @pushonce('scripts')
        <script src="{{ asset('assets/js/topup.js') }}"></script>
    @endpushonce
</x-app-layout>
