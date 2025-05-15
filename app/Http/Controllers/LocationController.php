<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getCitiesByState($stateId)
    {
        $cities = City::where('state_id', $stateId)
                     ->orderBy('name')
                     ->get(['id', 'name']);
                     
        return response()->json($cities);
    }
}