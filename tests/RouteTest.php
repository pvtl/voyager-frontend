<?php

namespace Pvtl\VoyagerFrontend\Test;

use Artisan;
use Monolog\Logger;

class RouteTest extends TestCase
{
	/** @test */
    public function it_returns_true_if_the_test_route_is_visited()
    {
        $response = $this->get('/test');

        $response->assertStatus(200);
    }
}