<!-- Find a Motor form -->
<section class="search-section">
    <div class="container">
        <form action="{{ route('motor.search') }}" method="GET" class="search-form">
            <div class="search-grid">
                <div class="form-group">
                    <label>Brand Motor</label>
                    <select name="maker_id" class="form-control">
                        <option value="">Semua Brand</option>
                        @foreach($makers as $maker)
                            <option value="{{ $maker->id }}" {{ request('maker_id') == $maker->id ? 'selected' : '' }}>
                                {{ $maker->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Model Motor</label>
                    <select name="model_id" class="form-control">
                        <option value="">Semua Model</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tahun Kendaraan</label>
                    <div class="year-range">
                        <input type="number" name="year_from" class="form-control" placeholder="Dari" value="{{ request('year_from') }}">
                        <input type="number" name="year_to" class="form-control" placeholder="Sampai" value="{{ request('year_to') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Kisaran Harga</label>
                    <div class="price-range">
                        <input type="number" name="price_from" class="form-control" placeholder="Dari" value="{{ request('price_from') }}">
                        <input type="number" name="price_to" class="form-control" placeholder="Sampai" value="{{ request('price_to') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Tipe Motor</label>
                    <select name="motor_type_id" class="form-control">
                        <option value="">Semua Tipe</option>
                        @foreach($motorTypes as $type)
                            <option value="{{ $type->id }}" {{ request('motor_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Bahan Bakar</label>
                    <select name="fuel_type_id" class="form-control">
                        <option value="">Semua Jenis</option>
                        @foreach($fuelTypes as $type)
                            <option value="{{ $type->id }}" {{ request('fuel_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="search-actions">
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    Cari Motor
                </button>
            </div>
        </form>
    </div>
</section>