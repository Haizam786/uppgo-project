<?php

namespace App\Helpers;

//All the common util functions go here
class CheckImage
{

    //helper function to check if a file exist in storage
    public static function checkImageExists($fileName, $folderName, $data, $nameInDb)
    {
        $uri = 'app/public/' . $folderName . '/' . $fileName;

        if (file_exists(storage_path($uri))) {
            return $data;
        } else {
            $data[$nameInDb] = null;

            return $data;
        }
    }
}
