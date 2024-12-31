<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Ramsey\Uuid\Uuid as RamseyUuid;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241230153542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create a User table';
    }

    public function up(Schema $schema): void
    {
        $this->createUsersTable($schema);
    }

    public function postUp(Schema $schema): void
    {
        $this->insertUserData();
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('users');
    }

    private function createUsersTable(Schema $schema): void
    {
        $table = $schema->createTable('users');
        $table->addColumn('uuid', 'string', ['length' => 36,'notnull' => true]);
        $table->addColumn('nombre', 'string', ['length' => 100, 'notnull' => true]);
        $table->addColumn('apellido', 'string', ['length' => 100, 'notnull' => true]);
        $table->addColumn('email', 'string', ['length' => 100, 'notnull' => true]);
        $table->addColumn('password', 'string', ['length' => 100, 'notnull' => true]);
        $table->setPrimaryKey(['uuid']);
    }

    private function insertUserData(): void
    {
        $users = [
            [
                'uuid' => RamseyUuid::uuid4()->toString(),
                'nombre' => 'samuel',
                'apellido' => 'soler',
                'email' => 'ssoler@gmail.com',
                'password' => 'abc123',
            ],
            [
                'uuid' => RamseyUuid::uuid4()->toString(),
                'nombre' => 'paco',
                'apellido' => 'soler',
                'email' => 'paco@gmail.com',
                'password' => 'abc123',
            ],
        ];

        foreach ($users as $user) {
            $this->connection->insert(
                'users',
                $user
            );
        }
    }
}
