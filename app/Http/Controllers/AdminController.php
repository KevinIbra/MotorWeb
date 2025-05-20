<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Motor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $data = [
            'totalUsers' => User::count(),
            'totalMotors' => Motor::count(),
            'pendingApprovals' => Motor::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', $data);
    }
}