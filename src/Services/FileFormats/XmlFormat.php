<?php

namespace App\Services\FileFormats;

use App\Contract\Format;
use SimpleXMLElement;

class XmlFormat implements Format
{

   /**
     * this method will read the file and convert and save to xml
     * @param Symfony\Component\Finder\Finder $files
     * @return array $hotelLists
     */
    public function read($files)
    {
        $hotelLists = [];

        foreach($files as $file)
        {
            $hotelList = new SimpleXMLElement($file->getContents());

            foreach($hotelList as $hotel) {
                $fileArray[] = (array) $hotel;
            }

            $hotelLists = array_merge($hotelLists, $fileArray);
        }


        return $hotelLists;
    }

}