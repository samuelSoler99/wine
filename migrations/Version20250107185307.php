<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ramsey\Uuid\Uuid as RamseyUuid;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250107185307 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Measurement table';
    }

    public function up(Schema $schema): void
    {
        $this->createMeasurementsTable($schema);
    }

    public function postUp(Schema $schema): void
    {
        $this->insertMeasurementsTable();
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('measurements');
    }

    private function createMeasurementsTable(Schema $schema): void
    {
        $table = $schema->createTable('measurements');
        $table->addColumn('uuid', 'string', ['length' => 36, 'notnull' => true]);
        $table->addColumn('idSensor', 'string', ['length' => 36, 'notnull' => true]);
        $table->addColumn('idWine', 'string', ['length' => 36, 'notnull' => true]);
        $table->addColumn('color', 'string', ['length' => 100, 'notnull' => true]);
        $table->addColumn('year', 'integer', ['length' => 100, 'notnull' => true]);
        $table->addColumn('temperature', 'integer', ['length' => 100, 'notnull' => true]);
        $table->addColumn('graduation', 'integer', ['length' => 100, 'notnull' => true]);
        $table->addColumn('pH', 'integer', ['length' => 100, 'notnull' => true]);
    }

    private function insertMeasurementsTable(): void
    {
        $measurements = [
            [
                'uuid' => RamseyUuid::uuid4()->toString(),
                'idSensor' => 'afb59190-4deb-11ed-bdc3-0242ac120001',
                'idWine' => 'afb59190-4deb-11ed-bdc3-0242ac120001',
                'color' => 'verde',
                'year' => 2020,
                'temperature' => 29,
                'graduation' => 15,
                'pH' => 3,
            ],
            [
                'uuid' => RamseyUuid::uuid4()->toString(),
                'idSensor' => 'afb59190-4deb-11ed-bdc3-0242ac120001',
                'idWine' => 'afb59190-4deb-11ed-bdc3-0242ac120001',
                'color' => 'amarillo',
                'year' => 2010,
                'temperature' => 24,
                'graduation' => 14,
                'pH' => 2,
            ],
            [
                'uuid' => RamseyUuid::uuid4()->toString(),
                'idSensor' => 'afb59190-4deb-11ed-bdc3-0242ac120001',
                'idWine' => 'afb59190-4deb-11ed-bdc3-0242ac120002',
                'color' => 'azul',
                'year' => 2024,
                'temperature' => 22,
                'graduation' => 11,
                'pH' => 3,
            ],
            [
                'uuid' => RamseyUuid::uuid4()->toString(),
                'idSensor' => 'afb59190-4deb-11ed-bdc3-0242ac120002',
                'idWine' => 'afb59190-4deb-11ed-bdc3-0242ac120002',
                'color' => 'rosa',
                'year' => 2013,
                'temperature' => 23,
                'graduation' => 13,
                'pH' => 1,
            ],
        ];

        foreach ($measurements as $measurement) {
            $this->connection->insert(
                'measurements',
                $measurement
            );
        }
    }
}
