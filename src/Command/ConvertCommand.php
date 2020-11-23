<?php

namespace App\Command;

use App\Services\FileReader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConvertCommand extends Command
{
    private $fileReader;

    public function __construct(FileReader $fileReader)
    {
        $this->fileReader = $fileReader;
        parent::__construct();
    }
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'trivago:convert';

    protected function configure()
    {
        $this->setDescription('Convert input file to csv format');
        $this->addArgument('file_input', InputArgument::REQUIRED, 'The filename to be converted');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $result = $this->fileReader->build($input->getArgument('file_input'));
        if(!$result) {
            $output->writeln('Input File not found!');

            return Command::FAILURE;
        } else {
            $output->writeln('File generated successfully!');
            return Command::SUCCESS;
        }
    }
}