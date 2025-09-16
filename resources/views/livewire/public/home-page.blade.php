<div>
    <section 
        class="relative h-[60vh] md:h-[90vh] overflow-hidden"
        x-data="{ 
            activeSlide: 1,
            slides: {{ $sliders->count() }},
            autoplay: null,
            init() {
                this.autoplay = setInterval(() => {
                    this.activeSlide = this.activeSlide === this.slides ? 1 : this.activeSlide + 1;
                }, 5000);
            },
            destroy() {
                clearInterval(this.autoplay);
            }
        }"
        x-init="init()"
        x-on:mouseenter="destroy()"
        x-on:mouseleave="init()"
    >
        @foreach($sliders as $index => $slider)
        <div 
            x-show="activeSlide === {{ $index + 1 }}"
            x-transition:enter="transition ease-in-out duration-1000"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-1000"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0 bg-cover bg-center" 
            style="background-image: url('{{ $slider->image_url }}');"
        >
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="relative z-10 h-full flex items-center justify-center">
                <div class="container mx-auto px-6 text-center text-white">
                    @if($slider->title)
                        <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight">{{ $slider->title }}</h1>
                    @endif
                    @if($slider->subtitle)
                        <p class="text-lg md:text-xl mb-8">{{ $slider->subtitle }}</p>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

        <div class="absolute bottom-5 left-1/2 -translate-x-1/2 z-10 flex space-x-3">
            @foreach($sliders as $index => $slider)
            <button 
                @click="activeSlide = {{ $index + 1 }}; destroy(); init();"
                :class="{ 'bg-white': activeSlide === {{ $index + 1 }}, 'bg-white/50': activeSlide !== {{ $index + 1 }} }"
                class="w-3 h-3 rounded-full hover:bg-white transition"
            ></button>
            @endforeach
        </div>
    </section>

    <section id="produk-unggulan" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Produk Unggulan Kami</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($featuredProducts as $product)
                    {{-- Kartu produk sekarang menjadi link dan punya efek bayangan yang lebih baik --}}
                    <a href="#" class="block bg-white rounded-lg shadow-lg overflow-hidden group">
                        <div class="overflow-hidden">
                            {{-- Gambar akan zoom sedikit saat di-hover --}}
                            <img src="/public/images/layanan-penyewaan.jpg" alt="{{ $product->name }}" class="w-full h-56 object-cover transform group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="p-6">
                            <span class="text-xs font-semibold {{ $product->type == 'dijual' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }} px-3 py-1 rounded-full">
                                {{ ucfirst($product->type) }}
                            </span>
                            <h3 class="text-xl font-semibold my-2">{{ $product->name }}</h3>
                            <p class="text-gray-800 font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-center col-span-3 text-gray-500">Produk unggulan akan segera ditampilkan.</p>
                @endforelse
            </div>
            
            <div class="text-center mt-12">
                <a href="/katalog" class="text-blue-500 font-semibold hover:underline text-lg">
                    Lihat Semua Katalog &rarr;
                </a>
            </div>
        </div>
    </section>

    <section class="bg-blue-600 text-white">
        <div class="container mx-auto px-6 py-20 text-center">
            <h2 class="text-3xl font-bold mb-4">Siap Melengkapi Kebutuhan Pasukan Anda?</h2>
            <p class="mb-8 max-w-2xl mx-auto">Konsultasikan kebutuhan Anda atau langsung lakukan pemesanan melalui WhatsApp untuk respon cepat dan pelayanan terbaik.</p>
            <a href="https://wa.me/6285880084403?text=Halo%20APC,%20saya%20mau%20bertanya%20tentang%20atribut%20Paskibra." target="_blank" class="bg-white text-blue-600 font-bold py-4 px-10 rounded-full hover:bg-gray-100 transition duration-300 text-lg inline-flex items-center">
                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.894 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.433-9.894-9.896-9.895-5.459 0-9.885 4.437-9.885 9.896 0 2.095.59 4.14 1.734 5.945l.176.308-1.021 3.726 3.775-1.002.289.173zm11.332-5.462c-.225-.444-.438-1.012-.75-1.012-.232 0-.666.232-.888.512-.132.18-.225.312-.555.75-.444.6-1.098 1.012-1.098 1.012s-.225.094-.666-.094c-1.518-.666-2.925-1.74-2.925-1.74s-.225-.188-.132-.468c.094-.282.225-.375.313-.468.188-.188.282-.375.282-.375s.094-.188-.094-.468c-.188-.282-1.098-1.407-1.098-1.407s-.188-.188-.469-.188c-.281 0-.469.094-.469.094s-.469.188-.469.844c0 .666.469 1.609.469 1.609s1.098 1.609 2.52 2.344c.468.281.844.469 1.281.469.188 0 .281.094.666-.281.281-.281.281-.938.281-.938s.094-.188.281-.375c.188-.188.469-.281.469-.281s.281-.094.666.094c.375.188.938.844.938.844s.094.188.094.281-.094.469-.188.552z"/></svg>
                Hubungi via WhatsApp
            </a>
        </div>
    </section>
</div>