<x-app-layout>
    <main>
        <div class="container-small">
          <h1 class="car-details-page-title">Tambahkan Motor Baru</h1>
          <form
            action=""
            method="POST"
            enctype="multipart/form-data"
            class="card add-new-car-form"
          >
            <div class="form-content">
              <div class="form-details">
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label>Brand</label>
                      <select>
                        <option value="">Brand</option>
                        <option value="bmw">Yamaha</option>
                        <option value="lexus">Honda</option>
                        <option value="mercedes">Suzuki</option>
                        <option value="mercedes">Kawasaki</option>
                      </select>
                      <p class="error-message">Wajib Diisi</p>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label>Model</label>
                      <select>
                        <option value="">Model</option>
                      </select>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label>Tahun</label>
                      <select>
                        <option value="">Tahun</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
                        <option value="2015">2015</option>
                        <option value="2014">2014</option>
                        <option value="2013">2013</option>
                        <option value="2012">2012</option>
                        <option value="2011">2011</option>
                        <option value="2010">2010</option>
                        <option value="2009">2009</option>
                        <option value="2008">2008</option>
                        <option value="2007">2007</option>
                        <option value="2006">2006</option>
                        <option value="2005">2005</option>
                        <option value="2004">2004</option>
                        <option value="2003">2003</option>
                        <option value="2002">2002</option>
                        <option value="2001">2001</option>
                        <option value="2000">2000</option>
                        <option value="1999">1999</option>
                        <option value="1998">1998</option>
                        <option value="1997">1997</option>
                        <option value="1996">1996</option>
                        <option value="1995">1995</option>
                        <option value="1994">1994</option>
                        <option value="1993">1993</option>
                        <option value="1992">1992</option>
                        <option value="1991">1991</option>
                        <option value="1990">1990</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Tipe Motor</label>
                  <div class="row">
                    <div class="col">
                      <label class="inline-radio">
                        <input type="radio" name="car_type" value="Sport" />
                        Sport
                      </label>
                    </div>
  
                    <div class="col">
                      <label class="inline-radio">
                        <input type="radio" name="car_type" value="Matic" />
                        Matic
                      </label>
                    </div>
                    <div class="col">
                      <label class="inline-radio">
                        <input type="radio" name="car_type" value="Cruiser" />
                        Cruiser
                      </label>
                    </div>
  
                    <div class="col">
                      <label class="inline-radio">
                        <input type="radio" name="car_type" value="trail" />
                        Trail
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label>Harga</label>
                      <input type="number" placeholder="Harga" />
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label>Vin Code</label>
                      <input placeholder="Vin Code" />
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label>Kilometer</label>
                      <input placeholder="KM" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Tipe Bensin</label>
                  <div class="row">
                    <div class="col">
                      <label class="inline-radio">
                        <input type="radio" name="fuel_type" value="gasoline" />
                        Pertalite
                      </label>
                    </div>
                    <div class="col">
                      <label class="inline-radio">
                        <input type="radio" name="fuel_type" value="diesel" />
                        Pertamax
                      </label>
                    </div>
                    <div class="col">
                      <label class="inline-radio">
                        <input type="radio" name="fuel_type" value="electric" />
                        Solar
                      </label>
                    </div>
                  
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label>Provinsi</label>
                      <select>
                        <option value="">Provinsi</option>
                      </select>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label>Kota</label>
                      <select>
                        <option value="">Kota</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label>Alamat</label>
                      <input placeholder="Alamat" />
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label>No HP</label>
                      <input placeholder="Nomer" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col">
                      <label class="checkbox">
                        <input
                          type="checkbox"
                          name="air_conditioning"
                          value="1"
                        />
                        Air Conditioning
                      </label>
  
                      <label class="checkbox">
                        <input type="checkbox" name="power_windows" value="1" />
                        Power Windows
                      </label>
  
                      <label class="checkbox">
                        <input
                          type="checkbox"
                          name="power_door_locks"
                          value="1"
                        />
                        Power Door Locks
                      </label>
  
                      <label class="checkbox">
                        <input type="checkbox" name="abs" value="1" />
                        ABS
                      </label>
  
                      <label class="checkbox">
                        <input type="checkbox" name="cruise_control" value="1" />
                        Cruise Control
                      </label>
  
                      <label class="checkbox">
                        <input
                          type="checkbox"
                          name="bluetooth_connectivity"
                          value="1"
                        />
                        Bluetooth Connectivity
                      </label>
                    </div>
                    <div class="col">
                      <label class="checkbox">
                        <input type="checkbox" name="remote_start" value="1" />
                        Remote Start
                      </label>
  
                      <label class="checkbox">
                        <input type="checkbox" name="gps_navigation" value="1" />
                        GPS Navigation System
                      </label>
  
                      <label class="checkbox">
                        <input type="checkbox" name="heated_seats" value="1" />
                        Heated Seats
                      </label>
  
                      <label class="checkbox">
                        <input type="checkbox" name="climate_control" value="1" />
                        Climate Control
                      </label>
  
                      <label class="checkbox">
                        <input
                          type="checkbox"
                          name="rear_parking_sensors"
                          value="1"
                        />
                        Rear Parking Sensors
                      </label>
  
                      <label class="checkbox">
                        <input type="checkbox" name="leather_seats" value="1" />
                        Leather Seats
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea rows="10"></textarea>
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
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      style="width: 48px"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                      />
                    </svg>
                  </div>
                  <input id="carFormImageUpload" type="file" multiple />
                </div>
                <div id="imagePreviews" class="car-form-images"></div>
              </div>
            </div>
            <div class="p-medium" style="width: 100%">
              <div class="flex justify-end gap-1">
                <button type="button" class="btn btn-default">Reset</button>
                <button class="btn btn-primary">Kirim</button>
              </div>
            </div>
          </form>
        </div>
      </main>
</x-app-layout>
