<?php

namespace App\Utilities;

use Intervention\Image\ImageManager;

class ImageUploader {
    protected $manager;

    public function __construct() {
        $this->manager = new ImageManager(['driver' => 'gd']);
    }

    public function upload($filePath, $destination, $width = null, $height = null) {
        $image = $this->manager->make($filePath);
        if ($width && $height) {
            $image->fit($width, $height);
        }
        $filename = basename($filePath);
        $path = rtrim($destination, '/') . '/' . $filename;
        $image->save($path);
        return $path;
    }
}
