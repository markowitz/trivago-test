<?php

namespace App\Services;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Finder\Finder;

class FileReader
{
    private $params, $factory;

    public function __construct(ContainerBagInterface $params, string $inputDir, InputFileFactory $factory)
    {
        $this->params   = $params;
        $this->inputDir = $inputDir;
        $this->factory  = $factory;
    }

    /**
     * reads the input file based on the format of the file
     * @param $input_file
     * @return bool
     */
    public function build(string $input_file)
    {

        $file_format  = pathinfo($input_file, PATHINFO_EXTENSION);

        $file         = FindFile::get($input_file, $this->inputDir);

        if (!$file->hasResults()) {
            return false;
        }

        $config_name  = "app.{$file_format}_format";

        $className    = $this->params->get($config_name);

        return $this->factory->readFile($className, $file, $file_format);

    }

}