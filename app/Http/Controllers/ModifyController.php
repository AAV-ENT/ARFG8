<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Property;
use App\Models\Location;
use App\Models\City;
use App\Models\Image;
use App\Models\Spec;

class ModifyController extends Controller
{
    public function index($id)
    {
        $property = Property::where('id', $id)->get();
        $propertyInfo = json_decode(json_encode($property), true);

        $location = Location::where('property', $id)->get();
        $locationInfo = json_decode(json_encode($location), true);

        $city = City::orderBy('id')->get();
        $cityInfo = json_decode(json_encode($city), true);

        $specs = Spec::where('property', $id)->get();
        $specInfo = json_decode(json_encode($specs), true);
        if (sizeof($specInfo) > 0) {
            $nameArray = array_column($specInfo, 'name');
            $combinedString = implode("; ", $nameArray);
        } else {
            $combinedString = '';
        }

        $images = Image::where('property', $id)->get();
        $imagesInfo = json_decode(json_encode($images), true);

        return view('modify', [
            'propertyInfo' => $propertyInfo,
            'locationInfo' => $locationInfo,
            'cityInfo'     => $cityInfo,
            'specInfo'     => $combinedString,
            'imagesInfo'   => $imagesInfo
        ]);
    }
}
