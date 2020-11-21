<?php

namespace App\Services\FileFormats;

use App\Contract\Format;

class JsonFormat implements Format
{

    /**
     * this method will read the file and convert and save to json
     * @param Symfony\Component\Finder\Finder $files
     * @return array $hotelLists
     */
    public function read($files)
    {
        $hotelLists = [];

        foreach($files as $file)
        {
            $fileArray = json_decode($file->getContents());

            $hotelLists = array_merge($hotelLists, $fileArray);


        }

        return $hotelLists;
    }
}