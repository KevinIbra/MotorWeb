<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OfferStatusUpdated;

class OfferController extends Controller

{
    public function store(Request $request, Motor $motor)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'message' => 'nullable|string|max:1000',
        ]);

        if ($motor->user_id === Auth::id()) {
            return back()->with('error', 'Tidak bisa menawar motor sendiri.');
        }

        Offer::create([
            'motor_id' => $motor->id,
            'buyer_id' => Auth::id(),
            'amount' => $request->amount,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Penawaran terkirim. Tunggu respon penjual.');
    }

    public function sellerIndex()
    {
        $offers = Offer::with(['motor','buyer'])
            ->whereHas('motor', fn($q) => $q->where('user_id', Auth::id()))
            ->latest()
            ->paginate(12);

        return view('offers.seller_index', compact('offers'));
    }

    public function updateStatus(Request $request, Offer $offer)
    {
        if ($offer->motor->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:accepted,rejected'
        ]);

        $offer->update(['status' => $request->status]);

        // kirim notifikasi in-app + email ke pembeli
        $buyer = $offer->buyer;
        if ($buyer) {
            $buyer->notify(new OfferStatusUpdated($offer));
        }

        return back()->with('success', 'Status penawaran diperbarui dan pembeli diberi notifikasi.');
    }
    
}