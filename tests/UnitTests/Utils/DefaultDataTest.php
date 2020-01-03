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

namespace App\Tests\UnitTests\Utils;

use App\Entity\ProjectStatus;
use App\Utils\DefaultData;
use PHPUnit\Framework\TestCase;

/**
 * Class DefaultDataTest
 *
 * @package App\Tests\UnitTests\Utils
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
class DefaultDataTest extends TestCase
{
    public function testStaticProjectStatusPropertyContainsDefaultProjectStatuses(): void
    {
        $expected = [
            'Active' => 'Project is in active development',
            'Security' => 'Project is receiving security fixes only.',
            'End of Life' => 'Project has reached it\'s end of life. No further development.'
        ];

        $this->assertSame($expected, DefaultData::$projectStatuses);
    }

    public function testCreateProjectStatusEntitiesReturnsCollectionOfProjectStatusEntities(): void
    {
        $results = DefaultData::createProjectStatusEntities();

        foreach ($results as $result) {
            $this->assertInstanceOf(ProjectStatus::class, $result);
        }

        $this->assertCount(3, $results);
    }

    public function testCreateProjectStatusEntitiesCollectionContainsDefaultProjectStatuses(): void
    {
        $results = DefaultData::createProjectStatusEntities();

        $expected = ['Active', 'Security', 'End of Life'];

        foreach ($expected as $name) {
            $this->assertTrue($results->containsKey($name));

            $status = $results->get($name);

            $this->assertSame($name, $status->getName());
        }
    }
}
