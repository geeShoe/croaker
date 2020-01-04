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

namespace App\Tests\FunctionalTests\Controller;

use App\DataFixtures\UserGenerator;
use App\Tests\Contract\WebTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ProjectStatusControllerTest
 *
 * @package App\Tests\FunctionalTests\Controller
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
class ProjectStatusControllerTest extends WebTestCase
{
    use WebTestTrait;

    public function testProjectStatusManagerAccessDeniedToNonAdmins(): void
    {
        $this->makeAuthenticatedRequest(
            '/admin/project-status',
            UserGenerator::USER_USERNAME,
            UserGenerator::USER_PASSWORD
        );

        self::assertResponseStatusCodeSame(403);
    }

    public function testProjectStatusManagerReturnsSuccessfulResponse(): void
    {
        $this->makeAuthenticatedRequest(
            '/admin/project-status',
            UserGenerator::ADMIN_USERNAME,
            UserGenerator::ADMIN_PASSWORD
        );

        self::assertResponseIsSuccessful();
        self::assertPageTitleContains('Project Status');
    }
}
