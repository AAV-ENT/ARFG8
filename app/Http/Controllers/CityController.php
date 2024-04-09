<?php

namespace App\Http\Controllers;

use App\Models\City;

use Illuminate\Http\Request;

class CityController extends Controller
{
    public function store($name)
    {
        $city = new City();
        $city->city = $name;

        $city->save();

        if ($city->save()) {
            return response()->json(['message' => 'City saved successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to save city'], 500);
        }
    }
}
