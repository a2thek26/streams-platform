<?php namespace spec\Streams\Platform\Addon\Extension;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ExtensionRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Streams\Platform\Addon\Extension\ExtensionRepository');
    }
}