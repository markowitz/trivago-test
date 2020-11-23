<?php

namespace App\Services;

use Symfony\Component\Filesystem\Filesystem;
use Psr\Log\LoggerInterface;
class SaveToCsv
{
    private $logger;

    public function __construct(LoggerInterface $validationLogger)
    {
        $this->logger = $validationLogger;
    }

    /**
     * this converts the array and save to csv
     * @param array $hotelLists list of array data to be converted
     * @param string $input_format type of input file
     * @param string $outputDir where converted csv will be stored
     * @return bool
     */
    public function convert(array $hotelLists, string $input_format, string $outputDir="")
    {

        $filesystem = new Filesystem();

        $filesystem->mkdir($outputDir, 0700);

        $csv        = fopen("{$outputDir}hotels_{$input_format}.csv","w");

        $headers    = ['Name', 'Address', 'Ratings', 'Contact Name', 'Contact Phone', 'Website'];

        fputcsv($csv, $headers);

        foreach($hotelLists as $hotel) {

            $hotel = (array) $hotel;
            $errors = Validator::validate($hotel);

            if (!count($errors) > 0) {
                fputcsv($csv, $hotel);
            } else {
                $errMessages = [];
                foreach($errors as $err) {
                    $errMessages[] = [
                        $err->getInvalidValue() => $err->getMessage()
                    ];
                }

                $this->logger->info(json_encode($errMessages));
            }

        }

        fclose($csv);
        return true;
    }


}