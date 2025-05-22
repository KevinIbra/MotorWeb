<x-app-layout bodyClass="page-my-cars">
    <main>
        <div>
          <div class="container">
            <h1 class="car-details-page-title">MotorKu</h1>
            <div class="card p-medium">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Gambar</th>
                      <th>Judul</th>
                      <th>Tanggal</th>
                      <th>Published</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($motors as $motor)
                    <tr>
                        <td>
                            <img
                                src="{{ $motor->primaryImage?->path ?? asset('img/placeholder.png') }}"
                                alt="{{ $motor->maker?->name }} {{ $motor->model?->name }}"
                                class="my-cars-img-thumbnail"
                            />
                        </td>
                        <td>{{ $motor->year }} - {{ $motor->maker?->name ?? 'Unknown Maker' }} {{ $motor->motorModel?->name ?? 'Unknown Model' }}</td>
                        <td>{{ $motor->getCreatedDate() }}</td>
                        <td>{{ $motor->published_at ? 'yes' : 'no' }}</td>
                        <td>
                            <a href="{{ route('motor.edit', $motor) }}" class="btn btn-edit inline-flex items-center">
                                <!-- ...existing code... -->
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No motors found</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>

              @if($motors->hasPages())
                  <div class="pagination-container">
                      <nav role="navigation" aria-label="Pagination Navigation">
                          <ul class="pagination">
                              {{-- Previous Page Link --}}
                              @if ($motors->onFirstPage())
                                  <li class="page-item disabled">
                                      <span class="page-link">&laquo;</span>
                                  </li>
                              @else
                                  <li class="page-item">
                                      <a class="page-link" href="{{ $motors->previousPageUrl() }}" rel="prev">&laquo;</a>
                                  </li>
                              @endif

                              {{-- Pagination Elements --}}
                              @for ($i = 1; $i <= $motors->lastPage(); $i++)
                                  <li class="page-item {{ ($motors->currentPage() == $i) ? 'active' : '' }}">
                                      <a class="page-link" href="{{ $motors->url($i) }}">{{ $i }}</a>
                                  </li>
                              @endfor

                              {{-- Next Page Link --}}
                              @if ($motors->hasMorePages())
                                  <li class="page-item">
                                      <a class="page-link" href="{{ $motors->nextPageUrl() }}" rel="next">&raquo;</a>
                                  </li>
                              @else
                                  <li class="page-item disabled">
                                      <span class="page-link">&raquo;</span>
                                  </li>
                              @endif
                          </ul>
                      </nav>
                  </div>
              @endif
            </div>
          </div>
        </div>
      </main>
  
</x-app-layout>
