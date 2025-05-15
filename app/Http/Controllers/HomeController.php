<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $motors = Motor::with(['primaryImage', 'maker', 'motorModel'])
            ->where('published_at', '<', now())
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('home.index', compact('motors'));
    }
}
