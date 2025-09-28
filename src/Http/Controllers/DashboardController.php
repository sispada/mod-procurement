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
            $fileslug = $request->slug;
            $filename = $request->uuid . $request->extension;
            $filepath = $fileslug . DIRECTORY_SEPARATOR . $filename;

            if (Storage::disk('uploads')->putFileAs($fileslug, $request->file('file'), $filename)) {
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

    /**
     * download function
     *
     * @param Request $request
     * @return void
     */
    public function download(Request $request)
    {
        if (!Storage::disk('uploads')->exists($request->path)) {
            return response()->json([
                'success' => false,
                'message' => 'File not found'
            ], 404);
        }

        return optional(Storage::disk('uploads'))->download($request->path, 'sk-ppk.pdf', [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="sample.pdf"',
        ]);
    }

    /**
     * destroy function
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        if (!Storage::disk('uploads')->exists($request->path)) {
            return response()->json([
                'success' => false,
                'message' => 'File not found'
            ], 404);
        }

        if (Storage::disk('uploads')->delete($request->path)) {
            return response()->json([
                'success' => true,
                'message' => 'Hapus file dari server berhasil.'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Hapus file dari server gagal.'
        ], 500);
    }
}
