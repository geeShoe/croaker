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

use App\Entity\ProjectStatus;
use App\Tests\Contract\AbstractEntityUnitTest;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ProjectStatusTest
 *
 * @package App\Tests\UnitTests\Entity
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
class ProjectStatusTest extends AbstractEntityUnitTest
{
    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        $this->setEntitySignature(ProjectStatus::class);
    }

    /**
     * @inheritDoc
     */
    public function entityPropertyDataProvider(): array
    {
        return [
            ['id'],
            ['name'],
            ['projects']
        ];
    }

    /**
     * @inheritDoc
     */
    public function getterSetterDataProvider(): array
    {
        return [
            ['getId', null, null],
            ['getName', 'setName', 'Active']
        ];
    }

    public function testGetProjectsReturnsArrayCollection(): void
    {
        $status = new ProjectStatus();

        self::assertInstanceOf(ArrayCollection::class, $status->getProjects());
    }

    public function testProjectStatusConstructorPassesProvidedArrayCollectionToProjectsProperty(): void
    {
        $collection = new ArrayCollection();

        $status = new ProjectStatus($collection);

        self::assertSame($collection, $status->getProjects());
    }
}
