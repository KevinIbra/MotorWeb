<x-app-layout title="Home Page">
        
   
<!-- Home Slider -->
        <section class="hero-slider">
            <!-- Carousel wrapper -->
            <div class="hero-slides">
              <!-- Item 1 -->
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
      
                      <button class="btn btn-hero-slider">Cari Motor</button>
                    </div>
                  </div>
                  <div class="slide-image">
                    <img src="/img/harley25.png" alt="" class="img-responsive" />
                  </div>
                </div>
              </div>
              <!-- Item 2 -->
              <div class="hero-slide">
                <div class="flex container">
                  <div class="slide-content">
                    <h2 class="hero-slider-title">
                      Kamu Mau <br />
                      <strong>Menjual Motor?</strong>
                    </h2>
                    <div class="hero-slider-content">
                      <p>
                        Iklankan motor Anda dengan mudah dan cepat. Jangkau pembeli di seluruh kota.<br />
                      </p>
      
                      <button class="btn btn-hero-slider">Tambah Motor</button>
                    </div>
                  </div>
                  <div class="slide-image">
                    <img src="/img/harley25.png" alt="" class="img-responsive" />
                  </div>
                </div>
              </div>
              <button type="button" class="hero-slide-prev">
                <svg
                  style="width: 18px"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 6 10"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 1 1 5l4 4"
                  />
                </svg>
                <span class="sr-only">Previous</span>
              </button>
              <button type="button" class="hero-slide-next">
                <svg
                  style="width: 18px"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 6 10"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 9 4-4-4-4"
                  />
                </svg>
                <span class="sr-only">Next</span>
              </button>
            </div>
          </section>
          <!--/ Home Slider -->



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
            
         

</x-app-layout>

