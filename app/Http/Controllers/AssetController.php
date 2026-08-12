<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AssetController extends Controller
{
    public function css(): BinaryFileResponse
    {
        return response()->file(public_path('assets/css/app.css'), [
            'Content-Type' => 'text/css; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    public function javascript(): BinaryFileResponse
    {
        return response()->file(public_path('assets/js/app.js'), [
            'Content-Type' => 'application/javascript; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
