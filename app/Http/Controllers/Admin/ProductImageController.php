<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function upload($primaryImage, $images){
        
        $fileNamePrimaryImage = generateFileName( $primaryImage->getClientOriginalName());        
        $primaryImage->move(public_path(env('PRODUCT_IMAGE_UPLOAD_PATH')), $fileNamePrimaryImage);
        
        $fileNameImages = [];

        foreach($images as $image){
            $fileNameImage = generateFileName( $images->getClientOriginalName());        
            $image->move(public_path(env('PRODUCT_IMAGE_UPLOAD_PATH')), $fileNameImage);

            array_push($fileNameImages, $fileNameImage);
        }
        return ['fileNamePrimaryImage' => $fileNamePrimaryImage, 'fileNameImages' =>$fileNameImages];
    }
}
