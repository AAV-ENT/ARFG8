<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\City;
use App\Models\Image;
use App\Models\Zone;

class PropertyController extends Controller
{
    public static function getCityName($id)
    {
        $cityData = DB::table('cities')
            ->select('city')
            ->where('id', $id)
            ->get();
        $city = json_decode(json_encode($cityData), true);
        return $city;
    }

    public static function getZone($id, $city)
    {
        $zoneData = DB::table('zone')
            ->select('name')
            ->where('id', $id)
            ->where('city', $city)
            ->get();
        $zone = json_decode(json_encode($zoneData), true);
        return $zone;
    }

    public static function getBackgroundImage($id)
    {
        $imgData = DB::table('images')
            ->select('imageName')
            ->where('property', $id)
            ->where('main', 1)
            ->get();
        $img = json_decode(json_encode($imgData), true);
        return $img;
    }

    public static function getAllInfo()
    {
        $cities = City::all();

        foreach ($cities as $city) {
            $zones   = Zone::where('city', $city['id'])->get();

            echo '<option value="' . $city['id'] . '" class="capitalize bg-[#222222] text-white">' . $city['city'] . '</option>';
            foreach ($zones as $zone) {
                echo '<option value="' . $city['id'] . '-' . $zone['id'] . '" class="capitalize bg-[#e3e3e3]">' . $zone['name'] . '</option>';
            }
        }
    }

    public function index()
    {
        $page     = request('page') != NULL ? request('page') : 0;

        $location = request('location');
        $minPrice = request('minPrice');
        $maxPrice = request('maxPrice');
        $minSpace = request('minSpace');
        $maxSpace = request('maxSpace');
        $minRooms = request('minRooms');
        $maxRooms = request('maxRooms');

        $gatherInfo = Property::orderBy('id');
        $showAll = false;

        if ($location) {
            if (str_contains($location, '-')) {
                $splitString = explode("-", $location);
                $city = $splitString[0];
                $zone = $splitString[1];
                $gatherInfo
                    ->where('city', $city)
                    ->where('nh', $zone);
            } else {
                $gatherInfo->where('city', $location);
            }
            $showAll = true;
        }

        if ($minPrice) {
            $gatherInfo->where('price', '>=', $minPrice);
            $showAll = true;
        }

        if ($maxPrice) {
            $gatherInfo->where('price', '<=', $maxPrice);
            $showAll = true;
        }

        if ($minSpace) {
            $gatherInfo->where('space', '>=', $minSpace);
            $showAll = true;
        }

        if ($maxSpace) {
            $gatherInfo->where('space', '<=', $maxSpace);
            $showAll = true;
        }

        if ($minRooms) {
            $gatherInfo->where('rooms', '>=', $minRooms);
            $showAll = true;
        }

        if ($maxRooms) {
            $gatherInfo->where('rooms', '<=', $maxRooms);
            $showAll = true;
        }

        $totalRows = $gatherInfo->count();

        if ($showAll != true) {
            $gatherInfo = $gatherInfo->skip($page * 8)
                ->take(8)
                ->get();
        } else {
            $gatherInfo = $gatherInfo->get();
        }


        $searchInfo = [$location, $minPrice, $maxPrice, $minSpace, $maxSpace, $minRooms, $maxRooms, $page];

        if ($totalRows % 8 == 0) {
            $pages = $totalRows / 8;
        } else {
            $pages = $totalRows / 8 + 1;
        }

        $currentUrl = $_SERVER["REQUEST_URI"];

        return view('list', [
            'searchInfo' => $searchInfo,
            'gatherInfo' => $gatherInfo,
            'page'       => $page,
            'pages'      => round($pages),
            'currentURL' => $currentUrl,
            'showAll'    => $showAll
        ]);
    }

    public function modify($id)
    {
    }
}
