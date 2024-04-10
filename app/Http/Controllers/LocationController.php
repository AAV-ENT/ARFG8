<?php

namespace App\Http\Controllers;

use App\Models\Location;

use Illuminate\Http\Request;


class LocationController extends Controller
{
    public function store($lat, $long, $id)
    {
        $location = new Location();

        $location->lat = $lat;
        $location->lng = $long;
        $location->property = $id;

        $location->save();

        if ($location->save()) {
            return response()->json(['message' => 'Location saved'], 200);
        } else {
            return response()->json(['message' => 'Failed to save location'], 500);
        }
    }
}
