<x-app-layout title="Notifikasi">
    <main class="container py-6">
        <div class="card">
            <div class="card-header flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold">Notifikasi</h2>
                    <p class="text-sm text-gray-600 mt-1">Notifikasi terbaru tentang penawaran Anda</p>
                </div>

                <form action="{{ route('notifications.markAll') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-secondary">Tandai Semua Terbaca</button>
                </form>
            </div>

            <div class="card-body">
                @if($notifications->isEmpty())
                    <div class="py-8 text-center text-gray-600">Belum ada notifikasi</div>
                @else
                    <div class="divide-y">
                        @foreach($notifications as $n)
                            @php $data = $n->data; @endphp
                            <a href="{{ $data['url'] ?? '#' }}" class="block p-4 hover:bg-gray-50">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <div class="font-medium">{{ $data['motor_title'] ?? 'Penawaran' }}</div>
                                        <div class="text-sm text-gray-600">
                                            {{ ucfirst($data['status'] ?? '') }} — Rp {{ number_format($data['amount'] ?? 0,0,',','.') }}
                                        </div>
                                        @if(!empty($data['message']))
                                            <div class="text-sm text-gray-500 mt-1">{{ \Illuminate\Support\Str::limit($data['message'], 120) }}</div>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-400 text-right">
                                        {{ $n->created_at->format('d/m/Y H:i') }}<br>
                                        <span class="text-sm">{{ $n->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-4">
                        {{ $notifications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>
</x-app-layout>