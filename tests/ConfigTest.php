<?php

namespace Pvtl\VoyagerFrontend\Test;

class ConfigTest extends TestCase
{
    /** @test */
    function it_returns_true_if_the_right_title_text_is_returned()
    {
        $this->assertEquals('Pvtl/VoyagerFrontend', config('test.title'));
    }

    /** @test */
    function it_returns_false_if_the_wrong_title_text_is_returned()
    {
    	$this->app['config']->set('test.title', 'Wrong title!');

        $this->assertNotEquals('Pvtl/VoyagerFrontend', config('test.title'));
    }

    /** @test */
    function it_returns_true_if_the_right_message_text_is_returned()
    {
        $this->assertEquals('Some config texts.', config('test.message'));
    }

    /** @test */
    function it_returns_false_if_the_wrong_message_text_is_returned()
    {
    	$this->app['config']->set('test.message', 'Wrong message!');

        $this->assertNotEquals('Some config texts.', config('test.message'));
    }
}