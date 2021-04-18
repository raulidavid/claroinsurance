<?php

namespace Madsis\Api\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function getImage($file) {
        // know you can have a mapping so you dont keep the sme names as in local (you can not precsise the same structor as the storage, you can do anything)

        // any permission handling or anything else
        //dd($file);
        // we check for the existing of the file
        $filePath ='';
        if (!Storage::disk('local')->exists($file)){ // note that disk()->exists() expect a relative path, from your disk root path. so in our example we pass directly the path (/…/laravelProject/storage/app) is the default one (referenced with the helper storage_path('app')
            abort('404'); // we redirect to 404 page if it doesn't exist
        }
        //file exist let serve it

        // if there is parameters [you can change the files, depending on them. ex serving different content to different regions, or to mobile and desktop …etc] // repetitive things can be handled through helpers [make helpers]

        return response()->file(storage_path('app'.DIRECTORY_SEPARATOR.($file))); // the response()->file() will add the necessary headers in our place (no headers are needed to be provided for images (it's done automatically) expected hearder is of form => ['Content-Type' => 'image/png'];

        // big note here don't use Storage::url() // it's not working correctly.
    }
}
