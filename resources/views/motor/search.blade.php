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
    
              <select class="sort-dropdown" onchange="window.location.href=this.value">
                <option value="{{ request()->fullUrlWithQuery(['sort' => '']) }}" {{ !request('sort') ? 'selected' : '' }}>
                    Pesan Berdasarkan
                </option>
                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price']) }}" {{ request('sort') == 'price' ? 'selected' : '' }}>
                    Harga Tinggi
                </option>
                <option value="{{ request()->fullUrlWithQuery(['sort' => '-price']) }}" {{ request('sort') == '-price' ? 'selected' : '' }}>
                    Harga Rendah
                </option>
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
                  <form action="{{ route('motor.search') }}" method="GET" class="find-a-car-form card flex p-medium">
                    <div class="find-a-car-inputs">
                      <div class="form-group">
                        <label class="mb-medium">Brand</label>
                        <select id="makerSelect" name="maker_id">
                          <option value="">Semua Brand</option>
                          @foreach($makers as $maker)
                            <option value="{{ $maker->id }}" {{ request('maker_id') == $maker->id ? 'selected' : '' }}>
                              {{ $maker->name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
    
                      <div class="form-group">
                        <label class="mb-medium">Model</label>
                        <select id="modelSelect" name="model_id">
                          <option value="">Semua Model</option>
                        </select>
                      </div>
    
                      <div class="form-group">
                        <label class="mb-medium">Tipe</label>
                        <select name="motor_type_id">
                          <option value="">Semua Tipe</option>
                          @foreach($motorTypes as $type)
                            <option value="{{ $type->id }}" {{ request('motor_type_id') == $type->id ? 'selected' : '' }}>
                              {{ $type->name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
    
                      <div class="form-group">
                        <label class="mb-medium">Tahun</label>
                        <div class="flex gap-1">
                          <input type="number" placeholder="Dari" name="year_from" value="{{ request('year_from') }}" min="1900" max="{{ date('Y') }}" />
                          <input type="number" placeholder="Sampai" name="year_to" value="{{ request('year_to') }}" min="1900" max="{{ date('Y') }}" />
                        </div>
                      </div>
    
                      <div class="form-group">
                        <label class="mb-medium">Harga</label>
                        <div class="flex gap-1">
                          <input type="number" placeholder="Dari" name="price_from" value="{{ request('price_from') }}" />
                          <input type="number" placeholder="Sampai" name="price_to" value="{{ request('price_to') }}" />
                        </div>
                      </div>
    
                      <div class="form-group">
                        <label class="mb-medium">Kilometer</label>
                        <select name="mileage">
                          <option value="">Semua Kilometer</option>
                          @foreach([10000, 20000, 30000, 40000, 50000, 60000, 70000, 80000, 90000, 100000, 150000, 200000, 250000, 300000] as $km)
                            <option value="{{ $km }}" {{ request('mileage') == $km ? 'selected' : '' }}>
                              {{ number_format($km, 0, ',', '.') }} atau kurang
                            </option>
                          @endforeach
                        </select>
                      </div>
    
                      <div class="form-group">
                        <label class="mb-medium">Bahan Bakar</label>
                        <select name="fuel_type_id">
                          <option value="">Semua Bahan Bakar</option>
                          @foreach($fuelTypes as $type)
                            <option value="{{ $type->id }}" {{ request('fuel_type_id') == $type->id ? 'selected' : '' }}>
                              {{ $type->name }}
                            </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
    
                    <div class="flex">
                      <button type="reset" class="btn btn-find-a-car-reset">
                        Reset
                      </button>
                      <button type="submit" class="btn btn-primary btn-find-a-car-submit">
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
    
    @push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const makerSelect = document.querySelector('select[name="maker_id"]');
    const modelSelect = document.querySelector('select[name="model_id"]');

    makerSelect.addEventListener('change', async function() {
        const makerId = this.value;
        modelSelect.innerHTML = '<option value="">Semua Model</option>';
        modelSelect.disabled = true;

        if (!makerId) return;

        try {
            const response = await fetch(`/motors/maker/${makerId}/models`);
            if (!response.ok) throw new Error('Network response was not ok');
            
            const models = await response.json();
            
            models.forEach(model => {
                const option = document.createElement('option');
                option.value = model.id;
                option.textContent = model.name;
                if (model.id == '{{ request('model_id') }}') {
                    option.selected = true;
                }
                modelSelect.appendChild(option);
            });

            modelSelect.disabled = false;
        } catch (error) {
            console.error('Error:', error);
        }
    });

    // Trigger change event if maker is selected
    if (makerSelect.value) {
        makerSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endpush

</x-app-layout>
