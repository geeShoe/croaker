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

namespace App\Tests\FunctionalTests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class HTMLEndPointTest
 *
 * @package App\Tests\FunctionalTests
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
class HTMLEndPointTest extends WebTestCase
{
    /**
     * @return array<array>
     */
    public function endpointDataProvider(): array
    {
        return [
            ['/']
        ];
    }

    /**
     * @dataProvider endpointDataProvider
     * @param string $uri
     * @param int    $status
     */
    public function testRoutesAreSuccessful(string $uri, int $status = 200): void
    {
        $client = self::createClient();

        $client->request('GET', $uri);

        self::assertResponseStatusCodeSame($status);
        self::assertResponseIsSuccessful("Route $uri failed!");
    }

    public function testLogoutRedirectsToHomepage(): void
    {
        $client = self::createClient();
        $client->request('GET', '/logout');

        self::assertResponseRedirects('http://localhost/', 302);
    }
}
