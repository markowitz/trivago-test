<?php

namespace App\Services;

class InputFileFactory
{
    protected $csv, $outputDir;

    public function __construct(SaveToCsv $csv, string $outputDir)
    {
        $this->csv       = $csv;
        $this->outputDir = $outputDir;
    }

    /**
     * this function will get the className and instantiate it and call the read method of the class
     * @param string $className
     * @param Symfony\Component\Finder\Finder object
     * @param string $file_input
     * @return bool
     */
    public function readFile(string $className, object $file, string $file_input)
    {
        $classObject = new $className();

        $files = $classObject->read($file);

        return $this->csv->convert($files, $file_input, $this->outputDir);
    }

}