<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Utils\DefaultData;
use Doctrine\Bundle\FixturesBundle\Fixture;
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

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $this->persistProjectStatusEntities();

        $this->manager->flush();
    }

    protected function persistProjectStatusEntities(): void
    {
        $statuses = DefaultData::createProjectStatusEntities();

        foreach ($statuses as $status) {
            $this->manager->persist($status);
        }
    }
}
