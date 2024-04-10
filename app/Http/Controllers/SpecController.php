<?php

namespace App\Http\Controllers;

use App\Models\Spec;

use Illuminate\Http\Request;

class SpecController extends Controller
{
    public function store($params, $id)
    {
        $specNum = 0;
        $specs = array_map('trim', explode(';', $params));

        foreach ($specs as $spec) {
            $location = new Spec();
            $location->name = $spec;
            $location->property = $id;

            $location->save();

            if ($location->save()) $specNum++;
        }

        if ($specNum == sizeof($specs)) {
            return response()->json(['message' => 'Location saved'], 200);
        } else {
            return response()->json(['message' => 'Failed to save location'], 500);
        }
    }
}
