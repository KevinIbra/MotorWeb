@auth
<div class="relative">
    @php
        $unread = auth()->user()->unreadNotifications;
        $unreadCount = $unread->count();
        $latest = auth()->user()->notifications()->latest()->take(5)->get();
    @endphp

    <a href="{{ route('notifications.index') }}" class="inline-flex items-center gap-2 text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        <span class="sr-only">Notifikasi</span>
        @if($unreadCount > 0)
            <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-medium bg-red-600 text-white rounded-full">
                {{ $unreadCount }}
            </span>
        @endif
    </a>

    <div class="absolute right-0 mt-2 w-80 bg-white border rounded shadow-lg z-50 hidden md:block" id="notif-dropdown">
        <div class="p-3 border-b">
            <div class="flex items-center justify-between">
                <div class="font-semibold">Notifikasi</div>
                <a href="{{ route('notifications.index') }}" class="text-sm text-blue-600">Lihat Semua</a>
            </div>
        </div>

        <div class="max-h-64 overflow-y-auto">
            @forelse($latest as $n)
                @php $data = $n->data; @endphp
                <a href="{{ $data['url'] ?? '#' }}" class="block p-3 hover:bg-gray-50 {{ $n->read_at ? 'opacity-80' : 'bg-gray-50' }}">
                    <div class="text-sm font-medium">{{ $data['motor_title'] ?? 'Penawaran' }}</div>
                    <div class="text-xs text-gray-600">
                        {{ ucfirst($data['status'] ?? '') }} — Rp {{ number_format($data['amount'] ?? 0,0,',','.') }}
                    </div>
                </a>
            @empty
                <div class="p-3 text-sm text-gray-600">Belum ada notifikasi</div>
            @endforelse
        </div>
    </div>
</div>

<script>
document.addEventListener('click', function(e){
    const dropdown = document.getElementById('notif-dropdown');
    const anchor = dropdown?.previousElementSibling;
    if (!anchor) return;
    if (anchor.contains(e.target)) {
        dropdown.classList.toggle('hidden');
    } else if (!dropdown.contains(e.target)) {
        dropdown.classList.add('hidden');
    }
});
</script>
@endauth