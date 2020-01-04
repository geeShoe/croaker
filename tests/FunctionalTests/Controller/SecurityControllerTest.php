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

use App\Tests\Contract\WebTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class SecurityControllerTest
 *
 * @package App\Tests\FunctionalTests\Controller
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
class SecurityControllerTest extends WebTestCase
{
    use WebTestTrait;

    public function testLoginReturnsLoginForm(): void
    {
        $this->makeRequest('/login');

        self::assertPageTitleContains('Login');
    }

    public function testLoginFormContainsRequiredInputs(): void
    {
        $this->makeRequest('/login');

        $requiredInputs = [
            '#username',
            '#password',
            '[name=_csrf_token]',
            '#sign-in-btn'
        ];

        foreach ($requiredInputs as $input) {
            self::assertSelectorExists($input);
        }
    }

    public function testCSRFTokenProvidedInLoginForm(): void
    {
        $crawler = $this->makeRequest('/login');

        $form = $crawler->selectButton('Sign in')->form();

        self::assertNotNull($form['_csrf_token']->getValue());
    }

    public function testInvalidCSRFTokenSubmittedDisplaysError(): void
    {
        $client = $this->makeRequestGetClient('/login', true);

        $crawler = $client->getCrawler();

        $form = $crawler->selectButton('Sign in')->form();

        $form['_csrf_token']->setValue('abcd');

        $client->submit($form);

        self::assertSelectorExists('.flash-error');
        self::assertSelectorTextContains('.flash-error', 'Invalid CSRF token.');
    }

    /**
     * @return array<array> [['username', 'password']]
     */
    public function badCredentialsDataProvider(): array
    {
        return [
            'Bad username' => ['badUser', 'password'],
            'Bad Password' => ['user', 'badPassword'],
            'Bad user and password' => ['badUser', 'badPassword']
        ];
    }

    /**
     * @dataProvider badCredentialsDataProvider
     * @param string $username
     * @param string $password
     */
    public function testLoginFailureDisplaysError(string $username, string $password): void
    {
        $client = $this->makeRequestGetClient('/login', true);

        $crawler = $client->getCrawler();

        $form = $crawler->selectButton('Sign in')->form();

        $form['username']->setValue($username);
        $form['password']->setValue($password);

        $client->submit($form);

        self::assertSelectorExists('.flash-error');
        self::assertSelectorTextContains('.flash-error', 'Invalid credentials.');

        $container = $client->getKernel()->getContainer();
        $authChecker = $container->get('security.authorization_checker');

        self::assertFalse($authChecker->isGranted('ROLE_USER'));
    }

    public function testGoodCredentialsSuccessfullyLoginIn(): void
    {
        $client = $this->makeRequestGetClient('/login', true);

        $crawler = $client->getCrawler();

        $form = $crawler->selectButton('Sign in')->form();

        $form['username']->setValue('user');
        $form['password']->setValue('password');

        $client->submit($form);

        self::assertResponseIsSuccessful('Login failed...');
        self::assertSelectorNotExists('.flash-error');

        $container = $client->getKernel()->getContainer();
        $authChecker = $container->get('security.authorization_checker');

        self::assertTrue($authChecker->isGranted('ROLE_USER'));
    }
}
