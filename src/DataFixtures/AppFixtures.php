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

namespace App\DataFixtures;

use App\Utils\DefaultData;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class AppFixtures
 *
 * @package App\DataFixtures
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
class AppFixtures extends Fixture
{
    protected ObjectManager $manager;

    protected UserGenerator $userGenerator;

    protected ArrayCollection $projectStatuses;

    /**
     * AppFixtures constructor.
     *
     * @param UserGenerator $userGenerator
     */
    public function __construct(UserGenerator $userGenerator)
    {
        $this->userGenerator = $userGenerator;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $this->persistUserEntities();

        $this->projectStatuses = DefaultData::createProjectStatusEntities();

        $this->persistProjectStatusEntities();
        $this->persistProjectEntities();

        $this->manager->flush();
    }

    protected function persistUserEntities(): void
    {
        $user = $this->userGenerator->getDummyUser();

        $this->manager->persist($user);
    }

    protected function persistProjectStatusEntities(): void
    {
        $statuses = $this->projectStatuses;

        foreach ($statuses as $status) {
            $this->manager->persist($status);
        }
    }

    protected function persistProjectEntities(): void
    {
        $project = ProjectGenerator::getDummyProject($this->projectStatuses->get('Active'));

        $this->manager->persist($project);
    }
}
