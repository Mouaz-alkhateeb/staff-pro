<?php


namespace App\Application\Helpers;

use App\Domain\DTO\Media\CreateMediaDTO;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class UploadImageHelper
{

    public static function updloadFile($file, $model_id, $model_type)
    {
        $disk = 'public';
        $uuid = Str::random(9);
        $current = Carbon::now()->format('Ymd');
        $mainFileName = $current;
        $fileName = Storage::disk($disk)->put($mainFileName, $file);
        return self::saveFile($fileName, $file, $model_id, $model_type);
    }
    public static function uploadImage($image, $model_id, $model_type): CreateMediaDTO
    {

        $imageManager = new ImageManager();
        $imgFile = $imageManager->make($image->getRealPath())->encode('webp', 80);
        $thumbFile = $imageManager->make($image->getRealPath())->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('webp', 80);
        $disk = 'public';
        $uuid = Str::random(9);
        $current = Carbon::now()->format('Ymd');
        $mainImageName = $current . '/' . $uuid . '.webp';
        $thumbImageName = 'thumb/' . $current . '/' . $uuid . '.webp';
        Storage::disk($disk)->put($mainImageName, $imgFile->__toString());
        Storage::disk($disk)->put($thumbImageName, $thumbFile->__toString());
        return self::saveFile($mainImageName, $imgFile, $model_id, $model_type);
    }

    private static function saveFile($fileName, $image, $model_id, $model_type): CreateMediaDTO
    {
        $mediaDTO = new CreateMediaDTO();
        $mediaDTO->model_id = $model_id;
        $mediaDTO->model_type = $model_type;
        $mediaDTO->file_name = $fileName;
        $mediaDTO->name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $fileName);
        $mediaDTO->disk = 'public';
        return $mediaDTO;
    }

    public static function removeFile($path): bool
    {
        Storage::disk('public')->delete($path);
        return  !(Storage::disk('public')->exists($path));
    }
}