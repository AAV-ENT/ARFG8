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
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $property->type = request('type');
        $property->saleType = request('selType');
        $property->name = request('title');
        $property->price = request('price');
        $property->comission = request('comission');
        $property->description = request('description');
        $property->city = request('city');
        $property->nh = request('nh');
        $property->rooms = request('rooms');
        $property->baths = request('baths');
        $property->space = request('space');
        $property->year = request('year');
        $property->exclusive = request('exclusive');

        $property->update();


        $elementNumber = 0;

        $mainExist = false;
        $allImages = Image::where('property', $id)->get();

        if (sizeof($allImages) > 0) {
            foreach ($allImages as $imageDetails) {
                if ($imageDetails['main'] == 1) {
                    $mainExist = true;
                    break;
                }
            }
        }


        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $name = $file->getClientOriginalName();
                if ($file->move(public_path('assets/img/properties/'), $name)) {
                    if ($elementNumber == 0 && $mainExist == false) {
                        $image = new Image();
                        $image->imageName = $name;
                        $image->property = $id;
                        $image->main = 1;

                        $elementNumber++;

                        $image->save();
                    } else {
                        $image = new Image();
                        $image->imageName = $name;
                        $image->property = $id;
                        $image->main = 0;

                        $image->save();
                    }
                }
            }
        }


        return redirect('/');
    }

    private function deleteSpecs($id)
    {
        Spec::where('property', $id)->delete();
    }

    public function updateSpec($param, $id)
    {
        // Delete existing specs for the property
        $this->deleteSpecs($id);

        // Initialize the spec counter
        $specNum = 0;

        // Split the parameter into an array of specs
        $specs = array_map('trim', explode(';', $param));

        // Loop through each spec
        foreach ($specs as $specName) {
            // Create a new Spec instance
            $spec = new Spec();

            // Set the spec attributes
            $spec->name = $specName;
            $spec->property = $id;

            // Save the spec
            if ($spec->save()) {
                $specNum++;
            }
        }

        // Check if all specs were saved successfully
        if ($specNum == sizeof($specs)) {
            return response()->json(['message' => 'Specs saved successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to save specs'], 500);
        }
    }

    public function updateLocation($lat, $long, $id)
    {
        $location = Location::findOrFail($id);

        $location->lat = $lat;
        $location->lng = $long;
        $location->property = $id;

        $location->update();

        if ($location->update()) {
            return response()->json(['message' => 'Location updated'], 200);
        } else {
            return response()->json(['message' => 'Failed to updated location'], 500);
        }
    }

    public function updateProperty($id)
    {
        $property = Property::findOrFail($id);

        $property->active = 0;

        $property->update();

        return redirect('/');
    }
}
