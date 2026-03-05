<?php

namespace App\Services;

use ImageKit\ImageKit;

class ImageKitService
{
    protected $imageKit;

    public function __construct()
    {
        $this->imageKit = new ImageKit(
            config('imagekit.public_key'),
            config('imagekit.private_key'),
            config('imagekit.url_endpoint')
        );
    }

    /**
     * Get ImageKit instance
     */
    public function getImageKit()
    {
        return $this->imageKit;
    }

    /**
     * Generate image URL with transformations
     */
    public function url($path, $transformations = [])
    {
        return $this->imageKit->url([
            'path' => $path,
            'transformation' => $transformations
        ]);
    }

    /**
     * Upload file to ImageKit
     */
    public function upload($file, $fileName, $folder = '')
    {
        $fileContent = base64_encode(file_get_contents($file->getRealPath()));
        
        $response = $this->imageKit->uploadFile([
            'file' => $fileContent,
            'fileName' => $fileName,
            'folder' => $folder,
            'useUniqueFileName' => true
        ]);
        
        return $response;
    }

    /**
     * Get authentication parameters for client-side upload
     */
    public function getAuthenticationParameters()
    {
        return $this->imageKit->getAuthenticationParameters();
    }

    /**
     * Delete file from ImageKit
     */
    public function delete($fileId)
    {
        return $this->imageKit->deleteFile($fileId);
    }

    /**
     * List files from ImageKit
     */
    public function listFiles($options = [])
    {
        return $this->imageKit->listFiles($options);
    }
}
