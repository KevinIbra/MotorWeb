<x-app-layout>
    <main>
        <!-- Found motors -->
        <section>
          <div class="container">
            <div class="sm:flex items-center justify-between mb-medium">
              <div class="flex items-center">
                <button class="show-filters-button flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" style="width: 20px">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
                  </svg>
                  Filters
                </button>
                <h2>Cari Kriteria Motor Kamu</h2>
              </div>
    
              <select class="sort-dropdown">
                <option value="">Pesan Berdasarkan</option>
                <option value="price">Harga Tinggi</option>
                <option value="-price">Harga Rendah</option>
              </select>
            </div>
            <div class="search-car-results-wrapper">
              <div class="search-cars-sidebar">
                <div class="card card-found-cars">
                  <p class="m-0">Ketemu <strong>{{$motors->total()}}</strong> Motor</p>
    
                  <button class="close-filters-button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 24px">
                      <path fill-rule="evenodd"
                        d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
                        clip-rule="evenodd" />
                    </svg>
                  </button>
                </div>
    
                <!-- Find a motor form -->
                <section class="find-a-car">
                  <form action="/s.html" method="GET" class="find-a-car-form card flex p-medium">
                    <div class="find-a-car-inputs">
                      <div class="form-group">
                        <label class="mb-medium">Brand</label>
                        <select id="makerSelect" name="maker_id">
                          <option value="">Brand</option>
                          <option value="4">Yamaha</option>
                          <option value="2">Kawasaki</option>
                          <option value="3">Honda</option>
                          <option value="6">Ducati</option>
                      
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="mb-medium">Model</label>
                        <select id="modelSelect" name="model_id">
                          <option value="" style="display: block">Model</option>
                          <option value="50" data-parent="5" style="display: none">
                            370Z
                          </option>
                          <option value="6" data-parent="honda" style="display: none">
                            4Runner
                          </option>
                          <option value="22" data-parent="3" style="display: none">
                            Beat
                          </option>
                        
                          <option value="23" data-parent="3" style="display: none">
                            Vario 125/160
                          </option>
                          <option value="37" data-parent="4" style="display: none">
                            NMAX
                          </option>
                       
                          <option value="21" data-parent="3" style="display: none">
                            Scoopy
                          </option>
                          <option value="36" data-parent="4" style="display: none">
                            Aerox
                          </option>
                       
                          <option value="35" data-parent="4" style="display: none">
                            Fazzio
                          </option>
                          <option value="54" data-parent="6" style="display: none">
                            Panigale V2
                          </option>
                          <option value="17" data-parent="2" style="display: none">
                            Ninja 250
                          </option>
                          <option value="32" data-parent="4" style="display: none">
                            Yamaha R25
                          </option>
                          <option value="12" data-parent="2" style="display: none">
                            Ninja ZX-25R
                          </option>
                          <option value="18" data-parent="2" style="display: none">
                            ZX-6R
                          </option>
                          <option value="13" data-parent="2" style="display: none">
                            KLX 150
                          </option>
                          <option value="11" data-parent="2" style="display: none">
                            KLX 250
                          </option>
                          <option value="28" data-parent="3" style="display: none">
                            PCX 160
                          </option>
                          <option value="20" data-parent="2" style="display: none">
                            KLX 230
                          </option>
                          <option value="47" data-parent="5" style="display: none">
                            Frontier
                          </option>
                          <option value="15" data-parent="2" style="display: none">
                            D-Tracker 150
                          </option>
                          <option value="58" data-parent="6" style="display: none">
                            Panigale V4
                          </option>
                          <option value="57" data-parent="6" style="display: none">
                            Panigale V4 SP2
                          </option>
                          <option value="26" data-parent="3" style="display: none">
                            Supra X 125
                          </option>
                        
                          <option value="56" data-parent="6" style="display: none">
                            Multistrada V2
                          </option>
                          <option value="34" data-parent="4" style="display: none">
                            XSR155
                          </option>
                          <option value="29" data-parent="3" style="display: none">
                            Sonic 150R
                          </option>
                          <option value="55" data-parent="6" style="display: none">
                            Multistrada V4
                          </option>
                          <option value="60" data-parent="6" style="display: none">
                            Streetfighter V2
                          </option>
                          <option value="33" data-parent="4" style="display: none">
                            Jupiter Z1
                          </option>
                      
                          <option value="14" data-parent="2" style="display: none">
                            Ninja H2
                          </option>
                          <option value="59" data-parent="6" style="display: none">
                            Streetfighter V4
                          </option>
                          <option value="25" data-parent="3" style="display: none">
                            CBR150R
                          </option>
                          <option value="30" data-parent="3" style="display: none">
                            CBR250RR
                          </option>
                          <option value="46" data-parent="5" style="display: none">
                            Pathfinder
                          </option>
                          <option value="24" data-parent="3" style="display: none">
                            CRF150L
                          </option>
                       
                          <option value="62" data-parent="6" style="display: none">
                            Scrambler Icon
                          </option>
                          <option value="53" data-parent="6" style="display: none">
                            Scrambler Nightshift
                          </option>
                          <option value="51" data-parent="6" style="display: none">
                            Scrambler Full Throttle
                          </option>
                          <option value="52" data-parent="6" style="display: none">
                            Scrambler 1100 Sport Pro
                          </option>
                          <option value="16" data-parent="2" style="display: none">
                            Ninja 400
                          </option>
                          <option value="27" data-parent="3" style="display: none">
                            CRF250Rally
                          </option>
                      
                       
                          <option value="31" data-parent="4" style="display: none">
                            MX King 150
                          </option>
                          <option value="40" data-parent="4" style="display: none">
                            WR155R
                          </option>
                          <option value="39" data-parent="4" style="display: none">
                            Yamaha E01
                          </option>
                          <option value="19" data-parent="2" style="display: none">
                            Z125 Pro
                          </option>
                      
                          <option value="61" data-parent="6" style="display: none">
                            Ducati Diavel V4d
                          </option>
                     
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="mb-medium">Tipe</label>
                        <select name="car_type_id">
                          <option value="">Tipe</option>
                          <option value="2">Trail</option>
                          <option value="6">Matic</option>
                          <option value="5">Sport</option>
                          <option value="4">ATV</option>
                        
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="mb-medium">Tahun</label>
                        <div class="flex gap-1">
                          <input type="number" placeholder="Tahun Masuk" name="year_from" />
                          <input type="number" placeholder="Tahun Keluar" name="year_to" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="mb-medium">Harga</label>
                        <div class="flex gap-1">
                          <input type="number" placeholder="Harga Sebelum" name="price_from" />
                          <input type="number" placeholder="Harga Sesudah" name="price_to" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="mb-medium">Kilometer</label>
                        <div class="flex gap-1">
                          <select name="mileage">
                            <option value="">Kilometer</option>
                            <option value="10000">10,000 or less</option>
                            <option value="20000">20,000 or less</option>
                            <option value="30000">30,000 or less</option>
                            <option value="40000">40,000 or less</option>
                            <option value="50000">50,000 or less</option>
                            <option value="60000">60,000 or less</option>
                            <option value="70000">70,000 or less</option>
                            <option value="80000">80,000 or less</option>
                            <option value="90000">90,000 or less</option>
                            <option value="100000">100,000 or less</option>
                            <option value="150000">150,000 or less</option>
                            <option value="200000">200,000 or less</option>
                            <option value="250000">250,000 or less</option>
                            <option value="300000">300,000 or less</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="mb-medium">Provinsi</label>
                        <select id="stateSelect" name="state_id">
                          <option value="">Provinsi</option>
                          <option value="1">Jawa Barat</option>
                          <option value="2">Jawa Timur</option>
                         
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="mb-medium">Kota</label>
                        <select id="citySelect" name="city_id">
                          <option value="" style="display: block">Kota</option>
                          <option value="3" data-parent="1" style="display: none">
                            Tasikmalaya
                          </option>
                          <option value="8" data-parent="1" style="display: none">
                            Bandung
                          </option>
                          <option value="14" data-parent="2" style="display: none">
                            Malang
                          </option>
                          <option value="13" data-parent="2" style="display: none">
                            Surabaya
                         
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="mb-medium">Tipe Bensin</label>
                        <select name="fuel_type_id">
                          <option value="">Tipe Bensin</option>
                          <option value="1">Pertalite</option>
                          <option value="1">Pertamax</option>
                          <option value="1">Solar</option>
                          
                        </select>
                      </div>
                    </div>
                    <div class="flex">
                      <button type="button" class="btn btn-find-a-car-reset" >
                        Reset
                      </button>
                      <button class="btn btn-primary btn-find-a-car-submit">
                        Cari
                      </button>
                    </div>
                  </form>
                </section>
                <!--/ Find a motor form -->
              </div>
    
              <div class="search-cars-results">
                <div class="car-items-listing">
                  @foreach ( $motors as $motor)
              
                  <x-car-item :$motor/>
                
              @endforeach
                  </div>
                  {{$motors->links()}}
                </div>
              
              </div>
            </div>
          </div>
        </section>
        <!--/ Found Cars -->
      </main>
    
    </x-app-layout>
