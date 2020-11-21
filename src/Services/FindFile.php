<?php

namespace App\Services;

use Symfony\Component\Finder\Finder;

class FindFile
{

    /**
     * this function is to read the file
     * @param string $input_file filename
     * @param string $inputDir file directory
     * @return object Symfony\Component\Finder\Finder
     */
    public static function get(string $input_file, string $inputDir)
    {
        $finder   = new Finder();

        $finder->files()->in($inputDir)->name($input_file);

        return $finder;
    }
}