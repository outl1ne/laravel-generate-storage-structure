<?php

namespace Outl1ne\GenerateStorageStructure;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateStorageStructureCommand extends Command
{
    protected static $defaultName = 'generate-storage-structure';

    protected function configure()
    {
        $this
            ->setDefinition(
                new InputDefinition([
                    new InputOption('storage-path', null, InputOption::VALUE_REQUIRED),
                ])
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rootDirectory = $input->getOption('storage-path');
        if ($rootDirectory !== null) {
            $rootDirectory = rtrim($rootDirectory, '/');
        }

        $directories = [
            'app',
            'app/public',
            'framework',
            'framework/cache',
            'framework/sessions',
            'framework/testing',
            'framework/views',
            'logs',
        ];

        foreach ($directories as $directory) {
            if ($rootDirectory !== null) {
                $directory = $rootDirectory.'/'.$directory;
            }

            if ((new Filesystem)->exists($directory)) {
                continue;
            }

            (new Filesystem)->mkdir($directory);
        }

        $output->writeln('Storage structure generated.');

        return 0;
    }
}
