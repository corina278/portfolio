<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    public function download(Request $request)
    {
        // @TODO add this to Storage controller
        // call this with {url : application.cv}
        // in Vue, gotta do smt like window.redirect('download', {url: application.cv});
        Storage::download($request->url);
    }}
