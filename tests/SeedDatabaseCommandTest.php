<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Illuminate\Container\Container;
use Symfony\Component\Console\Application;
use NtimYeboah\Command\SeedDatabaseCommand;
use NtimYeboah\Database\Migration\Migration;
use Symfony\Component\Console\Tester\CommandTester;

class SeedDatabaseCommandTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        (new Migration)->run(true);
    }

    /** @test */
    public function can_run_seed_database_command_successfully()
    {
        $container = Container::getInstance();
        $application = new Application('Database Seed Command');
        $application->add($container->make(SeedDatabaseCommand::class));

        $command = $application->find('db:seed');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'command' => $command->getName() 
        ]);

        $this->assertRegExp(
            '/Seeding database...\\nDone seeding database...\\n/', 
            $commandTester->getDisplay()
        );
    }
}

