<x-app-layout title="Penawaran Masuk">
    <main class="container py-6">
        <div class="card">
            <div class="card-header flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold">Penawaran Masuk</h2>
                    <p class="text-sm text-gray-600 mt-1">Semua penawaran dari pembeli untuk motor Anda</p>
                </div>

                <div class="flex items-center gap-3">
                    <span class="inline-block bg-blue-50 text-blue-700 text-sm px-3 py-1 rounded">
                        Total: {{ $offers->total() }}
                    </span>
                    <form method="GET" action="{{ route('offers.seller.index') }}" class="flex items-center gap-2">
                        <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari..." class="form-control" />
                        <select name="status" class="form-control">
                            <option value="">Semua</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="accepted" {{ request('status') === 'accepted' ? 'selected' : '' }}>Diterima</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                    </form>
                </div>
            </div>

            <div class="card-body">
                @if($offers->isEmpty())
                    <div class="py-8 text-center text-gray-600">Belum ada penawaran</div>
                @else
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Motor</th>
                                    <th>Pembeli</th>
                                    <th class="text-right">Jumlah</th>
                                    <th class="text-center">Status</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($offers as $offer)
                                <tr>
                                    <td class="py-3 w-12">{{ $loop->iteration + ($offers->currentPage()-1)*$offers->perPage() }}</td>

                                    <td class="py-3">
                                        <div class="flex items-center gap-3">
                                            @php
                                                $img = $offer->motor->primaryImage?->path ?? $offer->motor->images?->first()?->path ?? null;
                                            @endphp
                                            <div class="w-16 h-10 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                                                @if($img)
                                                    <img src="{{ Str::startsWith($img, ['http','/']) ? $img : Storage::url($img) }}" alt="motor" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-xs text-gray-400">No Image</div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-medium">{{ $offer->motor->maker?->name }} {{ $offer->motor->motorModel?->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $offer->motor->year ?? '-' }} • {{ $offer->motor->city?->name ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="py-3">
                                        <div class="font-medium">{{ $offer->buyer->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $offer->buyer->email }}</div>
                                    </td>

                                    <td class="py-3 text-right font-semibold">Rp {{ number_format($offer->amount,0,',','.') }}</td>

                                    <td class="py-3 text-center">
                                        @php
                                            $classes = $offer->status === 'accepted' ? 'bg-green-100 text-green-800' : ($offer->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800');
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-sm {{ $classes }}">{{ ucfirst($offer->status) }}</span>
                                    </td>

                                    <td class="py-3">
                                        <div class="text-sm">{{ $offer->created_at->format('d/m/Y H:i') }}</div>
                                        <div class="text-xs text-gray-500">{{ $offer->created_at->diffForHumans() }}</div>
                                    </td>

                                    <td class="py-3 text-center">
                                        @if($offer->status === 'pending')
                                            <div class="flex items-center justify-center gap-2">
                                                <form action="{{ route('offers.update.status', $offer) }}" method="POST" class="inline">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button class="btn btn-success btn-sm">Terima</button>
                                                </form>
                                                <form action="{{ route('offers.update.status', $offer) }}" method="POST" class="inline">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button class="btn btn-danger btn-sm">Tolak</button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-600">{{ ucfirst($offer->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 flex justify-center">
                        {{ $offers->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>
</x-app-layout>