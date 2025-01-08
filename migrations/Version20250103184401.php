<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ramsey\Uuid\Uuid as RamseyUuid;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250103184401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Sensors table';
    }

    public function up(Schema $schema): void
    {
        $this->createSensorsTable($schema);
    }

    public function postUp(Schema $schema): void
    {
        $this->insertSensorsTable();
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('sensors');
    }

    private function createSensorsTable(Schema $schema): void
    {
        $table = $schema->createTable('sensors');
        $table->addColumn('uuid', 'string', ['length' => 36, 'notnull' => true]);
        $table->addColumn('nombre', 'string', ['length' => 100, 'notnull' => true]);
    }

    private function insertSensorsTable(): void
    {
        $sensors = [
            [
                'uuid' => 'afb59190-4deb-11ed-bdc3-0242ac120001',
                'nombre' => 'sensor de vino tinto'
            ],
            [
                'uuid' => 'afb59190-4deb-11ed-bdc3-0242ac120002',
                'nombre' => 'sensor de vino blanco'
            ],
        ];

        foreach ($sensors as $sensor) {
            $this->connection->insert(
                'sensors',
                $sensor
            );
        }
    }
}
