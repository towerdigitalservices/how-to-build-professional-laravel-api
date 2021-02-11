<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\TestHelper;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $helper;

    public function setUp(): void
    {
        parent::setUp();
        $this->helper = new TestHelper($this->app);
    }
}
