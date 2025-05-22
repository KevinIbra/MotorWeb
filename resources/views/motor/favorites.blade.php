<x-app-layout>
    <div class="container py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Motor Favorit Saya</h1>
            <a href="{{ route('motor.search') }}" class="btn btn-primary">
                Cari Motor
            </a>
        </div>

        @if($motors->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($motors as $motor)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="aspect-w-16 aspect-h-9">
                            @if($motor->primaryImage)
                                <img src="{{ asset('storage/' . $motor->primaryImage->path) }}" 
                                     alt="{{ $motor->maker->name }} {{ $motor->motorModel->name }}"
                                     class="object-cover w-full h-full">
                            @else
                                <div class="bg-gray-200 w-full h-full flex items-center justify-center">
                                    <span class="text-gray-400">No Image</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2">
                                {{ $motor->maker->name }} {{ $motor->motorModel->name }}
                            </h3>
                            <p class="text-primary-600 font-bold mb-2">
                                Rp {{ number_format($motor->price, 0, ',', '.') }}
                            </p>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('motor.show', $motor) }}" class="text-primary-600 hover:text-primary-700">
                                    Lihat Detail
                                </a>
                                <form action="{{ route('motor.toggleFavorite', $motor) }}" 
                                      method="POST" 
                                      class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="flex items-center px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus motor ini dari favorit?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" 
                                             fill="currentColor"
                                             viewBox="0 0 24 24" 
                                             stroke-width="1.5" 
                                             stroke="currentColor" 
                                             class="w-5 h-5 mr-1">
                                            <path stroke-linecap="round" 
                                                  stroke-linejoin="round" 
                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $motors->links() }}
            </div>
        @else
            <div class="text-center py-8">
                <p class="text-gray-500">Anda belum memiliki motor favorit</p>
                <a href="{{ route('motor.search') }}" 
                   class="inline-block mt-4 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                    Cari Motor
                </a>
            </div>
        @endif
    </div>
</x-app-layout>