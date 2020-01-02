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

namespace App\Repository;

use App\Entity\ProjectStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class ProjectStatusRepository
 *
 * @package App\Repository
 * @author  Jesse Rushlow <jr@geeshoe.com>
 *
 * @method ProjectStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectStatus[]    findAll()
 * @method ProjectStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectStatusRepository extends ServiceEntityRepository
{
    /**
     * ProjectStatusRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectStatus::class);
    }
}
