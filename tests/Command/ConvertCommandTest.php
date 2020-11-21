<?php

namespace App\Tests\Command;

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

    public function testForWrongFilename()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('trivago:convert');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'input_file' => 'hotelsjson.xml',
        ]);

        // the output of the command in the console
        $output = $commandTester->getErrorOutput();

        $this->assertStringContainsString('Input File not found!', $output);
    }
}

