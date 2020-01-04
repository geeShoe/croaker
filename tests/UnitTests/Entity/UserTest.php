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

namespace App\Tests\UnitTests\Entity;

use App\Entity\User;
use App\Tests\Contract\AbstractEntityUnitTest;

/**
 * Class UserTest
 *
 * @package App\Tests\UnitTests\Entity
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
class UserTest extends AbstractEntityUnitTest
{
    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $this->setEntitySignature(User::class);
    }

    public function entityPropertyDataProvider(): array
    {
        return [
            ['id'],
            ['username'],
            ['displayName'],
            ['email'],
            ['password'],
            ['roles']
        ];
    }

    public function getterSetterDataProvider(): array
    {
        return [
            ['getId', null, null],
            ['getUsername', 'setUsername', 'unittest'],
            ['getDisplayName', 'setDisplayName', 'Geeshoe'],
            ['getEmail', 'setEmail', 'jr@geeshoe.com'],
            ['getPassword', 'setPassword', 'password'],
            ['getRoles', 'setRoles', ['ROLE_USER']]
        ];
    }

    public function testUserEntityDefinesUserRoles(): void
    {
        $this->assertSame('ROLE_USER', User::ROLE_USER);
        $this->assertSame('ROLE_ADMIN', User::ROLE_ADMIN);
    }

    public function testAllUsersHaveUserRole(): void
    {
        $result = new User();

        $this->assertSame([User::ROLE_USER], $result->getRoles());
    }
}
