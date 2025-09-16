<div>
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
                
                <div>
                    <img src="{{ asset($product->image_url) ?? 'https://via.placeholder.com/600x600' }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg shadow-lg">
                </div>

                <div>
                    <span class="text-xs font-semibold {{ $product->type == 'dijual' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }} px-3 py-1 rounded-full">
                        {{ ucfirst($product->type) }}
                    </span>

                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mt-4 mb-2">{{ $product->name }}</h1>
                    
                    <p class="text-gray-800 font-bold text-3xl mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Deskripsi Produk</h2>
                    <div class="text-gray-600 leading-relaxed">
                        {!! nl2br(e($product->description)) !!}
                    </div>

                    {{-- Tombol Aksi Utama: Pesan via WhatsApp --}}
                    <div class="mt-8">
                        @php
                            $message = "Halo APC, saya tertarik dengan produk '" . urlencode($product->name) . "'. Mohon informasinya.";
                        @endphp
                        <a href="https://wa.me/6285880084403?text={{ $message }}" 
                           target="_blank" 
                           class="w-full bg-green-500 text-white font-bold py-4 px-8 rounded-lg hover:bg-green-600 transition duration-300 text-lg inline-flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.894 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.433-9.894-9.896-9.895-5.459 0-9.885 4.437-9.885 9.896 0 2.095.59 4.14 1.734 5.945l.176.308-1.021 3.726 3.775-1.002.289.173zm11.332-5.462c-.225-.444-.438-1.012-.75-1.012-.232 0-.666.232-.888.512-.132.18-.225.312-.555.75-.444.6-1.098 1.012-1.098 1.012s-.225.094-.666-.094c-1.518-.666-2.925-1.74-2.925-1.74s-.225-.188-.132-.468c.094-.282.225-.375.313-.468.188-.188.282-.375.282-.375s.094-.188-.094-.468c-.188-.282-1.098-1.407-1.098-1.407s-.188-.188-.469-.188c-.281 0-.469.094-.469.094s-.469.188-.469.844c0 .666.469 1.609.469 1.609s1.098 1.609 2.52 2.344c.468.281.844.469 1.281.469.188 0 .281.094.666-.281.281-.281.281-.938.281-.938s.094-.188.281-.375c.188-.188.469-.281.469-.281s.281-.094.666.094c.375.188.938.844.938.844s.094.188.094.281-.094.469-.188.552z"/></svg>
                            Pesan via WhatsApp
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>