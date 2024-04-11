<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Image;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        if ($image['main'] == 0) {
            $image->delete();
        } else {
            $allImages = Image::where('property', $image['property'])->where('main', 0)->where('id', '!=', $id)->first();

            $allImages->imageName = $allImages['imageName'];
            $allImages->property = $allImages['property'];
            $allImages->main = 1;

            $allImages->update();
            $image->delete();
        }

        return redirect()->back();
    }
}
