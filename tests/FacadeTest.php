<?php

namespace Pvtl\VoyagerFrontend\Test;

use Pvtl\VoyagerFrontend\facades\VoyagerFrontend;

class FacadeTest extends TestCase
{
    /** @test */
    function it_returns_true_if_facade_returns_right_string()
    {
        $this->assertEquals('You used the VoyagerFrontendFacade to call this method!', VoyagerFrontend::saySomething());
    }
}