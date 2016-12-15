<?php

namespace spec\AppBundle\Entity\DTP;

use AppBundle\Entity\DTP\Ruleset;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RulesetSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Ruleset::class);
    }

    function it_is_json_serializable()
    {
        $this->shouldImplement(\JsonSerializable::class);

        $this->jsonSerialize()->shouldHaveKey('id');
        $this->jsonSerialize()->shouldHaveKey('name');
    }
}
