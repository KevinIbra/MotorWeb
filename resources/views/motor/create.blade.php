<x-app-layout>
    <main>
        <div class="container-small">
            <h1 class="car-details-page-title">Tambah Motor Baru</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('motor.store') }}" method="POST" enctype="multipart/form-data" class="card add-new-car-form">
                @csrf
                <div class="form-content">
                    <div class="form-details">
                        <!-- Maker and Model -->
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Merek</label>
                                    <select name="maker_id" class="form-control" required>
                                        <option value="">Pilih Merek</option>
                                        @foreach($makers as $maker)
                                            <option value="{{ $maker->id }}">{{ $maker->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Model</label>
                                    <select name="model_id" class="form-control" required>
                                        <option value="">Pilih Model</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Year and Type -->
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input type="number" name="year" class="form-control" 
                                           min="1990" max="{{ date('Y') }}" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Tipe Motor</label>
                                    <select name="motor_type_id" class="form-control" required>
                                        <option value="">Pilih Tipe</option>
                                        @foreach($motorTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Price and VIN -->
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Harga (Rp)</label>
                                    <input type="number" name="price" class="form-control" step="0.01" min="0" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Nomor Rangka (VIN)</label>
                                    <input type="text" name="vin" class="form-control" maxlength="255">
                                </div>
                            </div>
                        </div>

                        <!-- Mileage and Fuel -->
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Kilometer</label>
                                    <input type="number" name="mileage" class="form-control" min="0" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Tipe Bahan Bakar</label>
                                    <select name="fuel_type_id" class="form-control" required>
                                        <option value="">Pilih Bahan Bakar</option>
                                        @foreach($fuelTypes as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- City and Address -->
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Kota</label>
                                    <select name="city_id" class="form-control" required>
                                        <option value="">Pilih Kota</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="address" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Phone and Description -->
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="text" name="phone_number" class="form-control" maxlength="20" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="description" class="form-control" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Images -->
                        <div class="form-group">
                            <label>Foto Motor</label>
                            <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/jpg" class="form-control" required>
                            <small class="text-muted">Max 2MB per foto</small>
                            <div id="imagePreviews" class="mt-2 flex gap-2"></div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Simpan Motor</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Model dropdown update when maker changes
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

            // Image preview
            const input = document.querySelector('input[name="images[]"]');
            const preview = document.getElementById('imagePreviews');

            input.addEventListener('change', function() {
                preview.innerHTML = '';
                [...this.files].forEach(file => {
                    if (file.size > 2048000) {
                        alert('File terlalu besar. Maximum 2MB per foto.');
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = e => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-24 h-24 object-cover rounded';
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            });
        });
    </script>
    @endpush
</x-app-layout>

