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

namespace App\Utils;

use App\Entity\ProjectStatus;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class DefaultData
 *
 * @package App\Utils
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
class DefaultData
{
    /**
     * Default project statuses
     *
     * @var array<string> ['Name' => 'Description']
     */
    public static array $projectStatuses = [
        'Active' => 'Project is in active development',
        'Security' => 'Project is receiving security fixes only.',
        'End of Life' => 'Project has reached it\'s end of life. No further development.'
    ];

    /**
     * Get collection of default project status entities.
     *
     * @return ArrayCollection
     */
    public static function createProjectStatusEntities(): ArrayCollection
    {
        $collection = new ArrayCollection();

        foreach (self::$projectStatuses as $name => $description) {
            $status = new ProjectStatus();
            $status->setName($name);

            $collection->set($name, $status);
        }

        return $collection;
    }
}
