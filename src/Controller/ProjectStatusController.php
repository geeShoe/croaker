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

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProjectStatusController
 *
 * @package App\Controller
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
class ProjectStatusController extends AbstractController
{
    /**
     * @Route("/admin/project-status", methods={ "GET" }, name="project-status-manager")
     * @return Response
     */
    public function manager(): Response
    {
        $this->denyAccessUnlessGranted(User::ROLE_ADMIN);

        return $this->render('project_status/admin_project_status.html.twig');
    }
}
