<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\User;
use App\Models\MotorModel;
use App\Models\Maker;
use App\Models\State;
use App\Models\City;
use App\Models\FuelType;
use App\Models\MotorFavorite;
use App\Models\MotorType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 

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
        try {
            // Validate the request
            $validated = $request->validate([
                'maker_id' => 'required|exists:makers,id',
                'model_id' => 'required|string|max:255',
                'year' => 'required|integer|min:1990|max:' . date('Y'),
                'motor_type' => 'required|string',
                'price' => 'required|numeric',
                'vin_code' => 'required|string|max:255',
                'kilometers' => 'required|numeric',
                'fuel_type' => 'required|string',
                'state_id' => 'required|exists:states,id',
                'city_text' => 'required|string|max:255',
                'address' => 'required|string',
                'phone_number' => 'required|string',
                'description' => 'required|string',
                'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048', // max 2MB per image
            ]);

            // Create new motor
            $motor = new Motor();
            $motor->user_id = Auth::id();
            $motor->maker_id = $request->maker_id;
            $motor->model_id = $request->model_text;
            $motor->year = $request->year;
            $motor->motor_type = $request->motor_type;
            $motor->price = $request->price;
            $motor->vin_code = $request->vin_code;
            $motor->kilometers = $request->kilometers;
            $motor->fuel_type = $request->fuel_type;
            $motor->state_id = $request->state_id;
            $motor->city_id = $request->city_id;
            $motor->address = $request->address;
            $motor->phone_number = $request->phone_number;
            $motor->description = $request->description;
            $motor->published = $request->has('published');
            $motor->save();

            // Handle image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $imageFile) {
                    $path = $imageFile->store('motor-images', 'public');
                    
                    $motor->images()->create([
                        'image_path' => $path,
                        'is_primary' => $motor->images()->count() === 0 // First image is primary
                    ]);
                }
            }

            return redirect()->route('motor.index')
                ->with('success', 'Motor berhasil ditambahkan!');

        } catch (\Exception $e) {
            Log::error('Failed to store motor: ' . $e->getMessage());
            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menambahkan motor. Silakan coba lagi.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Motor $motor)
    {
        $motor->load([
            'maker', 
            'motorModel', 
            'city', 
            'motorType', 
            'fuelType', 
            'primaryImage', 
            'images',
            'features'
        ]);
        
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

    public function search(Request $request)
    {
        $query = Motor::query()
            ->with(['primaryImage', 'maker', 'motorModel', 'motorType', 'fuelType'])
            ->where('published_at', '<', now());

        // Apply filters
        if ($request->filled('maker_id')) {
            $query->where('maker_id', $request->maker_id);
        }

        if ($request->filled('model_id')) {
            $query->where('model_id', $request->model_id);
        }

        if ($request->filled('motor_type_id')) {
            $query->where('motor_type_id', $request->motor_type_id);
        }

        if ($request->filled('year_from')) {
            $query->where('year', '>=', $request->year_from);
        }

        if ($request->filled('year_to')) {
            $query->where('year', '<=', $request->year_to);
        }

        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        if ($request->filled('mileage')) {
            $query->where('mileage', '<=', $request->mileage);
        }

        if ($request->filled('fuel_type_id')) {
            $query->where('fuel_type_id', $request->fuel_type_id);
        }

        // Apply sorting
        switch ($request->get('sort')) {
            case 'price':
                $query->orderBy('price', 'desc');
                break;
            case '-price':
                $query->orderBy('price', 'asc');
                break;
            default:
                $query->latest('published_at');
        }

        $motors = $query->paginate(12)->withQueryString();

        return view('motor.search', [
            'motors' => $motors,
            'makers' => Maker::orderBy('name')->get(),
            'motorTypes' => MotorType::orderBy('name')->get(),
            'fuelTypes' => FuelType::orderBy('name')->get(),
        ]);
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
        $favoriteMotors = auth()->user()->favoritedMotors()
            ->with(['maker', 'motorModel', 'primaryImage'])
            ->latest()
            ->paginate(12);

        return view('motor.favorites', compact('favoriteMotors'));
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
    $models = MotorModel::where('maker_id', $makerId)
        ->orderBy('name')
        ->get(['id', 'name']);
    
    return response()->json($models);
}

public function getModelsByMaker($makerId)
{
    try {
        $models = MotorModel::where('maker_id', $makerId)
                           ->orderBy('name')
                           ->get(['id', 'name']);
        
        return response()->json($models);
    } catch (\Exception $e) {
        Log::error('Error fetching models: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to load models'], 500);
    }
}

public function toggleFavorite(Motor $motor)
{
    $user = auth()->user();
    $favorite = MotorFavorite::where('user_id', $user->id)
        ->where('motor_id', $motor->id)
        ->first();

    if ($favorite) {
        $favorite->delete();
    } else {
        MotorFavorite::create([
            'user_id' => $user->id,
            'motor_id' => $motor->id
        ]);
    }

    return back();
}

}
