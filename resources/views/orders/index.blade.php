<x-app-layout title="Pesanan">
    <div class="container py-6">
        <!-- Buyer Orders -->
        <div class="card mb-6">
            <div class="card-header">
                <h2 class="text-xl font-semibold">Pesanan Saya</h2>
            </div>
            <div class="card-body">
                @if($buyerOrders->isEmpty())
                    <p class="text-center py-4">Belum ada pesanan</p>
                @else
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No. Pesanan</th>
                                    <th>Motor</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($buyerOrders as $order)
                                    <tr>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->motor->year }} {{ $order->motor->maker->name }}</td>
                                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td>{{ ucfirst($order->status) }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('orders.show', $order) }}" 
                                               class="btn btn-primary btn-sm">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $buyerOrders->links() }}
                @endif
            </div>
        </div>

        <!-- Seller Orders -->
        @if($sellerOrders->count() > 0)
        <div class="card">
            <div class="card-header">
                <h2 class="text-xl font-semibold">Pesanan Masuk</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No. Pesanan</th>
                                <th>Pembeli</th>
                                <th>Motor</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sellerOrders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->buyer->name }}</td>
                                    <td>{{ $order->motor->year }} {{ $order->motor->maker->name }}</td>
                                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($order->status) }}</td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order) }}" 
                                           class="btn btn-primary btn-sm">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $sellerOrders->links() }}
            </div>
        </div>
        @endif
    </div>
</x-app-layout>