<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Image;

class ImageController extends Controller
{
    public function destroy($id)
    {
        $image = Image::findOrFail($id)->get();


        $image->delete();

        return redirect()->back();
    }
}