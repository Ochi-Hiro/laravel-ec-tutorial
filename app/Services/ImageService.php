<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageService
{
    public static function upload($imageFile, $folderName) 
    {
        // dd($imageFile);
        if(is_array($imageFile)) // 配列か判定し、それぞれ$fileに格納する
        {
            $file = $imageFile['image'];
        } else {
            $file = $imageFile;
        }

        $fileName = uniqid(rand().'_');
        $extension = $file->extension(); //拡張子を取得する
        $fileNameToStore = $fileName . '.' . $extension;
        $resizedImage = InterventionImage::make($file)->resize(1920, 1080)->encode();
        //InterventionImage::make($imageFile)でInterventionImageで使えるようになる。リサイズしてencodeで画像として扱うことができる。
        Storage::put('public/' . $folderName . '/' . $fileNameToStore, $resizedImage);
        //第1引数にフォルダ場所からのファイル名を指定。第2引数にリサイズした画像を指定する。

        return $fileNameToStore;
    }
}