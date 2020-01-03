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

namespace App\Contract;

/**
 * Trait MigrationTrait
 *
 * @package App\Contract
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
trait MigrationTrait
{
    /**
     * Check if server is Mysql or Mariadb else abort
     *
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function checkSchema(): void
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\' or \'mariadb\'.'
        );
    }
}
