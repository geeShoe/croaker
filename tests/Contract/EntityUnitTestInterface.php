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

/**
 * Interface EntityUnitTestInterface
 *
 * @package App\Tests\Contract
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
interface EntityUnitTestInterface
{
    /**
     * Define which properties are required by an Entity
     *
     * @return array<array> [['nameOfProperty]]
     */
    public function entityPropertyDataProvider(): array;

    /**
     * @param string $propertyName
     */
    public function testEntityHasPropertyDefined(string $propertyName): void;

    /**
     * Define entity getter and/or setters to be tested
     * @return array<array> [[getterMethodName = null, setterMethodName = null, expectedReturnFromGetter = null]]
     */
    public function getterSetterDataProvider(): array;

    /**
     * @param string|null $getMethodName
     * @param string|null $setMethodName
     */
    public function testGetterSetterMethodsAreDefined(
        string $getMethodName = null,
        string $setMethodName = null
    ): void;

    /**
     * @param string|null $getMethodName
     * @param string|null $setMethodName
     * @param null        $expectedGetterResult
     */
    public function testGetterSettersSetAndReturnExpectedResult(
        string $getMethodName = null,
        string $setMethodName = null,
        $expectedGetterResult = null
    ): void;
}
