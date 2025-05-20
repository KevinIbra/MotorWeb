<x-app-layout>
    <main>
        <div class="container-small">
            <h1 class="car-details-page-title">Tambah Motor Baru</h1>
            <form action="{{ route('motor.store') }}" method="POST" enctype="multipart/form-data" class="card add-new-car-form">
                @csrf
                <div class="form-content">
                    <div class="form-details">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="mb-medium">Brand</label>
                                    <select id="makerSelect" name="maker_id" class="form-control" required>
                                        <option value="">Pilih Brand</option>
                                        @foreach($makers as $maker)
                                            <option value="{{ $maker->id }}">{{ $maker->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Model</label>
                                    <select id="modelSelect" name="model_id" class="form-control" required>
                                        <option value="">Pilih Model</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <select name="year" class="form-control">
                                        <option value="">Tahun</option>
                                        @for ($year = now()->year; $year >= 1990; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Tipe Motor</label>
                            <div class="row">
                                @php
                                    $motorTypes = ['trail', 'matic', 'bebek', 'electric', 'sport'];
                                @endphp
                                @foreach ($motorTypes as $type)
                                    <div class="col">
                                        <label class="inline-radio">
                                            <input type="radio" name="car_type" value="{{ $type }}" />
                                            {{ ucfirst($type) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="price" placeholder="Harga" class="form-control" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Vin Code</label>
                                    <input name="vin_code" placeholder="Vin Code" class="form-control" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>KM</label>
                                    <input name="kilometers" placeholder="Kilometer" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Tipe Bensin</label>
                            <div class="row">
                                <div class="col">
                                    <label class="inline-radio">
                                        <input type="radio" name="fuel_type" value="pertalite" />
                                        Pertalite
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="inline-radio">
                                        <input type="radio" name="fuel_type" value="pertamax" />
                                        Pertamax
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="inline-radio">
                                        <input type="radio" name="fuel_type" value="solar" />
                                        Solar
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="mb-medium">Provinsi</label>
                                    <select id="stateSelect" name="state_id" class="form-control">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="mb-medium">Kota</label>
                                    <select id="citySelect" name="city_id" class="form-control">
                                        <option value="">Pilih Kota</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input name="address" placeholder="Alamat" class="form-control" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>No HP</label>
                                    <input name="phone_number" placeholder="Nomer" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Fitur Tambahan</label>
                            <div class="row">
                                <div class="col">
                                    @foreach ([
                                        'traction_control' => 'Traction Control System (TCS)',
                                        'slipper_clutch' => 'Slipper Clutch',
                                        'keyless' => 'Keyless Ignition',
                                        'abs' => 'ABS',
                                        'digital_speedometer' => 'Digital Speedometer',
                                        'bluetooth' => 'Bluetooth Connectivity'
                                    ] as $name => $label)
                                        <label class="checkbox">
                                            <input type="checkbox" name="{{ $name }}" value="1" />
                                            {{ $label }}
                                        </label>
                                    @endforeach
                                </div>
                                <div class="col">
                                    @foreach ([
                                        'hazard' => 'Hazard Lamp',
                                        'gps' => 'GPS Navigation System',
                                        'idling_stop' => 'Idling Stop System',
                                        'quick_shifter' => 'Quick Shifter',
                                        'led' => 'LED Lighting',
                                        'charging_port' => 'Charging Port'
                                    ] as $name => $label)
                                        <label class="checkbox">
                                            <input type="checkbox" name="{{ $name }}" value="1" />
                                            {{ $label }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" rows="10" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="checkbox">
                                <input type="checkbox" name="published" />
                                Published
                            </label>
                        </div>
                    </div>

                    <div class="form-images">
                        <div class="form-image-upload">
                            <div class="upload-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 48px">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <p>Click or drag images here to upload</p>
                            </div>
                            <input id="carFormImageUpload" name="images[]" type="file" multiple accept="image/*" />
                        </div>
                        <div id="imagePreviews" class="car-form-images"></div>
                    </div>
                </div>

                <div class="p-medium" style="width: 100%">
                    <div class="flex justify-end gap-1">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const makerSelect = document.getElementById('makerSelect');
    const modelSelect = document.getElementById('modelSelect');
    const stateSelect = document.getElementById('stateSelect');
    const citySelect = document.getElementById('citySelect');
    const fileInput = document.getElementById('carFormImageUpload');
    const imagePreviews = document.getElementById('imagePreviews');
    const uploadArea = document.querySelector('.form-image-upload');

    // --- Brand (Maker) → Model ---
    makerSelect.addEventListener('change', async function() {
        const makerId = this.value;
        modelSelect.innerHTML = '<option value="">Pilih Model</option>';
        modelSelect.disabled = true;

        if (!makerId) return;

        try {
            const response = await fetch(`/motors/maker/${makerId}/models`);
            if (!response.ok) throw new Error('Network response was not ok');
            
            const models = await response.json();
            console.log(models);  // Cek data model yang diterima
            
            models.forEach(model => {
                const option = document.createElement('option');
                option.value = model.id;
                option.textContent = model.name;
                modelSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error fetching models:', error);
            modelSelect.innerHTML = '<option value="">Error loading models</option>';
        } finally {
            modelSelect.disabled = false;
        }
    });

    // --- State → City ---
    stateSelect.addEventListener('change', async function() {
        const stateId = this.value;
        citySelect.innerHTML = '<option value="">Pilih Kota</option>';
        citySelect.disabled = true;

        if (!stateId) return;

        try {
            const response = await fetch(`/location/state/${stateId}/cities`);
            const cities = await response.json();
            console.log(cities);  // Cek data kota yang diterima
            
            cities.forEach(city => {
                const option = document.createElement('option');
                option.value = city.id;
                option.textContent = city.name;
                citySelect.appendChild(option);
            });

            citySelect.disabled = false;
        } catch (error) {
            console.error('Error fetching cities:', error);
        }
    });

    // --- Preview Gambar ---
    fileInput.addEventListener('change', function() {
        handleFiles(this.files);
    });

    // Handle drag and drop
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '#666';
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.style.borderColor = '#ccc';
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '#ccc';
        fileInput.files = e.dataTransfer.files;
        handleFiles(fileInput.files);
    });

    function handleFiles(files) {
        imagePreviews.innerHTML = '';
        
        Array.from(files).forEach(file => {
            if (!file.type.startsWith('image/')) {
                alert('Please upload only image files');
                return;
            }
            
            const reader = new FileReader();
            const preview = document.createElement('div');
            preview.className = 'car-form-image-preview';
            
            reader.onload = function(e) {
                preview.innerHTML = `
                    <img src="${e.target.result}" alt="Preview">
                    <button type="button" class="remove-image" aria-label="Remove image">×</button>
                `;
                
                preview.querySelector('.remove-image').addEventListener('click', function() {
                    preview.remove();
                    updateFileList(file);
                });
            };
            
            reader.readAsDataURL(file);
            imagePreviews.appendChild(preview);
        });
    }

    function updateFileList(fileToRemove) {
        const dt = new DataTransfer();
        const files = fileInput.files;
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (file !== fileToRemove) {
                dt.items.add(file);
            }
        }
        
        fileInput.files = dt.files;
    }
});
</script>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const makerSelect = document.getElementById('makerSelect');
    const modelSelect = document.getElementById('modelSelect');
    const stateSelect = document.getElementById('stateSelect');
    const citySelect = document.getElementById('citySelect');

    // Brand -> Model relationship
    makerSelect.addEventListener('change', async function() {
        const makerId = this.value;
        console.log('Selected maker ID:', makerId); // Debug logging
        
        modelSelect.innerHTML = '<option value="">Pilih Model</option>';
        modelSelect.disabled = true;

        if (!makerId) return;

        try {
            const response = await fetch(`/motors/maker/${makerId}/models`);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const models = await response.json();
            console.log('Received models:', models); // Debug logging
            
            models.forEach(model => {
                const option = document.createElement('option');
                option.value = model.id;
                option.textContent = model.name;
                modelSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error:', error);
            modelSelect.innerHTML = '<option value="">Error loading models</option>';
        } finally {
            modelSelect.disabled = false;
        }
    });
});
</script>
@endpush

