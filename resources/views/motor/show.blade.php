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
              <div class="car-images-carousel">
                <div class="car-image-wrapper">
                  <img
                    src="{{ $motor->primaryImage->image_path}}"
                    alt=""
                    class="car-active-image"
                    id="activeImage"
                  />
                </div>
                <div class="car-image-thumbnails">
                 @foreach ($motor->images as $image)
  <img 
    src="{{ $image->image_path ?? asset('images/placeholder.jpg') }}" 
    alt="" 
    onclick="document.getElementById('activeImage').src='{{ $image->image_path }}'" 
    class="cursor-pointer"
  />
@endforeach
                    
                 
                 
                </div>
                <button class="carousel-button prev-button" id="prevButton">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 64px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M15.75 19.5 8.25 12l7.5-7.5"
                    />
                  </svg>
                </button>
                <button class="carousel-button next-button" id="nextButton">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 64px"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="m8.25 4.5 7.5 7.5-7.5 7.5"
                    />
                  </svg>
                </button>
              </div>
  
              <div class="card car-detailed-description">
                <h2 class="car-details-title">Deskripsi Motor</h2>
         
                  {!! $motor->description !!}
               
              </div>
  {{-- tanda --}}
              <div class="card car-detailed-description">
                <h2 class="car-details-title">Spesifikasi Motor</h2>
  
                <ul class="car-specifications">
                 <x-motor-spesification :value="optional($motor->features)->abs">
                    ABS
                  </x-motor-spesification>
                  <x-motor-spesification :value="optional($motor->features)->keyless">
                    Keyless
                  </x-motor-spesification>
                  <x-motor-spesification :value="optional($motor->features)->alarm_system">
                  Alarm System
                  </x-motor-spesification>
                  <x-motor-spesification :value="optional($motor->features)->led_lights">
                  LED Lights
                  </x-motor-spesification>
                  <x-motor-spesification :value="optional($motor->features)->digital_speedometer">
                 Digital Speedometer
                  </x-motor-spesification>
                  <x-motor-spesification :value="optional($motor->features)->bluetooth_connectivity">
                  Bluetooth Connectivity
                  </x-motor-spesification>
                  <x-motor-spesification :value="optional($motor->features)->usb_charging">
                 USB Charging
                  </x-motor-spesification>
                  <x-motor-spesification :value="optional($motor->features)->engine_kill_switch">
                  Engine Kill Switch
                  </x-motor-spesification>
                  <x-motor-spesification :value="optional($motor->features)->side_stand_sensor">
                  Side Stand Sensor
                  </x-motor-spesification>
                  <x-motor-spesification :value="optional($motor->features)->traction_control">
                 Traction Control
                  </x-motor-spesification>
                  
                
               
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
              <a href="tel:{{\Illuminate\Support\Str::mask($motor->phone, '*', -3)}}" class="car-details-phone">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  style="width: 16px"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"
                  />
                </svg>
  
                {{\Illuminate\Support\Str::mask($motor->phone, '*', -3)}}
                <span class="car-details-phone-view">Liat Full Number</span>
              </a>
            </div>
          </div>
        </div>
      </main>
</x-app-layout>
