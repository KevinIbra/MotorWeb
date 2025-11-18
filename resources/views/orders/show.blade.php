<x-app-layout title="Detail Pesanan">
    <div class="container py-6">
        <div class="card">
            <div class="card-header">
                <h2 class="text-xl font-semibold">Detail Pesanan #{{ $order->order_number }}</h2>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-semibold mb-2">Informasi Motor</h3>
                        <p>{{ $order->motor->year }} {{ $order->motor->maker->name }}</p>
                        <p>Harga: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        <p>Status: {{ ucfirst($order->status) }}</p>
                        <p>Tanggal Pesan: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold mb-2">
                            {{ Auth::id() === $order->buyer_id ? 'Informasi Penjual' : 'Informasi Pembeli' }}
                        </h3>
                        <p>Nama: {{ Auth::id() === $order->buyer_id ? $order->seller->name : $order->buyer->name }}</p>
                        <p>Email: {{ Auth::id() === $order->buyer_id ? $order->seller->email : $order->buyer->email }}</p>
                        @if($order->notes)
                            <p class="mt-4">Catatan: {{ $order->notes }}</p>
                        @endif
                    </div>
                </div>

                @if($order->seller_id === Auth::id() && $order->status === 'pending')
                    <div class="mt-6 flex gap-2">
                        <form action="{{ route('orders.update-status', $order) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="accepted">
                            <button type="submit" class="btn btn-success">Terima Pesanan</button>
                        </form>

                        <form action="{{ route('orders.update-status', $order) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn btn-danger">Tolak Pesanan</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>