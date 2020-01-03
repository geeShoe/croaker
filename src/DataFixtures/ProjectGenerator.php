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

use App\Entity\Project;
use App\Entity\ProjectStatus;

/**
 * Class ProjectGenerator
 *
 * @package App\DataFixtures
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
class ProjectGenerator
{
    public const NAME = 'Test Project';

    public const SUMMARY = 'Summary of a test project.';

    /**
     * Generate a dummy project for testing / fixtures
     *
     * @param ProjectStatus $status
     * @param int|null      $suffix
     * @return Project
     */
    public static function getDummyProject(ProjectStatus $status, int $suffix = null): Project
    {
        $name = self::NAME;

        if ($suffix !== null) {
            $name .= " $suffix";
        }

        $project = new Project();
        $project->setName($name);
        $project->setSlug($name);
        $project->setSummary(self::SUMMARY);
        $project->setStatus($status);

        return $project;
    }
}
