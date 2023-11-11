<?php

namespace App\Services;

class UploadImage
{
    function uploadUpdate($file, $field, $folder, $model, $request)
    {
        if ($request->hasFile($file)) {
            $image = $request->file($file);
            $imageExtension = $image->getClientOriginalExtension();
            $imageNewName = uniqid() . '.' . $imageExtension;

            $imagePath = 'assets/'.$folder.'/';
            $image->move(public_path($imagePath), $imageNewName);

            $model->$field = $imagePath . $imageNewName;

            unlink(public_path($model->$file));

        }
    }

    function uploadStore($file, $field, $folder, $model, $request)
    {
        if ($request->hasFile($file)) {
            $image = $request->file($file);
            $imageExtension = $image->getClientOriginalExtension();
            $imageNewName = uniqid() . '.' . $imageExtension;

            $imagePath = 'assets/'.$folder.'/';
            $image->move(public_path($imagePath), $imageNewName);

            $model->$field = $imagePath . $imageNewName;       

        }
    }
}
