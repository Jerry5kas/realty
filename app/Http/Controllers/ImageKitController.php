<?php

namespace App\Http\Controllers;

use App\Services\ImageKitService;
use Illuminate\Http\Request;

class ImageKitController extends Controller
{
    protected $imageKitService;

    public function __construct(ImageKitService $imageKitService)
    {
        $this->imageKitService = $imageKitService;
    }

    public function auth()
    {
        try {
            $authParams = $this->imageKitService->getAuthenticationParameters();
            
            return response()->json($authParams);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function upload(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|image|max:10240',
            ]);

            $file = $request->file('file');
            $fileName = $request->input('fileName', $file->getClientOriginalName());
            $folder = $request->input('folder', '/properties');

            $response = $this->imageKitService->upload($file, $fileName, $folder);

            // ImageKit SDK returns Response object with result property
            $result = $response->result ?? $response;
            
            $url = $result->url ?? null;
            $fileId = $result->fileId ?? null;
            $name = $result->name ?? $fileName;

            if (!$url) {
                throw new \Exception('No URL in response');
            }

            return response()->json([
                'success' => true,
                'url' => $url,
                'fileId' => $fileId,
                'name' => $name
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid file: ' . implode(', ', $e->errors()['file'] ?? ['Unknown error'])
            ], 422);
        } catch (\Exception $e) {
            \Log::error('ImageKit upload failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
