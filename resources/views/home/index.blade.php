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

