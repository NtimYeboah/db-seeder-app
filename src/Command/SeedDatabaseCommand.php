<?php

namespace NtimYeboah\Command;

use NtimYeboah\Database\Migration\Schema;
use Symfony\Component\Console\Command\Command;
use NtimYeboah\Database\Seeder\DatabaseSeeder;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SeedDatabaseCommand extends Command
{
    /**
     * Table schema.
     * 
     * @var \NtimYeboah\Database\Migration\Schema
     */
    private $schema;

    /**
     * The seeder instance.
     * 
     * @var \NtimYeboah\Database\Seeder\DatabaseSeeder
     */
    private $seeder;

    public function __construct(Schema $schema, DatabaseSeeder $seeder)
    {
        $this->schema = $schema;
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
            ->setHelp('This command allows you to seed a database')
            ->addOption('class', 'c', InputOption::VALUE_OPTIONAL, 'Specify the seeder class to run')
            ->addOption('rerun', 'r', InputOption::VALUE_OPTIONAL, 'Specify to rerun the seeders', false);
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

        $seederClass = $input->getOption('class') ?: null;
        $rerunMigrations = $input->getOption('rerun') !== false;

        if (! is_null($seederClass) && $rerunMigrations !== false) {
            throw new \InvalidArgumentException('Cannot run class and rerun switches at the same time');
        }
        
        $this->schema->run($seederClass, $rerunMigrations);
        $this->seeder->call($seederClass);
        
        $output->writeln('Done seeding database...');
    }
}