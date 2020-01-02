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

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Geeshoe\Helpers\Data\StringHelpers;
use Ramsey\Uuid\Uuid;

/**
 * Class Project
 *
 * @package App\Entity
 * @author  Jesse Rushlow <jr@geeshoe.com>
 *
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid_binary_ordered_time", unique=true)
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidOrderedTimeGenerator")
     */
    private ?Uuid $id = null;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private ?string $name = null;

    /**
     * @ORM\Column(type="string", length=150, unique=true)
     */
    private ?string $slug = null;

    /**
     * @ORM\Column(type="text")
     */
    private ?string $summary = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProjectStatus", inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private ProjectStatus $status;

    /**
     * @return Uuid|null
     */
    public function getId(): ?Uuid
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     * @return $this
     */
    public function setSlug(?string $slug): self
    {
        $this->slug = StringHelpers::filterAlphaNumDash($slug);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * @param string|null $summary
     * @return $this
     */
    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * @return ProjectStatus
     */
    public function getStatus(): ProjectStatus
    {
        return $this->status;
    }

    /**
     * @param ProjectStatus $status
     * @return $this
     */
    public function setStatus(ProjectStatus $status): self
    {
        $this->status = $status;

        return $this;
    }
}
