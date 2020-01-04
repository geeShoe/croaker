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

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserGenerator
 *
 * @package App\DataFixtures
 * @author  Jesse Rushlow <jr@geeshoe.com>
 */
class UserGenerator
{
    public const USER_USERNAME = 'user';
    public const USER_DISPLAY_NAME = 'User';
    public const USER_EMAIL = 'user@geeshoe.com';
    public const USER_PASSWORD = 'password';
    public const ADMIN_USERNAME = 'admin';
    public const ADMIN_DISPLAY_NAME = 'Admin';
    public const ADMIN_EMAIL = 'admin@geeshoe.com';
    public const ADMIN_PASSWORD = 'password';

    public UserPasswordEncoderInterface $encoder;

    /**
     * UserGenerator constructor.
     *
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * Generate a dummy regular user account for testing / fixtures
     *
     * @return User
     */
    public function getDummyUser(): User
    {
        $user = new User();
        $user->setUsername(self::USER_USERNAME);
        $user->setDisplayName(self::USER_DISPLAY_NAME);
        $user->setEmail(self::USER_EMAIL);

        $password = $this->encoder->encodePassword($user, self::USER_PASSWORD);
        $user->setPassword($password);

        return $user;
    }

    /**
     * Generate a dummy admin user account for testing / fixtures
     *
     * @return User
     */
    public function getDummyAdmin(): User
    {
        $user = new User();
        $user->setUsername(self::ADMIN_USERNAME);
        $user->setDisplayName(self::ADMIN_DISPLAY_NAME);
        $user->setEmail(self::ADMIN_EMAIL);
        $user->setRoles([User::ROLE_ADMIN]);

        $password = $this->encoder->encodePassword($user, self::ADMIN_PASSWORD);
        $user->setPassword($password);

        return $user;
    }
}
