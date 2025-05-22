<x-app-layout :title="'Motor'">
    <main>
        <div class="container">
          <h1 class="car-details-page-title">
              {{ $motor->maker?->name ?? 'Unknown Maker' }} 
              {{ $motor->motorModel?->name ?? 'Unknown Model' }} - 
              {{ $motor->year }}
             

          </h1>
          <div class="car-details-region">{{ $motor->city?->name ?? 'Location N/A' }} - 
                {{ $motor->published_at?->format('d M Y') ?? 'Date N/A' }}</div>
  
          <div class="car-details-content">
            <div class="car-images-and-description">
              <div class="car-images-carousel card">
                <div class="car-image-wrapper">
                    <img
                        src="{{ Storage::url($motor->primaryImage?->path) ?? asset('images/placeholder.jpg') }}"
                        alt="{{ $motor->maker?->name }} {{ $motor->motorModel?->name }}"
                        class="car-active-image w-full h-[400px] object-cover"
                        id="activeImage"
                        onerror="this.src='{{ asset('images/placeholder.jpg') }}'"
                    />
                </div>
                <div class="car-image-thumbnails p-4 flex gap-2 overflow-x-auto">
                    @foreach ($motor->images as $image)
                        <img 
                            src="{{ Storage::url($image->path) }}" 
                            alt="{{ $motor->maker?->name }} {{ $motor->motorModel?->name }}" 
                            onclick="document.getElementById('activeImage').src='{{ Storage::url($image->path) }}'" 
                            class="cursor-pointer w-24 h-24 object-cover rounded-lg transition-all duration-200 {{ $motor->primaryImage?->id === $image->id ? 'ring-2 ring-primary' : 'hover:opacity-75' }}"
                            onerror="this.src='{{ asset('images/placeholder.jpg') }}'"
                        />
                    @endforeach
                </div>

                {{-- Carousel Navigation Buttons --}}
                <button class="carousel-button prev-button absolute left-4 top-1/2 -translate-y-1/2" id="prevButton">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <button class="carousel-button next-button absolute right-4 top-1/2 -translate-y-1/2" id="nextButton">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
              </div>
  
              <div class="card car-detailed-description">
                <h2 class="car-details-title">Deskripsi Motor</h2>
         
                  {!! $motor->description !!}
               
              </div>
  
              <div class="card car-detailed-description">
                <h2 class="car-details-title">Spesifikasi Motor</h2>
  
                <ul class="car-specifications">
                    @if($motor->features)
                        <x-motor-spesification :value="$motor->features->abs ?? false">
                            ABS
                        </x-motor-spesification>
                        <x-motor-spesification :value="$motor->features->keyless ?? false">
                            Keyless
                        </x-motor-spesification>
                        <x-motor-spesification :value="$motor->features->alarm_system ?? false">
                            Alarm System
                        </x-motor-spesification>
                        <x-motor-spesification :value="$motor->features->led_lights ?? false">
                            LED Lights
                        </x-motor-spesification>
                        <x-motor-spesification :value="$motor->features->digital_speedometer ?? false">
                            Digital Speedometer
                        </x-motor-spesification>
                        <x-motor-spesification :value="$motor->features->bluetooth_connectivity ?? false">
                            Bluetooth Connectivity
                        </x-motor-spesification>
                        <x-motor-spesification :value="$motor->features->usb_charging ?? false">
                            USB Charging
                        </x-motor-spesification>
                        <x-motor-spesification :value="$motor->features->engine_kill_switch ?? false">
                            Engine Kill Switch
                        </x-motor-spesification>
                        <x-motor-spesification :value="$motor->features->side_stand_sensor ?? false">
                            Side Stand Sensor
                        </x-motor-spesification>
                        <x-motor-spesification :value="$motor->features->traction_control ?? false">
                            Traction Control
                        </x-motor-spesification>
                    @else
                        <p>No specifications available</p>
                    @endif
                </ul>
              </div>
            </div>
            <div class="car-details card">
              <div class="flex items-center justify-between">
                <p class="car-details-price">Rp.{{ number_format($motor->price, 0, ',', '.') }}</p>
                @auth
                    <form action="{{ route('motor.toggleFavorite', $motor) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-heart {{ $motor->isFavoritedBy(auth()->user()) ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 fill="{{ $motor->isFavoritedBy(auth()->user()) ? 'currentColor' : 'none' }}"
                                 viewBox="0 0 24 24" 
                                 stroke-width="1.5" 
                                 stroke="currentColor" 
                                 style="width: 20px">
                                <path stroke-linecap="round" 
                                      stroke-linejoin="round" 
                                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-heart">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 20px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </a>
                @endauth
            </div>
              <hr />
              <table class="car-details-table">
                <tbody>
                    <tr>
                        <th>Brand</th>
                        <td>{{ $motor->maker?->name ?? 'Unknown Maker' }}</td>
                    </tr>
                    <tr>
                        <th>Model</th>
                        <td>{{ $motor->motorModel?->name ?? 'Unknown Model' }}</td>
                    </tr>
                    <tr>
                        <th>Tahun</th>
                        <td>{{ $motor->year }}</td>
                    </tr>
                    <tr>
                        <th>Vin</th>
                        <td>{{ $motor->vin }}</td>
                    </tr>
                    <tr>
                        <th>Kilometer</th>
                        <td>{{ $motor->mileage }}</td>
                    </tr>
                     <tr>
                        <th>Tipe Bensin</th>
                        <td>{{ $motor->fuelType->name ?? 'Type N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Tipe Motor</th>
                        <td>{{ $motor->motorType?->name ?? 'Type N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $motor->address }}</td>
                    </tr>
                </tbody>
              </table>
              <hr />
  
              <div class="flex gap-1 my-medium">
                <img
                  src="/img/avatar.png"
                  alt=""
                  class="car-details-owner-image"
                />
                <div>
                    <h3 class="car-details-owner">
                        {{ $motor->owner?->name ?? 'Unknown Owner' }}
                    </h3>
                    <div class="text-muted">
                        {{ $motor->owner?->motors()->count() ?? 0 }} Motor
                    </div>
                </div>
              </div>
              <div class="phone-number-container">
                  <a href="javascript:void(0)" class="car-details-phone" id="phoneNumberLink">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 16px">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                      </svg>
                      <span id="phoneNumberText">
                          @if($motor->phone)
                              {{\Illuminate\Support\Str::mask($motor->phone, '*', -3)}}
                          @else
                              {{ $motor->owner?->phone ?? 'No phone number available' }}
                          @endif
                      </span>
                      <span class="car-details-phone-view" id="viewNumberText">
                          @if($motor->phone || $motor->owner?->phone)
                              Liat Full Number
                          @endif
                      </span>
                  </a>
              </div>
            </div>
          </div>
        </div>
      </main>
      @push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const phoneLink = document.getElementById('phoneNumberLink');
    const phoneText = document.getElementById('phoneNumberText');
    const viewText = document.getElementById('viewNumberText');
    const fullNumber = "{{ $motor->phone ?? $motor->owner?->phone ?? '' }}";
    
    if (!fullNumber) {
        phoneLink.style.pointerEvents = 'none';
        phoneLink.style.opacity = '0.7';
        return;
    }

    let isRevealed = false;

    phoneLink.addEventListener('click', function(e) {
        e.preventDefault();
        if (!isRevealed) {
            phoneText.textContent = fullNumber;
            viewText.textContent = 'Sembunyikan Nomor';
            isRevealed = true;
        } else {
            phoneText.textContent = "{{\Illuminate\Support\Str::mask($motor->phone ?? $motor->owner?->phone ?? '', '*', -3)}}";
            viewText.textContent = 'Liat Full Number';
            isRevealed = false;
        }
    });
});
</script>
@endpush
</x-app-layout>
