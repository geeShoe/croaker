<?php
/**
 * Copyright 2020 Jesse Rushlow - geeShoe Development
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Contract\MigrationTrait;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version20200103184809
 *
 * @package DoctrineMigrations
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
final class Version20200103184809 extends AbstractMigration
{
    use MigrationTrait;

    /**
     * @inheritDoc
     */
    public function getDescription() : string
    {
        return 'Create user table.';
    }

    /**
     * {@inheritDoc}
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function up(Schema $schema) : void
    {
        $this->checkSchema();

        $this->addSql(<<< EOT
            CREATE TABLE user (
                id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid_binary_ordered_time)',
                username VARCHAR(180) NOT NULL,
                display_name VARCHAR(180) NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                roles LONGTEXT NOT NULL COMMENT '(DC2Type:json)',
                UNIQUE INDEX UNIQ_8D93D649F85E0677 (username),
                UNIQUE INDEX UNIQ_8D93D649D5499347 (display_name),
                UNIQUE INDEX UNIQ_8D93D649E7927C74 (email),
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
            EOT
        );
    }

    /**
     * {@inheritDoc}
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    public function down(Schema $schema) : void
    {
        $this->checkSchema();

        $this->addSql('DROP TABLE user');
    }
}
