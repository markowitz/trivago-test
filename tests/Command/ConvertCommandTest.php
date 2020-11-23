<?php

namespace App\Tests\Command;

use App\Services\Validator;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;



class ConvertCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('trivago:convert');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'input_file' => 'hotels.xml',
        ]);

        // the output of the command in the console
        $output = $commandTester->getDisplay();

        $this->assertStringContainsString('File generated successfully!', $output);
    }

    /**
     * test if file doesn't exists and execution fails
     */
    public function testExecuteFailsIfFileDoesNotExist()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('trivago:convert');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'input_file' => 'hotels.json.xml',
        ]);

        // the output of the command in the console
        $output = $commandTester->getDisplay();

        $this->assertStringNotContainsString('File generated successfully!', $output);
    }

    public function testFileSavesToCorrectFolder()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('trivago:convert');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'input_file' => 'hotels.xml',
        ]);

        $this->assertFileExists("var/out/hotels_xml.csv");

    }

    public function testValidation()
    {
        $hotel = [
                "name" => "Apartment Dörr",
                "address" => "Bolzmannweg 451, 05116 Hannoverßå",
                "stars" => "-5",
                "contact" => "Scarlet Kusch-Linke",
                "phone" => "08177354570",
                "uri" => "http://www.gar"
                ];

         $errors = Validator::validate($hotel);
        $this->assertTrue(count($errors) > 0);

    }
}

