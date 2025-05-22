<x-app-layout>
    <main>
        <div class="container-small">
            <h1 class="car-details-page-title">Edit Motor</h1>

            <form action="{{ route('motor.update', $motor) }}" method="POST" enctype="multipart/form-data" class="card add-new-car-form">
                @csrf
                @method('PUT')
                
                <div class="form-content">
                    <div class="form-details">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Merek</label>
                                    <select name="maker_id" class="form-control" required>
                                        <option value="">Pilih Merek</option>
                                        @foreach($makers as $maker)
                                            <option value="{{ $maker->id }}" {{ $motor->maker_id == $maker->id ? 'selected' : '' }}>
                                                {{ $maker->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Model</label>
                                    <select name="model_id" class="form-control" required>
                                        <option value="">Pilih Model</option>
                                        @foreach($models as $model)
                                            <option value="{{ $model->id }}" {{ $motor->model_id == $model->id ? 'selected' : '' }}>
                                                {{ $model->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <select name="year" class="form-control" required>
                                        <option value="">Pilih Tahun</option>
                                        @for($i = date('Y'); $i >= 1990; $i--)
                                            <option value="{{ $i }}" {{ $motor->year == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Tipe Motor</label>
                            <div class="row">
                                @foreach($motorTypes as $type)
                                    <div class="col">
                                        <label class="inline-radio">
                                            <input type="radio" name="motor_type_id" value="{{ $type->id }}" 
                                                {{ $motor->motor_type_id == $type->id ? 'checked' : '' }} required/>
                                            {{ $type->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="price" value="{{ $motor->price }}" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>VIN</label>
                                    <input type="text" name="vin" value="{{ $motor->vin }}" class="form-control"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Kilometer</label>
                                    <input type="number" name="mileage" value="{{ $motor->mileage }}" class="form-control" required/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Bahan Bakar</label>
                            <div class="row">
                                @foreach($fuelTypes as $type)
                                    <div class="col">
                                        <label class="inline-radio">
                                            <input type="radio" name="fuel_type_id" value="{{ $type->id }}"
                                                {{ $motor->fuel_type_id == $type->id ? 'checked' : '' }} required/>
                                            {{ $type->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Kota</label>
                                    <select name="city_id" class="form-control" required>
                                        <option value="">Pilih Kota</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" {{ $motor->city_id == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="address" value="{{ $motor->address }}" class="form-control" required/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" rows="5" class="form-control" required>{{ $motor->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="text" name="phone_number" value="{{ $motor->phone_number }}" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label>Foto Motor</label>
                            <div class="existing-images flex gap-2 mb-4">
                                @forelse($motor->images as $image)
                                    <div class="relative">
                                        <img 
                                            src="{{ Storage::url($image->path) }}" 
                                            class="w-24 h-24 object-cover rounded-lg shadow-sm" 
                                            alt="{{ $motor->maker?->name }} {{ $motor->motorModel?->name }}"
                                            onerror="this.src='{{ asset('images/placeholder.jpg') }}'"
                                        />
                                        <input type="hidden" name="existing_images[]" value="{{ $image->id }}"/>
                                        <div class="absolute top-1 right-1">
                                            <label class="inline-flex items-center">
                                                <input 
                                                    type="radio" 
                                                    name="primary_image" 
                                                    value="{{ $image->id }}"
                                                    {{ $motor->primary_image_id == $image->id ? 'checked' : '' }}
                                                    class="form-radio text-primary"
                                                >
                                                <span class="ml-1 text-xs text-white">Primary</span>
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-gray-500">No images uploaded yet</p>
                                @endforelse
                            </div>

                            <div class="mt-4">
                                <input 
                                    type="file" 
                                    name="images[]" 
                                    multiple 
                                    class="form-control" 
                                    accept="image/*"
                                />
                                <small class="text-muted block mt-2">
                                    Upload foto baru jika ingin menambah atau mengganti foto yang ada.
                                    Format yang didukung: JPG, JPEG, PNG. Maksimal 2MB per file.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions p-4">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('motor.index') }}" class="btn btn-default">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle maker change to load models
            const makerSelect = document.querySelector('select[name="maker_id"]');
            const modelSelect = document.querySelector('select[name="model_id"]');

            makerSelect.addEventListener('change', async function() {
                const makerId = this.value;
                modelSelect.innerHTML = '<option value="">Pilih Model</option>';

                if (makerId) {
                    try {
                        const response = await fetch(`/motors/maker/${makerId}/models`);
                        const models = await response.json();
                        models.forEach(model => {
                            modelSelect.add(new Option(model.name, model.id));
                        });
                    } catch (error) {
                        console.error('Error loading models:', error);
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
