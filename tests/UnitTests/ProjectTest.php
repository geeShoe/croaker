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

namespace App\Tests\UnitTests;

use App\Entity\Project;
use App\Tests\Contract\AbstractEntityUnitTest;

class ProjectTest extends AbstractEntityUnitTest
{
    protected function setUp(): void
    {
        $this->setEntitySignature(Project::class);
    }

    public function entityPropertyDataProvider(): array
    {
        return [
            ['id'],
            ['name'],
            ['slug'],
            ['summary']
        ];
    }

    public function getterSetterDataProvider(): array
    {
        return [
            ['getId', null, null],
            ['getName', 'setName', 'Test Project'],
            ['getSummary', 'setSummary', 'Project summary']
        ];
    }

    public function testSlugGetterSetters(): void
    {
        $project = new Project();

        $project->setSlug('Test Project');
        self::assertSame('test-project', $project->getSlug());
    }
}
