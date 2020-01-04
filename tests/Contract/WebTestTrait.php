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

namespace App\Tests\Contract;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Trait WebTestTrait
 *
 * @package App\Tests\Contract
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
trait WebTestTrait
{
    /**
     * Return crawler instance after making a request
     *
     * @param string $uri       URI to test
     * @param bool   $redirects If URI is redirected, set true
     * @return Crawler
     */
    public function makeRequest(string $uri, bool $redirects = false): Crawler
    {
        $client = static::createClient();

        if ($redirects) {
            $client->followRedirects();
        }

        return $client->request('GET', $uri);
    }

    /**
     * Return KernelBrowser after making a request
     *
     * @param string $uri
     * @param bool   $redirects
     * @return KernelBrowser
     */
    public function makeRequestGetClient(string $uri, bool $redirects = false): KernelBrowser
    {
        $client = static::createClient();

        if ($redirects) {
            $client->followRedirects();
        }

        $client->request('GET', $uri);

        return $client;
    }

    /**
     * Login using HTTP_BASIC authentication and make request
     *
     * @param string $uri
     * @param string $username
     * @param string $password
     * @param bool   $redirects
     * @return Crawler
     */
    public function makeAuthenticatedRequest(
        string $uri,
        string $username,
        string $password,
        bool $redirects = false
    ): Crawler {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => $username,
            'PHP_AUTH_PW' => $password
        ]);

        if ($redirects) {
            $client->followRedirects();
        }

        return $client->request('GET', $uri);
    }
}
