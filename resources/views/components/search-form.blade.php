<!-- Find a Motor form -->
<section class="find-a-car">
    <div class="container">
      <form
        action="{{route('motor.search')}}"
        method="GET"
        class="find-a-car-form card flex p-medium"
      >
        <div class="find-a-car-inputs">
          <div>
            <select id="makerSelect" name="maker_id">
              <option value="">Brand</option>
              <option value="4">Yamaha</option>
              <option value="2">Kawasaki</option>
              <option value="3">Honda</option>
              <option value="6">Ducati</option>
              
            </select>
          </div>
          <div>
            <select id="modelSelect" name="model_id">
              <option value="" style="display: block">Model</option>
              <option value="50" data-parent="5" style="display: none">
                370Z
              </option>
              <option value="6" data-parent="1" style="display: none">
                4Runner
              </option>
              <option value="22" data-parent="3" style="display: none">
                Accord
              </option>
              <option value="41" data-parent="5" style="display: none">
                Altima
              </option>
              <option value="23" data-parent="3" style="display: none">
                CR-V
              </option>
              <option value="37" data-parent="4" style="display: none">
                Camaro
              </option>
              <option value="1" data-parent="1" style="display: none">
                Camry
              </option>
              <option value="21" data-parent="3" style="display: none">
                Civic
              </option>
              <option value="36" data-parent="4" style="display: none">
                Colorado
              </option>
              <option value="2" data-parent="1" style="display: none">
                Corolla
              </option>
              <option value="35" data-parent="4" style="display: none">
                Cruze
              </option>
              <option value="54" data-parent="6" style="display: none">
                ES350
              </option>
              <option value="17" data-parent="2" style="display: none">
                Edge
              </option>
              <option value="32" data-parent="4" style="display: none">
                Equinox
              </option>
              <option value="12" data-parent="2" style="display: none">
                Escape
              </option>
              <option value="18" data-parent="2" style="display: none">
                Expedition
              </option>
              <option value="13" data-parent="2" style="display: none">
                Explorer
              </option>
              <option value="11" data-parent="2" style="display: none">
                F-150
              </option>
              <option value="28" data-parent="3" style="display: none">
                Fit
              </option>
              <option value="20" data-parent="2" style="display: none">
                Flex
              </option>
              <option value="47" data-parent="5" style="display: none">
                Frontier
              </option>
              <option value="15" data-parent="2" style="display: none">
                Fusion
              </option>
              <option value="58" data-parent="6" style="display: none">
                GS350
              </option>
              <option value="57" data-parent="6" style="display: none">
                GX460
              </option>
              <option value="26" data-parent="3" style="display: none">
                HR-V
              </option>
              <option value="3" data-parent="1" style="display: none">
                Highlander
              </option>
              <option value="56" data-parent="6" style="display: none">
                IS300
              </option>
              <option value="34" data-parent="4" style="display: none">
                Impala
              </option>
              <option value="29" data-parent="3" style="display: none">
                Insight
              </option>
              <option value="55" data-parent="6" style="display: none">
                LS500
              </option>
              <option value="60" data-parent="6" style="display: none">
                LX570
              </option>
              <option value="33" data-parent="4" style="display: none">
                Malibu
              </option>
              <option value="44" data-parent="5" style="display: none">
                Maxima
              </option>
              <option value="45" data-parent="5" style="display: none">
                Murano
              </option>
              <option value="14" data-parent="2" style="display: none">
                Mustang
              </option>
              <option value="59" data-parent="6" style="display: none">
                NX300
              </option>
              <option value="25" data-parent="3" style="display: none">
                Odyssey
              </option>
              <option value="30" data-parent="3" style="display: none">
                Passport
              </option>
              <option value="46" data-parent="5" style="display: none">
                Pathfinder
              </option>
              <option value="24" data-parent="3" style="display: none">
                Pilot
              </option>
              <option value="5" data-parent="1" style="display: none">
                Prius
              </option>
              <option value="4" data-parent="1" style="display: none">
                RAV4
              </option>
              <option value="62" data-parent="6" style="display: none">
                RC350
              </option>
              <option value="53" data-parent="6" style="display: none">
                RX350
              </option>
              <option value="51" data-parent="6" style="display: none">
                RX400
              </option>
              <option value="52" data-parent="6" style="display: none">
                RX450
              </option>
              <option value="16" data-parent="2" style="display: none">
                Ranger
              </option>
              <option value="27" data-parent="3" style="display: none">
                Ridgeline
              </option>
              <option value="43" data-parent="5" style="display: none">
                Rogue
              </option>
              <option value="42" data-parent="5" style="display: none">
                Sentra
              </option>
              <option value="10" data-parent="1" style="display: none">
                Sequoia
              </option>
              <option value="7" data-parent="1" style="display: none">
                Sienna
              </option>
              <option value="31" data-parent="4" style="display: none">
                Silverado
              </option>
              <option value="40" data-parent="4" style="display: none">
                Suburban
              </option>
              <option value="39" data-parent="4" style="display: none">
                Tahoe
              </option>
              <option value="19" data-parent="2" style="display: none">
                Taurus
              </option>
              <option value="48" data-parent="5" style="display: none">
                Titan
              </option>
              <option value="38" data-parent="4" style="display: none">
                Traverse
              </option>
              <option value="9" data-parent="1" style="display: none">
                Tundra
              </option>
              <option value="61" data-parent="6" style="display: none">
                UX200
              </option>
              <option value="49" data-parent="5" style="display: none">
                Versa
              </option>
              <option value="8" data-parent="1" style="display: none">
                Yaris
              </option>
            </select>
          </div>
          <div>
            <select id="stateSelect" name="state_id">
              <option value="">Provinsi</option>
              <option value="4">Jawa Barat</option>
              <option value="2">Jawa Timur</option>
              
            </select>
          </div>
          <div>
            <select id="citySelect" name="city_id">
              <option value="" style="display: block">Kota</option>
              <option value="3" data-parent="1" style="display: none">
                Tasikmalaya
              </option>
              <option value="8" data-parent="2" style="display: none">
                Bandung
              </option>
              <option value="14" data-parent="3" style="display: none">
                Malang
              </option>
              <option value="13" data-parent="3" style="display: none">
                Surabaya
              
            </select>
          </div>
          <div>
            {{-- tanda --}}
            <select name="motor_type_id">
              <option value="">Tipe</option>
              <option value="2">Trail</option>
              <option value="6">Matic</option>
              <option value="5">Sport</option>
              <option value="4">ATV</option>
             
            </select>
          </div>
          <div>
            <input type="number" placeholder="Tahun Masuk" name="year_from" />
          </div>
          <div>
            <input type="number" placeholder="Tahun Keluar" name="year_to" />
          </div>
          <div>
            <input
              type="number"
              placeholder="Harga Masuk"
              name="price_from"
            />
          </div>
          <div>
            <input type="number" placeholder="Harga Keluar" name="price_to" />
          </div>
          <div>
            <select name="fuel_type_id">
              <option value="">Tipe Bensin</option>
              <option value="2">Diesel</option>
              <option value="3">Electric</option>
              <option value="1">Gasoline</option>
              <option value="4">Hybrid</option>
            </select>
          </div>
        </div>
        <div>
          <button type="button" class="btn btn-find-a-car-reset">
            Reset
          </button>
          <button class="btn btn-primary btn-find-a-car-submit">
            Cari
          </button>
        </div>
      </form>
    </div>
  </section>
  <!--/ Find a car form -->