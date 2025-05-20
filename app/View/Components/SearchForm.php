<?php

namespace App\View\Components;

use App\Models\Maker;
use App\Models\MotorType;
use App\Models\FuelType;
use Illuminate\View\Component;

class SearchForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.search-form', [
            'makers' => Maker::orderBy('name')->get(),
            'motorTypes' => MotorType::orderBy('name')->get(),
            'fuelTypes' => FuelType::orderBy('name')->get(),
        ]);
    }
}