<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
   public function show($filename)
    {

        dd($filename);

        $path = "app/patient/profile/{$filename}";

        if (!Storage::exists($path)) {
            return response()->json(['message' => 'Image not found'], 404)
                ->header('Access-Control-Allow-Origin', 'http://localhost:3000');
        }

        $file = Storage::get($path);
        $mime = Storage::mimeType($path);

        return response($file, 200)
            ->header('Content-Type', $mime)
            ->header('Access-Control-Allow-Origin', 'http://localhost:3000')
            ->header('Access-Control-Allow-Credentials', 'true');
    }
}

