<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class uploadController extends Controller
{
    public function store(Request $request)
    {
        $extension = $request->file('uploaded_file')->extension();
        $mimeType = $request->file('uploaded_file')->getMimeType();
        $path = Storage::putFileAs('uploads', $request->file('uploaded_file'), time().'.'.$extension, 'public');

        ddd($extension,$mimeType,$path);
        return 'success';
    }
}
