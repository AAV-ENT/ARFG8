<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Property;
use App\Models\City;
use App\Models\Image;
use App\Models\Zone;

class ZoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function getCityName($id)
    {
        $cityData = DB::table('cities')
            ->select('city')
            ->where('id', $id)
            ->get();
        $city = json_decode(json_encode($cityData), true);
        return $city;
    }

    public function index()
    {
        $cities = City::orderBy('city')->get();

        return view(
            'zone',
            [
                'cities' => $cities
            ]
        );
    }

    public function store($cityId, $name)
    {
        $zone = new Zone();
        $zone->name = $name;
        $zone->city = $cityId;

        $zone->save();

        if ($zone->save()) {
            return response()->json(['message' => 'Zone saved successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to save Zone'], 500);
        }
    }
}
