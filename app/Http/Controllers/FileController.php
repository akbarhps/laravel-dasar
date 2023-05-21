<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{

    public function upload(Request $request): string
    {
        $file = $request->file('image');
        $file->storePubliclyAs('images', $file->getClientOriginalName(), 'public');
        return "OK " . $file->getClientOriginalName();
    }

}
