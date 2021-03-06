<?php

namespace App\Handlers;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

/**
 * Handler for image uploading.
 */
class ImageUploadHandler
{
    /*
    |--------------------------------------------------------------------------
    | Handle Image Upload
    |--------------------------------------------------------------------------
    |
    | This handler is responsible for handling user's image uploading
    | activities.
    | Uploaded images will be save under 'public' folder in a structured form.
    |
    */

    /**
     * What image extensions are allowed for uploading.
     *
     * @var array
     */
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    /**
     * Save uploaded images into 'public' folder, with a standard storage rule.
     *
     * @param UploadedFile $file: Image file rendered into UploadedFile object by Symfony.
     * @param string $folder: Image category.
     * @param string $file_prefix: prefix of image filename, can be the ID of the user who uploads this image.
     * @param boolean|double|int $max_width: Set the max width of the image, default is false, referring no max_width is set.
     * @return array|boolean return an array that stores image path is success; or 'false' when upload fails.
     */
    public function save($file, $folder, $file_prefix, $max_width = false)
    {
        // Construct folder path for images storage.
        // eg: uploads/images/avatars/201709/21/
        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());

        // image folders are stored under 'public' folder.
        // eg: /home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
        $upload_path = public_path() . '/' . $folder_name;

        // Autofix extension for images with no extension.
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // Construct image filename
        // eg: 1_1493521050_7BVc9v9ujP.png
        $filename = $file_prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        // Check file kind, if is not image, cancel uploading
        if (!in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // Move image to target path
        $file->move($upload_path, $filename);

        // If $max_width is set, crop image
        if ($max_width && $extension != 'gif') {
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }

        return [
            'path' => config('app.url') . "/$folder_name/$filename"
        ];
    }

    public function reduceSize($file_path, $max_width)
    {
        // Add image instance
        $image = Image::make($file_path);

        // Resize image
        $image->resize($max_width, null, function (Constraint $constraint) {

            // Adjust size, maintaining aspect ratio.
            $constraint->aspectRatio();

            // Prevent image zooming out when crop.
            $constraint->upsize();
        });

        // Save adjust result.
        $image->save();
    }
}
