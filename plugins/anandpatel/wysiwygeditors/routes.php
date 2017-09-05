<?php

use Backend\Facades\BackendAuth;

/**
 * Filter to Authenticate Backend User
 */
Route::filter('authenticate', function()
{
    if (!BackendAuth::check()) {
        return "You don`t have permission to access this page!!!";
    }
});

/**
 * Routes for Froala
 */
Route::group(['before' => 'authenticate'], function()
{
    /**
     * Froala image upload
     */
    Route::post('image_upload', function() {
        // Allowed extentions.
        $allowedExts = ['gif', 'jpeg', 'jpg', 'png'];

        // Get filename.
        $temp = explode('.', $_FILES['file']['name']);

        // Get extension.
        $extension = end($temp);

        // An image check is being done in the editor but it is best to
        // check that again on the server side.
        // Do not use $_FILES['file']['type'] as it can be easily forged.
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES['file']['tmp_name']);

        if ((($mime == 'image/gif')
                || ($mime == 'image/jpeg')
                || ($mime == 'image/pjpeg')
                || ($mime == 'image/x-png')
                || ($mime == 'image/png'))
            && in_array($extension, $allowedExts)
        ) {
            // Generate new random name.
            $name = sha1(microtime()).'.'.$extension;

            // Save file in the uploads folder.
            move_uploaded_file($_FILES['file']['tmp_name'], getcwd().'/storage/app/media/'.$name);

            // Generate response.
            $response = new StdClass;
            $response->link = asset('/storage/app/media/'.$name);
            echo stripslashes(json_encode($response));
        }
    });

    /**
     * Froala image delete
     */
    Route::post('delete_image', function()
    {
        // Get src.
        $src = basename($_POST['src']);

        // Check if file exists.
        if (file_exists(getcwd().'/storage/app/media/'.$src)) {
            // Delete file.
            unlink(getcwd().'/storage/app/media/'.$src);
        }
    });
});
