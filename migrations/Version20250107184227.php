<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250107184227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Wines table';
    }

    public function up(Schema $schema): void
    {
        $this->createWinesTable($schema);
    }

    public function postUp(Schema $schema): void
    {
        $this->insertWinesTable();
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('wines');
    }

    private function createWinesTable(Schema $schema): void
    {
        $table = $schema->createTable('wines');
        $table->addColumn('uuid', 'string', ['length' => 36, 'notnull' => true]);
        $table->addColumn('name', 'string', ['length' => 100, 'notnull' => true]);
        $table->addColumn('year', 'integer', ['length' => 100, 'notnull' => true]);
    }

    private function insertWinesTable(): void
    {
        $wines = [
            [
                'uuid' => 'afb59190-4deb-11ed-bdc3-0242ac120001',
                'name' => 'vino tinto',
                'year' => 2020,
            ],
            [
                'uuid' => 'afb59190-4deb-11ed-bdc3-0242ac120002',
                'name' => 'vino blanco',
                'year' => 2020,
            ],
        ];

        foreach ($wines as $wine) {
            $this->connection->insert(
                'wines',
                $wine
            );
        }
    }
}
