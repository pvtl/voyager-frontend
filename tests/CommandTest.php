<?php

namespace Pivotal\VoyagerFrontend\Test;

class CommandTest extends TestCase
{
    /** @test */
    function it_returns_true_if_command_logs_expected_string()
    {
        $this->artisan('voyagerfrontend:install');

        $this->seeArtisanOutput('Example command executed!');
    }
}