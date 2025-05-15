<x-app-layout title="Home Page">
    @isset($motors)
        <!-- bagian koleksi motor -->
        <section>
          <div class="container">
            <h2>Koleksi Motor</h2>
            <div class="car-items-listing">
              @forelse ($motors as $motor)
                <x-car-item :motor="$motor" />
              @empty
                <p>Tidak ada motor yang tersedia.</p>
              @endforelse
            </div>
            <div class="pagination">
              {{ $motors->links() }}
            </div>
          </div>
        </section>
    @endisset
</x-app-layout>
