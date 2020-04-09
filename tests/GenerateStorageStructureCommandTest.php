<?php

namespace OptimistDigital\GenerateStorageStructure\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Tester\CommandTester;
use OptimistDigital\GenerateStorageStructure\GenerateStorageStructureCommand;

class GenerateStorageStructureCommandTest extends TestCase
{
    public function test_it_can_generate_storage_structure()
    {
        $storageDirectoryPath = __DIR__.'/../tests-output/my-app/storage';

        if (file_exists($storageDirectoryPath)) {
            (new Filesystem)->remove($storageDirectoryPath);
        }
        (new Filesystem)->mkdir($storageDirectoryPath);

        $application = new Application('Laravel Installer');

        $command = new GenerateStorageStructureCommand;

        $application->add($command);
        $application->setDefaultCommand($command->getName());

        $tester = new CommandTester($application->find($command->getName()));

        $statusCode = $tester->execute(['--storage-path' => $storageDirectoryPath]);

        $this->assertEquals($statusCode, 0);
        $this->assertDirectoryExists($storageDirectoryPath);

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
            $this->assertDirectoryExists($storageDirectoryPath.'/'.$directory);
        }
    }
}