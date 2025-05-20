<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Motor;

class BuyerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $data = [
            'myMotors' => Motor::where('user_id', Auth::id())->count(),
            'savedMotors' => 0 // You'll need to implement saved motors functionality
        ];

        return view('buyer.dashboard', $data);
    }
}