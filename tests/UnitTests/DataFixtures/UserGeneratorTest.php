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

namespace App\Tests\UnitTests\DataFixtures;

use App\DataFixtures\UserGenerator;
use App\Entity\User;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

/**
 * Class UserGeneratorTest
 *
 * @package App\Tests\UnitTests\DataFixtures
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
class UserGeneratorTest extends TestCase
{
    public UserGenerator $generator;

    /**
     * @var UserPasswordEncoder|MockObject
     */
    public $encoder;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $this->encoder = $this->createMock(UserPasswordEncoder::class);
    }

    protected function setGenerator(): void
    {
        $this->generator = new UserGenerator($this->encoder);
    }

    public function testGetDummyUserReturnsValidUserEntity(): void
    {
        $this->setGenerator();

        $this->encoder
            ->expects(self::once())
            ->method('encodePassword')
            ->willReturn('password')
            ->with(self::isInstanceOf(User::class), UserGenerator::USER_PASSWORD);

        $result = $this->generator->getDummyUser();

        $this->assertSame(UserGenerator::USER_USERNAME, $result->getUsername());
        $this->assertSame(UserGenerator::USER_DISPLAY_NAME, $result->getDisplayName());
        $this->assertSame(UserGenerator::USER_EMAIL, $result->getEmail());
        $this->assertSame([User::ROLE_USER], $result->getRoles());
    }
}
