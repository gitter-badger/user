<?php

/*
 * This file is part of the BenGorUser package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\BenGorUser\User\Domain\Model;

use BenGorUser\User\Domain\Model\UserToken;
use PhpSpec\ObjectBehavior;

/**
 * Spec file of user token value object class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class UserTokenSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UserToken::class);
    }

    function it_constructs_with_null_token()
    {
        $this->token()->shouldNotBe(null);
    }

    function it_constructs_with_string_token()
    {
        $this->beConstructedWith('tokenId');

        $this->token()->shouldBe('tokenId');
    }

    function it_compares_ids()
    {
        $this->beConstructedWith('tokenId');

        $this->equals(new UserToken('tokenId'))->shouldBe(true);
    }

    function it_compares_different_ids()
    {
        $this->beConstructedWith('tokenId');

        $this->equals(new UserToken('notEqual'))->shouldBe(false);
    }

    function it_renders_string()
    {
        $this->beConstructedWith('tokenId');

        $this->__toString()->shouldBe('tokenId');
    }
}
