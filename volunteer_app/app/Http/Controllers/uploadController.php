<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class uploadController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->photo;

        if ($request->hasFile('photo')) {
            return 201;
        }
        return 'success';
    }
}
