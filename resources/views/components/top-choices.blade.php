<section id="top-choices" class="mt-2 mx-[19px]">
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-medium">Pilihan Teratas</h2>
        <a href="#" class="text-xs text-secondary">Lihat lebih banyak</a>
    </div>

    <!-- Slider Top Choice -->
    <div class="grid grid-cols-2 gap-2">
        @foreach($series as $item)
            <a href="/detail/{{ $item->id }}" class="p-3 bg-light/[.04] rounded-2xl">
                <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}"
                     class="object-cover w-full h-[203px] object-center rounded-lg" />
                <p class="mt-2">{{ Str::limit($item->title, 25) }}</p>
            </a>
        @endforeach
    </div>
</section>
