<?php

namespace NtimYeboah\Command;

use NtimYeboah\Database\Seeder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class SeedDatabaseCommand extends Command
{
    /**
     * The seeder instance
     * 
     * @var \NtimYeboah\Database\Seeder
     */
    private $seeder;

    public function __construct(Seeder $seeder)
    {
        $this->seeder = $seeder;

        parent::__construct();
    }

    /**
     * Configure database command
     * 
     * @return void
     */
    protected function configure()
    {
        $this->setName('db:seed')
            ->setDescription('Seed database')
            ->setHelp('This command allows you to seed a database');
    }

    /**
     * Execute the command
     * 
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Seeding database...');

        $this->seeder->run();
        
        $output->writeln('Done seeding database...');
    }
}