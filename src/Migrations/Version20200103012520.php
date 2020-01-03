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
 * Class Version20200103012520
 *
 * @package DoctrineMigrations
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
final class Version20200103012520 extends AbstractMigration
{
    use MigrationTrait;

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return 'Initial migration';
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function up(Schema $schema) : void
    {
        $this->checkSchema();

        $this->addSql(<<< EOT
            CREATE TABLE project (
                id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid_binary_ordered_time)',
                status_id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid_binary_ordered_time)',
                name VARCHAR(100) NOT NULL,
                slug VARCHAR(150) NOT NULL,
                summary LONGTEXT NOT NULL,
                UNIQUE INDEX UNIQ_2FB3D0EE5E237E06 (name),
                UNIQUE INDEX UNIQ_2FB3D0EE989D9B62 (slug),
                INDEX IDX_2FB3D0EE6BF700BD (status_id),
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
            EOT
        );

        $this->addSql(<<< EOT
            CREATE TABLE project_status (
                id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid_binary_ordered_time)',
                name VARCHAR(25) NOT NULL,
                UNIQUE INDEX UNIQ_6CA48E565E237E06 (name),
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
            EOT
        );

        $this->addSql(<<< EOT
            ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE6BF700BD
                FOREIGN KEY (status_id) REFERENCES project_status (id)
            EOT
        );
    }

    /**
     * @param Schema $schema
     * @throws \Doctrine\DBAL\DBALException
     */
    public function down(Schema $schema) : void
    {
        $this->checkSchema();

        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE6BF700BD');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_status');
    }
}
