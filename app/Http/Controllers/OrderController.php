<!-- ...existing form markup... -->
<div class="form-group">
  <label>Spesifikasi Motor</label>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
    <input type="text" name="engine_capacity" class="form-control" placeholder="Kapasitas Mesin (cc)" value="{{ old('engine_capacity', $motor->engine_capacity ?? '') }}">
    <select name="transmission" class="form-control">
      <option value="">Pilih Transmisi</option>
      <option value="manual" {{ old('transmission', $motor->transmission ?? '') === 'manual' ? 'selected' : '' }}>Manual</option>
      <option value="automatic" {{ old('transmission', $motor->transmission ?? '') === 'automatic' ? 'selected' : '' }}>Automatic</option>
      <option value="cvt" {{ old('transmission', $motor->transmission ?? '') === 'cvt' ? 'selected' : '' }}>CVT</option>
      <option value="other" {{ old('transmission', $motor->transmission ?? '') === 'other' ? 'selected' : '' }}>Lainnya</option>
    </select>
    <input type="text" name="color" class="form-control" placeholder="Warna" value="{{ old('color', $motor->color ?? '') }}">
    <select name="condition" class="form-control">
      <option value="">Kondisi</option>
      <option value="new" {{ old('condition', $motor->condition ?? '') === 'new' ? 'selected' : '' }}>Baru</option>
      <option value="used" {{ old('condition', $motor->condition ?? '') === 'used' ? 'selected' : '' }}>Bekas</option>
      <option value="like_new" {{ old('condition', $motor->condition ?? '') === 'like_new' ? 'selected' : '' }}>Hampir Baru</option>
    </select>
    <input type="number" name="kilometers" class="form-control" placeholder="Kilometer (km)" value="{{ old('kilometers', $motor->kilometers ?? '') }}" min="0">
  </div>

  <label class="block mt-3">Fitur (centang)</label>
  @php
    $featureList = ['ABS','Alarm','Original Paint','Electric Start','Bagasi','GPS'];
    $selected = old('features', $motor->features ?? []);
  @endphp
  <div class="flex gap-2 flex-wrap">
    @foreach($featureList as $feat)
      <label class="inline-flex items-center mr-3">
        <input type="checkbox" name="features[]" value="{{ $feat }}" {{ in_array($feat, (array)$selected) ? 'checked' : '' }}>
        <span class="ml-2">{{ $feat }}</span>
      </label>
    @endforeach
    <input type="text" name="features[]" placeholder="Fitur lain..." class="form-control mt-2" />
  </div>
</div>
<!-- ...existing form markup... --><?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $buyerOrders = Order::with(['motor', 'seller'])
            ->where('buyer_id', Auth::id())
            ->latest()
            ->paginate(10);

        $sellerOrders = Order::with(['motor', 'buyer'])
            ->where('seller_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('buyerOrders', 'sellerOrders'));
    }

    public function store(Request $request, Motor $motor)
    {
        if ($motor->user_id === Auth::id()) {
            return back()->with('error', 'You cannot order your own motor');
        }

        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'motor_id' => $motor->id,
            'buyer_id' => Auth::id(),
            'seller_id' => $motor->user_id,
            'total_price' => $motor->price,
            'status' => 'pending',
            'notes' => $request->notes
        ]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order berhasil dibuat');
    }

    public function show(Order $order)
    {
        if ($order->buyer_id !== Auth::id() && $order->seller_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        if ($order->seller_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:accepted,rejected,completed'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }
}