<?php

/*
 * This file is part of the BenGorUser library.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\BenGor\User\Application\Service;

use BenGor\User\Application\Service\GrantUserRoleRequest;
use BenGor\User\Domain\Model\User;
use BenGor\User\Domain\Model\UserId;
use BenGor\User\Domain\Model\UserRepository;
use BenGor\User\Domain\Model\UserRole;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Spec file of grant user role service class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class GrantUserRoleServiceSpec extends ObjectBehavior
{
    function let(UserRepository $repository)
    {
        $this->beConstructedWith($repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('BenGor\User\Application\Service\GrantUserRoleService');
    }

    function it_implements_application_service()
    {
        $this->shouldImplement('Ddd\Application\Service\ApplicationService');
    }

    function it_grants_the_user_role(UserRepository $repository, User $user)
    {
        $request = new GrantUserRoleRequest('user-id', 'ROLE_USER');
        $id = new UserId('user-id');
        $role = new UserRole('ROLE_USER');

        $repository->userOfId($id)->shouldBeCalled()->willReturn($user);

        $user->grant($role)->shouldBeCalled();
        $repository->persist($user)->shouldBeCalled();

        $this->execute($request);
    }

    function it_does_not_grant_the_user_role_because_the_user_does_not_exist(UserRepository $repository)
    {
        $request = new GrantUserRoleRequest('user-id', 'ROLE_USER');
        $id = new UserId('user-id');

        $repository->userOfId($id)->shouldBeCalled()->willReturn(null);

        $this->shouldThrow('BenGor\User\Domain\Model\Exception\UserDoesNotExistException')->duringExecute($request);
    }
}
