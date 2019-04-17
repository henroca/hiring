<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function tearDown() : void {
        $this->addToAssertionCount(
            \Mockery::getContainer()->mockery_getExpectationCount()
        );

        \Mockery::close();

        parent::tearDown();
    }
}
