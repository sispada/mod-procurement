<?php

namespace Module\Procurement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Module\Procurement\Models\ProcurementDocument;

class DashboardController extends Controller
{
    /**
     * index function
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request): void
    {
        //
    }

    public function report(Request $request): void
    {
        //
    }

    /**
     * upload function
     *
     * @param Request $request
     * @return void
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => "required|file|max:2048"
        ]);

        if ($request->hasFile('file') && $request->file('file')) {
            $filename = $request->slug . DIRECTORY_SEPARATOR . $request->uuid . $request->extension;
            $filepath = $filename;

            if (Storage::disk('uploads')->put($filepath, $request->file('file'))) {
                return response()->json([
                    'path' => $filepath
                ], 200);
            }
        }

        return response()->json([
            'status' => 422,
            'message' => 'Upload file bermasalah'
        ], 422);
    }
}
