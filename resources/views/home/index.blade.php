<x-app-layout title="Home Page">
    <!-- Home Slider -->
    <section class="hero-slider">
        <!-- Carousel wrapper -->
        <div class="hero-slides">
            <!-- Item 1 - Everyone sees this -->
            <div class="hero-slide">
                <div class="container">
                    <div class="slide-content">
                        <h1 class="hero-slider-title">
                            Beli <strong>Motor Terbagus</strong> <br />
                            Di Kota Anda
                        </h1>
                        <div class="hero-slider-content">
                            <p>
                                Pilih dari berbagai pilihan motor bekas berkualitas dengan harga terbaik. <br />
                            </p>
                            <a href="{{ route('motor.search') }}" class="btn btn-hero-slider">Cari Motor</a>
                        </div>
                    </div>
                    <div class="slide-image">
                        <img src="/img/harley25.png" alt="" class="img-responsive" />
                    </div>
                </div>
            </div>

            @auth
                @if(auth()->user()->role === 'admin')
                <!-- Item 2 - Only visible to admin -->
                <div class="hero-slide">
                    <div class="flex container">
                        <div class="slide-content">
                            <h2 class="hero-slider-title">
                                Speedzone <br />
                                <strong>Kelola Motor</strong>
                            </h2>
                            <div class="hero-slider-content">
                                <p>
                                    <br />
                                </p>
                                <a href="{{ route('motor.mylist') }}" class="btn btn-hero-slider">Kelola Motor</a>
                            </div>
                        </div>
                        <div class="slide-image">
                            <img src="/img/harley25.png" alt="" class="img-responsive" />
                        </div>
                    </div>
                </div>
                @endif
            @endauth
        </div>
    </section>

    <!-- Rest of the content -->
    <main>
        <x-search-form />
        
        @if(isset($motors))
            <section>
                <div class="container">
                    <h2>Koleksi Motor</h2>
                    <div class="car-items-listing">
                        @forelse($motors as $motor)
                            <x-car-item :motor="$motor" />
                        @empty
                            <p>Tidak ada motor yang tersedia.</p>
                        @endforelse
                    </div>
                </div>
            </section>
        @endif
    </main>

    @auth
    <div class="container flex justify-end items-center gap-3 py-3">
        <div class="flex items-center gap-3">
            {{-- NOTIF ICON --}}
            <div class="relative">
                <button id="notif-toggle" class="flex items-center gap-2 text-sm bg-transparent border-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1" />
                    </svg>
                    @php $unreadCount = auth()->user()->unreadNotifications->count(); @endphp
                    @if($unreadCount > 0)
                        <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-medium bg-red-600 text-white rounded-full">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </button>

                <div id="notif-dropdown" class="absolute right-0 mt-2 w-80 bg-white border rounded shadow-lg hidden z-50">
                    <div class="p-3 border-b flex items-center justify-between">
                        <div class="font-medium text-sm">Notifikasi</div>
                        <a href="{{ route('notifications.index') }}" class="text-sm text-blue-600">Lihat Semua</a>
                    </div>

                    <div class="max-h-64 overflow-y-auto">
                        @forelse(auth()->user()->notifications()->latest()->take(5)->get() as $n)
                            @php $data = $n->data; @endphp
                            <a href="{{ $data['url'] ?? '#' }}" class="block p-3 hover:bg-gray-50 {{ $n->read_at ? 'opacity-80' : '' }}">
                                <div class="text-sm font-medium">{{ $data['motor_title'] ?? 'Penawaran' }}</div>
                                <div class="text-xs text-gray-600">{{ ucfirst($data['status'] ?? '') }} — Rp {{ number_format($data['amount'] ?? 0,0,',','.') }}</div>
                                @if(!empty($data['message']))
                                    <div class="text-xs text-gray-500 mt-1">{{ \Illuminate\Support\Str::limit($data['message'], 80) }}</div>
                                @endif
                            </a>
                        @empty
                            <div class="p-3 text-sm text-gray-600">Belum ada notifikasi</div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- NAMA PENGGUNA --}}
            <div class="text-sm font-medium">{{ auth()->user()->name }}</div>
        </div>
    </div>

    <script>
    document.addEventListener('click', function(e){
        const toggle = document.getElementById('notif-toggle');
        const dropdown = document.getElementById('notif-dropdown');
        if (!toggle || !dropdown) return;
        if (toggle.contains(e.target)) {
            dropdown.classList.toggle('hidden');
        } else if (!dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
    </script>
    @endauth

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.hero-slide');
            let currentSlide = 0;

            function showSlide(index) {
                slides.forEach(slide => slide.style.display = 'none');
                
                if (index >= slides.length) {
                    currentSlide = 0;
                } else if (index < 0) {
                    currentSlide = slides.length - 1;
                } else {
                    currentSlide = index;
                }
                
                slides[currentSlide].style.display = 'block';
            }

            // Show first slide
            showSlide(0);

            // Add click handlers for navigation buttons
            const prevButton = document.querySelector('.hero-slide-prev');
            const nextButton = document.querySelector('.hero-slide-next');

            if (prevButton && nextButton) {
                prevButton.addEventListener('click', () => showSlide(currentSlide - 1));
                nextButton.addEventListener('click', () => showSlide(currentSlide + 1));
            }

            // Auto advance slides every 5 seconds
            setInterval(() => showSlide(currentSlide + 1), 5000);
        });
    </script>
    @endpush

    @push('styles')
    <style>
        .hero-slide {
            display: none;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .hero-slide-prev,
        .hero-slide-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.3s;
        }

        .hero-slide-prev:hover,
        .hero-slide-next:hover {
            background: rgba(255, 255, 255, 1);
        }

        .hero-slide-prev {
            left: 20px;
        }

        .hero-slide-next {
            right: 20px;
        }
    </style>
    @endpush
</x-app-layout>

