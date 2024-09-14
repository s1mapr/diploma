<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocsController extends Controller
{
    public function getDocs(Request $request)
    {
        return view('vendor.swagger.ui', [
            'url' => Storage::disk('openapi')->url('index.yaml'),
        ]);
    }
}
