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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $motors = Motor::with(['maker', 'motorModel', 'images'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10); // Changed from get() to paginate()

        return view('motor.index', compact('motors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makers = Maker::orderBy('name')->get();
        $motorTypes = MotorType::orderBy('name')->get();
        $fuelTypes = FuelType::orderBy('name')->get();
        $cities = City::orderBy('name')->get();

        return view('motor.create', compact('makers', 'motorTypes', 'fuelTypes', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'maker_id' => 'required|exists:makers,id',
                'model_id' => 'required|exists:motor_models,id',
                'year' => 'required|integer|min:1990|max:' . date('Y'),
                'price' => 'required|numeric|min:0',
                'vin' => 'nullable|string|max:255',
                'mileage' => 'required|integer|min:0',
                'motor_type_id' => 'required|exists:motor_types,id',
                'fuel_type_id' => 'required|exists:fuel_types,id',
                'city_id' => 'required|exists:cities,id',
                'address' => 'required|string',
                'phone_number' => 'required|string|max:20',
                'description' => 'required|string',
                'images' => 'required|array|min:1',
                'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $motor = Motor::create([
                'user_id' => Auth::id(),
                'maker_id' => $validated['maker_id'],
                'model_id' => $validated['model_id'],
                'year' => $validated['year'],
                'price' => $validated['price'],
                'vin' => $validated['vin'],
                'mileage' => $validated['mileage'],
                'motor_type_id' => $validated['motor_type_id'],
                'fuel_type_id' => $validated['fuel_type_id'],
                'city_id' => $validated['city_id'],
                'address' => $validated['address'],
                'phone_number' => $validated['phone_number'],
                'description' => $validated['description'],
                'published_at' => now(),
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $imageFile) {
                    // Store image in public storage
                    $path = $imageFile->store('motors', 'public');
                    
                    $image = $motor->images()->create([
                        'path' => $path,
                        'is_primary' => $index === 0 // First image is primary
                    ]);

                    // Set first image as primary in motor table
                    if ($index === 0) {
                        $motor->update(['primary_image_id' => $image->id]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('motor.index')->with('success', 'Motor berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating motor: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menambahkan motor. Silakan coba lagi. ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Motor $motor)
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
        
        $notifications = collect();
        if (auth()->check()) {
            $user = auth()->user();

            // tandai unread notifikasi untuk motor ini sebagai terbaca
            $user->unreadNotifications()
                ->where('data->motor_id', $motor->id)
                ->get()
                ->markAsRead();

            // ambil semua notifikasi (read & unread) yang terkait motor ini untuk user
            $notifications = $user->notifications()
                ->where('data->motor_id', $motor->id)
                ->latest()
                ->get();
        }

        return view('motor.show', compact('motor', 'notifications'));
    }

    /*
     * Show the form for editing the specified resource.
     */
    public function edit(Motor $motor)
    {
        $makers = Maker::orderBy('name')->get();
        $models = MotorModel::where('maker_id', $motor->maker_id)
            ->orderBy('name')
            ->get();
        $motorTypes = MotorType::orderBy('name')->get();
        $fuelTypes = FuelType::orderBy('name')->get();
        $cities = City::orderBy('name')->get();

        return view('motor.edit', compact(
            'motor',
            'makers',
            'models',
            'motorTypes',
            'fuelTypes',
            'cities'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Motor $motor)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'maker_id' => 'required|exists:makers,id',
                'model_id' => 'required|exists:motor_models,id',
                'year' => 'required|integer|min:1990|max:' . date('Y'),
                'price' => 'required|numeric|min:0',
                'vin' => 'nullable|string|max:255',
                'mileage' => 'required|integer|min:0',
                'motor_type_id' => 'required|exists:motor_types,id',
                'fuel_type_id' => 'required|exists:fuel_types,id',
                'city_id' => 'required|exists:cities,id',
                'address' => 'required|string',
                'phone_number' => 'required|string|max:20',
                'description' => 'required|string',
            ]);

            // Update motor details
            $motor->update($validated);

            // Handle new images if uploaded
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $imageFile) {
                    $path = $imageFile->store('motors', 'public');
                    $motor->images()->create([
                        'path' => $path,
                        'is_primary' => false
                    ]);
                }
            }

            // Handle existing images
            if ($request->has('existing_images')) {
                $motor->images()
                    ->whereNotIn('id', $request->existing_images)
                    ->delete();
            }

            DB::commit();

            // Redirect to 'motorku' route with success message
            return redirect()->route('motorku')
                ->with('success', 'Motor berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating motor: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal memperbarui motor. Silakan coba lagi.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Motor $motor)
    {
        try {
            // Check if user owns this motor
            if ($motor->user_id !== Auth::id()) {
                return redirect()->route('motorku')
                    ->with('error', 'Unauthorized action.');
            }

            // Delete images first
            foreach ($motor->images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }

            // Delete the motor
            $motor->delete();

            return redirect()->route('motorku')
                ->with('success', 'Motor berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()->route('motorku')
                ->with('error', 'Gagal menghapus motor: ' . $e->getMessage());
        }
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
        $motors = Motor::with(['maker', 'motorModel', 'primaryImage'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('motor.mylist', compact('motors'));
    }

    public function favorites()
    {
        $motors = Auth::user()->favouriteMotors()
            ->with(['maker', 'motorModel', 'primaryImage'])
            ->latest('favourite_motor.created_at')
            ->paginate(12);

        return view('motor.favorites', compact('motors'));
    }

    public function watchlist()
    {
        $motors = Auth::user()->favouriteMotors()
            ->with(['primaryImage', 'city', 'motorType', 'fuelType', 'maker', 'motorModel'])
            ->latest('favourite_motor.created_at')
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
        $user = Auth::user();
        
        if ($motor->isFavouritedBy($user)) {
            $user->favouriteMotors()->detach($motor->id);
            $message = 'Motor dihapus dari favorit';
        } else {
            $user->favouriteMotors()->attach($motor->id);
            $message = 'Motor ditambahkan ke favorit';
        }

        return back()->with('success', $message);
    }

}
