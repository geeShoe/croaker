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
}
