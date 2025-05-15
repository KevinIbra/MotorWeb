<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\User;
use App\Models\MotorModel;
use App\Models\Maker;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MotorController extends Controller
{
    /**
     * Apply middleware to the controller.
     */
    public function __construct()
    {
        // Remove this line since we'll use route middleware instead
        // $this->middleware('auth')->except(['index', 'show', 'search']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if user is authenticated first
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $motors = Motor::with(['maker', 'motorModel', 'primaryImage'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
            
        return view('motor.index', compact('motors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'makers' => Maker::orderBy('name')->get(),
            'motorModels' => MotorModel::with('maker')
                            ->select('id', 'maker_id', 'name')
                            ->orderBy('name')
                            ->get(),
            'states' => State::orderBy('name')->get(),
            'cities' => City::orderBy('name')->get()
        ];

        return view('motor.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Motor $motor)
    {
       

        $motor->load(['maker', 'motorModel', 'city', 'motorType', 'fuelType', 'primaryImage', 'images']);
        return view('motor.show', ['motor' => $motor]);
    }

    /*
     * Show the form for editing the specified resource.
     */
    public function edit(Motor $motor)
    {
        return view('motor.edit', ['motor' => $motor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motor $motor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motor $motor)
    {
        //
    }

    public function search()
    {
        $query = Motor::where('published_at', '<', now())
        ->with(['primaryImage', 'city', 'motorType', 'fuelType', 'maker', 'motorModel'])
        ->orderBy('published_at', 'desc');

        $motors = $query->paginate(15);

        // $motorCount = $query->count();

        // $motors = $query->limit(30)->get();

        // dd($motors [0]);

        return view('motor.search', ['motors'=> $motors]);
    }

    public function myList()
    {
        // Get all motors belonging to the logged-in user
        $motors = Motor::where('user_id', Auth::id())
                      ->orderBy('created_at', 'desc')
                      ->paginate(10);

        return view('motor.mylist', compact('motors'));
    }

    public function favorites()
    {
        return view('motor.favourites');
    }

    public function watchlist()
    {
        $motors = User::find(5)
        ->favouriteMotors()
        ->with(['primaryImage', 'city', 'motorType', 'fuelType', 'maker', 'motorModel'])
        ->paginate(15);
        return view('motor.watchlist', ['motors' => $motors]);
    }

 

public function getModels($makerId)
{
    $models = MotorModel::where('maker_id', $makerId)->get();

    return response()->json($models);
}

public function getModelsByMaker($makerId)
{
    try {
        $models = MotorModel::where('maker_id', $makerId)
                           ->select('id', 'name')
                           ->orderBy('name')
                           ->get();
        
        return response()->json($models);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to fetch models'], 500);
    }
}

}
