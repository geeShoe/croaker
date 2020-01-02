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

use PHPUnit\Framework\TestCase;

/**
 * Class AbstractEntityUnitTest
 *
 * @package App\Tests\Contract
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
abstract class AbstractEntityUnitTest extends TestCase implements EntityUnitTestInterface
{
    public string $entitySignature;

    /**
     * Set the signature for Entity being tested
     * @param string $signature
     */
    public function setEntitySignature(string $signature): void
    {
        $this->entitySignature = $signature;
    }

    /**
     * @dataProvider entityPropertyDataProvider
     * @param string $propertyName
     */
    public function testEntityHasPropertyDefined(string $propertyName): void
    {
        self::assertClassHasAttribute($propertyName, $this->entitySignature);
    }

    /**
     * @dataProvider getterSetterDataProvider
     * @param string|null $getMethodName
     * @param string|null $setMethodName
     */
    public function testGetterSetterMethodsAreDefined(string $getMethodName = null, string $setMethodName = null): void
    {
        if ($getMethodName !== null) {
            self::assertIsCallable([$this->entitySignature, $getMethodName]);
        }

        if ($setMethodName !== null) {
            self::assertIsCallable([$this->entitySignature, $getMethodName]);
        }
    }

    /**
     * @dataProvider getterSetterDataProvider
     * @param string|null $getMethodName
     * @param string|null $setMethodName
     * @param null        $expectedGetterResult
     */
    public function testGetterSettersSetAndReturnExpectedResult(
        string $getMethodName = null,
        string $setMethodName = null,
        $expectedGetterResult = null
    ): void {
        $entity = new $this->entitySignature();

        if ($setMethodName !== null) {
            $setterReturn = $entity->$setMethodName($expectedGetterResult);
            self::assertInstanceOf($this->entitySignature, $setterReturn);
        }

        if ($getMethodName !== null) {
            self::assertSame($expectedGetterResult, $entity->$getMethodName());
        }
    }
}
