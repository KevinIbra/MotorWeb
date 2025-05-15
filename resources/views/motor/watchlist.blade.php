<x-app-layout>
     <main>
      <!-- New Cars -->
      <section>
        <div class="container">
          <div class="flex justify-between items-center">
            <h2>Motor Favorit</h2>
            @if ($motors->total() > 0)
            <div class="pagination-summary">
              <p> Showing {{$motors->firstItem()}} to 
                {{$motors->lastItem()}} of {{$motors->total()}} results.
              </p>
            </div>
              
            @endif
          </div>
          <div class="car-items-listing">
            @foreach ($motors as $motor )
              <x-car-item :$motor :isInWatchlist="true"/>
              @endforeach
          </div>

        {{$motors->onEachSide(1)->links()}}
        </div>
      </section>
      <!--/ New Cars -->
    </main>
</x-app-layout>